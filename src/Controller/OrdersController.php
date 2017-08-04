<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use DateTime;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 */
class OrdersController extends AppController {

    public $key = 'absbsbsbs123585s55s85s852s202s55s8';

    public function beforeFilter(Event $event) {
        // $this->Auth->allow([]);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $query = $this->Orders->find('all', [
            'conditions' => ['Orders.uid' => $this->Auth->user('id')]
        ]);
        //$orders = $query->all();
        $orders = $this->paginate($query);
        $this->set(compact('orders'));
        $this->set('_serialize', ['orders']);
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        Configure::write("debug", 0);
        $id = base64_decode($id);
        $order = $this->Orders->get($id, [
            'contain' => ['OrderItems']
        ]);

        $this->set('order', $order);
        $this->set('_serialize', ['order']);
    }

    public function schedules() {
        Configure::write("debug", 0);
        $this->loadModel('Users');
        $usrd = $this->Users->find('all', [
            'conditions' => ['Users.id' => $this->Auth->user('id')]
        ]);
        $gUser = $usrd->first();
        if ($gUser->zip == '') {
            return $this->redirect(['controller' => 'users', 'action' => 'addressupdate']);
        }
        if ($this->Auth->user('is_activeplan') == 1) {
            $this->loadModel('WeeklyShedules');
            $ws = $this->WeeklyShedules->find('all', [
                'conditions' => ['WeeklyShedules.uid' => $this->Auth->user('id')]
            ]);
            $ws = $ws->first();
            $this->loadModel('Orders');
            $order = $this->Orders->newEntity();
            $this->request->data['address_id'] = 0;
            $this->request->data['uid'] = $this->Auth->user('id');
            $this->request->data['delivery_status'] = 0;
            $this->request->data['enddate'] = date('Y-m-d', strtotime('+7 days'));
            $this->request->data['plan_id'] = $this->Auth->user('subscription_plan_id');
            $this->request->data['ip_address'] = $this->request->clientIp();
            $this->request->data['is_active'] = 1;
            $order = $this->Orders->patchEntity($order, $this->request->data);

            if ($this->Auth->user('subscription_plan_id') == 3 || $this->Auth->user('subscription_plan_id') == 2) {

                if ($ws) {
                    
                } else {
                    $this->Orders->save($order);
                    $orderid = $order->id;
                    $data = array("lunch-Sunday", "dinner-Sunday", "lunch-Monday", "dinner-Monday", "lunch-Tuesday", "dinner-Tuesday",
                        "lunch-Wednesday", "dinner-Wednesday", "lunch-Thursday", "dinner-Thursday", "lunch-Friday", "dinner-Friday",
                        "lunch-Saturday", "dinner-Saturday");
                    foreach ($data as $key => $value) {
                        $expday = explode("-", $value);
                        $this->request->data['foodtime'] = $expday[0];
                        $this->request->data['dayname'] = $expday[1];
                        $this->request->data['uid'] = $this->Auth->user('id');
                        $this->request->data['quantity'] = 0;
                        $this->request->data['order_id'] = $orderid;
                        $wshe = $this->WeeklyShedules->newEntity();
                        $wshe = $this->WeeklyShedules->patchEntity($wshe, $this->request->data);
                        $this->WeeklyShedules->save($wshe);
                    }
                }
            } else {
                if ($ws) {
                    
                } else {
                    $this->Orders->save($order);
                    $orderid = $order->id;
                    $data = array("dinner-Sunday", "dinner-Monday", "dinner-Tuesday",
                        "dinner-Wednesday", "dinner-Thursday", "dinner-Friday",
                        "dinner-Saturday");
                    foreach ($data as $key => $value) {
                        $expday = explode("-", $value);
                        $this->request->data['dayname'] = $expday[1];
                        $this->request->data['foodtime'] = $expday[0];
                        $this->request->data['uid'] = $this->Auth->user('id');
                        $this->request->data['quantity'] = 0;
                        $this->request->data['order_id'] = $orderid;
                        $wshe = $this->WeeklyShedules->newEntity();
                        $wshe = $this->WeeklyShedules->patchEntity($wshe, $this->request->data);
                        $this->WeeklyShedules->save($wshe);
                    }
                }
            }
            if ($this->Auth->user('id')) {
                $this->loadModel('WeeklyShedules');
                $ord = $this->WeeklyShedules->find('all', [
                    'conditions' => ['WeeklyShedules.order_id !=' => 0, 'WeeklyShedules.uid' => $this->Auth->user('id')]
                ]);
                $order = $this->WeeklyShedules->find('all', [
                    'conditions' => ['WeeklyShedules.uid' => $this->Auth->user('id')]
                ]);
                $order = $order->all();
            } else {
                $order = array();
            }
            $this->loadModel('Timeslots');
            $timeslot = $this->Timeslots->find('all');
            $this->set('order', $order);
            $this->set('timeslot', $timeslot->all());
            $this->set('_serialize', ['order']);
        } else {
            return $this->redirect(['controller' => 'users', 'action' => 'home']);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        Configure::write("debug", 0);
        if ($this->Auth->user('is_activeplan') == 1) {
            $order = $this->Orders->newEntity();
            if ($this->request->is('post')) {
                $orderquery = $this->Orders->find('all', [
                    'conditions' => ['Orders.uid' => $this->Auth->user('id')]
                ]);
                $orderdata = $orderquery->last();
                $order_id = $orderdata->id;
                $this->loadModel('UserPlans');
                $query = $this->UserPlans->find('all', ['conditions' => ['UserPlans.uid' => $this->Auth->user('id')]]);
                $user_plans = $query->first();
                $date = new DateTime();
                $date_a = date_format($date, 'Y-m-d H:i:s');
                $date_b = date_format($orderdata->enddate, 'Y-m-d H:i:s');
                $seconds = strtotime($date_a) - strtotime($date_b);
                $hours = floor(($seconds - ($days * 86400)) / 3600);
                $order_pid = $orderdata->plan_id;
                $data = $this->request->data['food'];
                $c_data = $this->request->data['cfood'];
//               print_r($this->request->data);
//               exit;
//                echo "<br/>";
//                print_r($c_data);               
                $cnt = count($data) + 2;
                if (($order_pid != $user_plans->subscription_plan_id) || ($hours > 0)) {
                    if (($user_plans->totalmeal - $user_plans->used_meal) >= ($cnt - 2)) {
                        if ($this->request->data['address'] == '') {
                            $this->Flash->success(__('The order could not be saved.You have not selected the address'));
                            return $this->redirect(['action' => 'index']);
                        }
                        if ($cnt - 2 == 0) {
                            $this->Flash->success(__('The order could not be saved.You have not selected the food'));
                            return $this->redirect(['action' => 'index']);
                        }
                        $this->request->data['address_id'] = $this->request->data['address'];
                        $this->request->data['uid'] = $this->Auth->user('id');
                        $this->request->data['delivery_status'] = 0;
                        $this->request->data['enddate'] = date('Y-m-d', strtotime('+7 days'));
                        $this->request->data['plan_id'] = $user_plans->subscription_plan_id;
                        $this->request->data['ip_address'] = $this->request->clientIp();
                        $order = $this->Orders->patchEntity($order, $this->request->data);
                        if ($this->Orders->save($order)) {
                            $this->loadModel('OrderItems');
                            $orderid = $order->id;
                            foreach ($data as $key => $value) {
                                $orderitem = $this->OrderItems->newEntity();
                                $exp = explode('-', $key);
                                $this->request->data['order_id'] = $orderid;
                                $this->request->data['foodtime'] = $exp[0];
                                $this->request->data['dayname'] = $exp[1];
                                foreach ($c_data as $k => $v) {
                                    if ($key == $k) {
//                                   /echo $v;
                                        $this->request->data['cfood_id'] = serialize($v);
                                        break;
                                    } else {
                                        $this->request->data['cfood_id'] = '';
                                    }
                                }

                                $this->request->data['product_id'] = $value;
                                $this->request->data['quantity'] = '1';
                                $orderitem = $this->OrderItems->patchEntity($orderitem, $this->request->data);
                                if (($exp[0] != 'submit') && ($exp[0] != 'address')) {
                                    $this->OrderItems->save($orderitem);
                                }
                            }
                            //exit;
                            $this->request->data['used_meal'] = $user_plans->used_meal + $cnt - 2;
                            $user_plans_id = $query->first();
                            $userplans = $this->UserPlans->get($user_plans_id['id'], [
                                'contain' => []
                            ]);
                            $userplans = $this->UserPlans->patchEntity($userplans, $this->request->data);
                            $this->UserPlans->save($userplans);
                            $this->Flash->success(__('The order has been saved.'));
                            return $this->redirect(['action' => 'index']);
                        }
                    } else {
                        $this->Flash->success(__('The order could not be saved. Please check your left meals and try to order your left limit ,not more than your left limit'));
                        return $this->redirect(['action' => 'index']);
                    }
                } else {
                    $this->Flash->success(__('You can not order again you have already order the food so please make week schedule'));
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                return $this->redirect(['controller' => 'users', 'action' => 'home']);
            }
        } else {
            return $this->redirect(['controller' => 'users', 'action' => 'home']);
        }
    }

    public function sheduleconfirm() {
        Configure::write("debug", 0);
        if ($this->Auth->user('is_activeplan') == 1) {
            $confirm['data'] = $_POST;
//                foreach ($data as $key => $value) { 
//                    echo $key;
//                    echo $value;
//                foreach($c_data as $k => $v){
//                      if($key==$k){
//                          $this->request->data['cfood_id']=  serialize($v);
//                          break;
//                      }else {
//                          $this->request->data['cfood_id']='';
//                      }
//                  }
//                }    
        }

        $this->set(compact('confirm'));
        $this->set('_serialize', ['confirm']);
    }

    public function addschedule() {
        Configure::write("debug", 0);
        if ($this->Auth->user('is_activeplan') == 1) {
            $order = $this->Orders->newEntity();
            if ($this->request->is('post')) {
                $orderquery = $this->Orders->find('all', [
                    'conditions' => ['Orders.uid' => $this->Auth->user('id')]
                ]);
                $orderdata = $orderquery->last();
                $order_id = $orderdata->id;
                $this->loadModel('UserPlans');
                $query = $this->UserPlans->find('all', ['conditions' => ['UserPlans.uid' => $this->Auth->user('id')]]);
                $user_plans = $query->first();
                $date = new DateTime();
                $date_a = date_format($date, 'Y-m-d H:i:s');
                $date_b = date_format($orderdata->enddate, 'Y-m-d H:i:s');
                $seconds = strtotime($date_a) - strtotime($date_b);
                $hours = floor(($seconds - ($days * 86400)) / 3600);
                $order_pid = $orderdata->plan_id;
                $data = $this->request->data['food'];
                $c_data = $this->request->data['cfood'];
//               print_r($this->request->data);
//               exit;
//                echo "<br/>";
//                print_r($c_data);               
                $cnt = count($data) + 2;
                if (($user_plans->totalmeal - $user_plans->used_meal) >= ($cnt - 2)) {
                    if ($this->request->data['address'] == '') {
                        $this->Flash->success(__('The order could not be saved.You have not selected the address'));
                        return $this->redirect(['action' => 'index']);
                    }
                    if ($cnt - 2 == 0) {
                        $this->Flash->success(__('The order could not be saved.You have not selected the food'));
                        return $this->redirect(['action' => 'index']);
                    }
                    if ($order_id) {
                        $this->loadModel('WeeklyShedules');

                        foreach ($data as $key => $value) {
                            $exp = explode('-', $key);

                            $this->request->data['order_id'] = $order_id;
                            $this->request->data['foodtime'] = $exp[0];
                            $this->request->data['dayname'] = $exp[1];
                            $ws = $this->WeeklyShedules->find('all', [
                                'conditions' => ['WeeklyShedules.uid' => $this->Auth->user('id'),
                                    'WeeklyShedules.foodtime' => $exp[0], 'WeeklyShedules.dayname' => $exp[1]]
                            ]);
                            $ws = $ws->first();
                            if ($ws) {
                                $orderitem = $this->WeeklyShedules->get($ws['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $orderitem = $this->WeeklyShedules->newEntity();
                            }
                            foreach ($c_data as $k => $v) {
                                if ($key == $k) {
//                                   /echo $v;
                                    $this->request->data['cfood_id'] = serialize($v);
                                    break;
                                } else {
                                    $this->request->data['cfood_id'] = '';
                                }
                            }

                            $this->request->data['product_id'] = $value;
                            $this->request->data['quantity'] = '1';
                            $this->request->data['dl_status'] = 0;
                            $this->request->data['address_id'] = $this->request->data['address'];
                            $orderitem = $this->WeeklyShedules->patchEntity($orderitem, $this->request->data);
                            if (($exp[0] != 'submit') && ($exp[0] != 'address')) {
                                $this->WeeklyShedules->save($orderitem);
                            }
                        }
                        //exit;
                        $this->request->data['used_meal'] = $user_plans->used_meal + $cnt - 2;
                        $user_plans_id = $query->first();
                        $userplans = $this->UserPlans->get($user_plans_id['id'], [
                            'contain' => []
                        ]);
                        $userplans = $this->UserPlans->patchEntity($userplans, $this->request->data);
                        $this->UserPlans->save($userplans);
                        $this->Flash->success(__('The order has been saved.'));
                        return $this->redirect(['action' => 'schedules']);
                    }
                } else {
                    $this->Flash->success(__('The order could not be saved. Please check your left meals and try to order your left limit ,not more than your left limit'));
                    return $this->redirect(['action' => 'schedules']);
                }
            } else {
                return $this->redirect(['controller' => 'users', 'action' => 'home']);
            }
        } else {
            return $this->redirect(['controller' => 'users', 'action' => 'home']);
        }
    }

    public function cfood() {
        Configure::write("debug", 0);
        if ($this->Auth->user('is_activeplan') == 1) {
            $order = $this->Orders->newEntity();
            if ($this->request->is('post')) {
                $orderquery = $this->Orders->find('all', [
                    'conditions' => ['Orders.uid' => $this->Auth->user('id')]
                ]);
                $orderdata = $orderquery->last();
                $order_id = $orderdata->id;
                $this->loadModel('UserPlans');
                $query = $this->UserPlans->find('all', ['conditions' => ['UserPlans.uid' => $this->Auth->user('id')]]);
                $user_plans = $query->first();
                $date = new DateTime();
                $date_a = date_format($date, 'Y-m-d H:i:s');
                $date_b = date_format($orderdata->enddate, 'Y-m-d H:i:s');
                $seconds = strtotime($date_a) - strtotime($date_b);
                //$hours   = floor(($seconds - ($days * 86400)) / 3600);
                $order_pid = $orderdata->plan_id;
                $data = $this->request->data['food'];
                $c_data = $this->request->data['cfood'];
                $cnt = count($data) + 2;
                if (($user_plans->totalmeal - $user_plans->used_meal) >= ($cnt - 2)) {
                    if ($this->request->data['address'] == '') {
                        $this->Flash->success(__('The order could not be saved.You have not selected the address'));
                        return $this->redirect(['action' => 'schedules']);
                    }
                    if ($cnt - 2 == 0) {
                        $this->Flash->success(__('The order could not be saved.You have not selected the food'));
                        return $this->redirect(['action' => 'schedules']);
                    }
                    ;
                    if ($order_id) {
                        $this->loadModel('WeeklyShedules');
                        foreach ($data as $key => $value) {
                            $exp = explode('-', $key);

                            $this->request->data['order_id'] = $order_id;
                            $this->request->data['foodtime'] = $exp[0];
                            $this->request->data['dayname'] = $exp[1];
                            $ws = $this->WeeklyShedules->find('all', [
                                'conditions' => ['WeeklyShedules.uid' => $this->Auth->user('id'),
                                    'WeeklyShedules.foodtime' => $exp[0], 'WeeklyShedules.dayname' => $exp[1]]
                            ]);
                            $ws = $ws->first();

                            if ($ws) {
                                $orderitem = $this->WeeklyShedules->get($ws['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $orderitem = $this->WeeklyShedules->newEntity();
                            }
                            foreach ($c_data as $k => $v) {
                                if ($key == $k) {
//                                   /echo $v;
                                    $this->request->data['cfood_id'] = serialize($v);
                                    break;
                                } else {
                                    $this->request->data['cfood_id'] = '';
                                }
                            }

                            $this->request->data['product_id'] = $value;
                            $this->request->data['quantity'] = '1';
                            $this->request->data['dl_status'] = 0;
                            $this->request->data['address_id'] = $this->request->data['address'];
                            $orderitem = $this->WeeklyShedules->patchEntity($orderitem, $this->request->data);
                            if (($exp[0] != 'submit') && ($exp[0] != 'address')) {
                                $this->WeeklyShedules->save($orderitem);
                            }
                        }
                        //exit;
                        $this->request->data['used_meal'] = $user_plans->used_meal + $cnt - 2;
                        $user_plans_id = $query->first();
                        $userplans = $this->UserPlans->get($user_plans_id['id'], [
                            'contain' => []
                        ]);
                        $userplans = $this->UserPlans->patchEntity($userplans, $this->request->data);
                        $this->UserPlans->save($userplans);
                        $this->Flash->success(__('The order has been saved.'));
                        return $this->redirect(['action' => 'schedules']);
                    }
                } else {
                    $this->Flash->success(__('The order could not be saved. Please check your left meals and try to order your left limit ,not more than your left limit'));
                    return $this->redirect(['action' => 'schedules']);
                }
            } else {
                return $this->redirect(['controller' => 'users', 'action' => 'home']);
            }
        } else {
            return $this->redirect(['controller' => 'users', 'action' => 'home']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $order = $this->Orders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->data);
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('order'));
        $this->set('_serialize', ['order']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function timeslot() {
        $this->loadModel('WeeklyShedules');
        $this->WeeklyShedules->updateAll(['timeslot' => $_POST['text']], ['id' => $_POST['timeslt']]);
        print_r($_POST);
        exit;
    }

}
