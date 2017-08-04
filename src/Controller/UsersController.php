<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use Cake\Datasource\ConnectionManager;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Routing\Router;
use Cake\Mailer\Email;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

    public $key = 'jhjhjhhjhhkfjhkfgjhfgh22222222222222222222kfgjhkfghjfghfgjhfghjkfgjh';

    public function beforeFilter(Event $event) {
        $this->Auth->allow(['add', 'login', 'logout', 'fblogin', 'home', 'plans', 'cart', 'confirm', 'signup', 'signupadd',
            'mobilefblogin', 'notify', 'paymentreturn', 'zipcode', 'mobilereturn', 'zipsession', 'calculator',
            'forgetpassword', 'reset', 'mobilecalc', 'rank', 'apiforgetpassword', 'verifyemail', 'mobilerank', 'vlogin', 'dboard']);
    }

    /**
     * working
     */
    public function plans() {
        Configure::write("debug", 0);
        $this->viewBuilder()->layout('default2');
        $id = $this->request->session()->read('user_id');
        if (empty($id)) {
            $id = $this->Auth->user('id');
            $this->request->session()->write('user_id', $id);
        }
        $id = $this->request->session()->read('user_id');
        $query = $this->Users->find('all', [
            'conditions' => ['Users.id' => $this->Auth->user('id')]
        ]);
        $User = $query->first();
        if ($User->zip == '') {
            return $this->redirect(['controller' => 'users', 'action' => 'addressupdate']);
        }
        if ($id) {
            if ($this->request->is('post')) {
                $this->request->session()->write('plan_id', $_POST['subscription_plan_id']);
                return $this->redirect(['action' => 'cart']);
            } else {
                $this->loadModel('SubscriptionPlans');
                $user = $this->SubscriptionPlans->find('all', [
                    'contain' => []
                ]);
                $this->set('allplans', $user->all());
            }
        }
    }

    public function cart() {
        $this->viewBuilder()->layout('default2');
        $uid = $this->request->session()->read('user_id');
        $pid = $this->request->session()->read('plan_id');
        if ($this->request->is('post')) {
            
        } else {
            if (empty($uid)) {
                $uid = $this->Auth->user('id');
            }
            if ($uid && $pid) {
                $this->loadModel('SubscriptionPlans');
                $query = $this->SubscriptionPlans->find('all', [
                    'conditions' => ['SubscriptionPlans.id' => $pid]]);
                $User = $query->first();
                $this->loadModel('Carts');
                $this->Carts->deleteAll(['Carts.uid' => $uid]);
                $cart = $this->Carts->newEntity();
                $this->request->data['uid'] = $uid;
                $this->request->data['subscription_plans_id'] = $pid;
                $this->request->data['subtotal'] = $User['price'];
                $this->request->data['total'] = $User['price'];
                $this->request->data['pcode'] = "";
                $carts = $this->Carts->patchEntity($cart, $this->request->data);   
       
                $result=$this->Carts->save($carts);
                
                $this->loadModel('UserPlans');
                $UserPlans = $this->UserPlans->find('all', [
                    'conditions' => ['UserPlans.uid' => $uid]]);
                $gUserpdata = $UserPlans->first();
                if ($gUserpdata) {
                    $p = "true";
                } else {
                    $p = "false";
                }
                $this->set('cart_id', $result->id);
                $this->set('data', $User);
                $this->set('uplanp', $p);
                $this->set('date', date("M-d-y"));
                $this->set('uid', $uid);
                $this->set('pid', $pid);
            } else {
                return $this->redirect(['action' => 'home']);
            }
        }
    }

    public function confirm() {
        $this->viewBuilder()->layout('default2');
        // $this->request->session()->delete('user_id');
    }

    /**
     * 
     */
    public function home() {
        $this->request->session()->write('venid_home', 5);
      /// echo "The time is " . date("h:i:sa"); exit;
        Configure::write("debug", 0);
        //$this->request->session()->read('venid_home');
        $udata = $this->Auth->user();
        if ($udata) {
            if ($udata['subscription_plan_id'] == 0) {
                $this->request->session()->write('user_id', $udata['id']);
                return $this->redirect(['action' => 'plans']);
            } else if ($udata['is_activeplan'] == 0) {
                $this->request->session()->write('user_id', $udata['id']);
                return $this->redirect(['action' => 'plans']);
            } else {
                return $this->redirect(['action' => 'product']);
            }
        }
        if ($this->request->is('post')) {
            $this->request->session()->write('search_plan_id', $_POST['srch_id']);
        }
        $ven_id = $this->request->session()->read('venid');

        $ven_id_home = $this->request->session()->read('venid_home');
        if ($ven_id) {
            if (count($ven_id) == 1) {
                $allvenid = $ven_id;
            } else {
                $allvenid = $ven_id;
            }
            $this->loadModel('Products');
            $Products = $this->Products->find('all', [
                'conditions' => ['Products.user_id IN' => $allvenid]
            ]);
            $allpro = $Products->all();
            foreach ($allpro as $ap) {
                $spi[] = $ap->subscription_plan_id;
            }
            $unqspi = array_unique($spi);
            $this->loadModel('SubscriptionPlans');
            $plans = $this->SubscriptionPlans->find('all', [
                'conditions' => ['SubscriptionPlans.id IN' => $unqspi]
            ]);

            $this->loadModel('Days');
            $days = $this->Days->find('all')->contain(['Products' => function ($q) {
                    $id = $this->request->session()->read('search_plan_id');
                    $ven_id = $this->request->session()->read('venid');
                    if (count($ven_id) == 1) {
                        $allvenid = $ven_id;
                    } else {
                        $allvenid = $ven_id;
                    }

                    if ($id) {
                        $id;
                    } else {
                        $id = 1;
                    }
                    return $q->where(['Products.subscription_plan_id' => $id, 'Products.user_id IN' => $allvenid]);
                }]);



                    $this->set('days', $days->all());

                    $this->set('allplans', $plans->all());
                    if ($this->request->session()->read('search_plan_id')) {
                        $this->set('srchplan', $this->request->session()->read('search_plan_id'));
                    } else {
                        $this->set('srchplan', 1);
                    }
                } else if ($ven_id_home) {
                    if (count($ven_id_home) == 1) {
                        $allvenid = $ven_id_home;
                    } else {
                        $allvenid = explode(',', $ven_id_home);
                    }
                    $this->loadModel('Products');
                    $Products = $this->Products->find('all', [
                        'conditions' => ['Products.user_id IN' => $allvenid]
                    ]);
                    $allpro = $Products->all();
                    foreach ($allpro as $ap) {
                        $spi[] = $ap->subscription_plan_id;
                    }
                    $unqspi = array_unique($spi);
                    $this->loadModel('SubscriptionPlans');
                    $plans = $this->SubscriptionPlans->find('all', [
                        'conditions' => ['SubscriptionPlans.id IN' => $unqspi]
                    ]);

                    $this->loadModel('Days');
                    $days = $this->Days->find('all')->contain(['Products' => function ($q) {
                            $id = $this->request->session()->read('search_plan_id');
                            $ven_id_home = $this->request->session()->read('venid_home');
                            if (count($ven_id_home) == 1) {
                                $allvenid = $ven_id_home;
                            } else {
                                $allvenid = explode(',', $ven_id_home);
                            }

                            if ($id) {
                                $id;
                            } else {
                                $id = 1;
                            }
                            return $q->where(['Products.subscription_plan_id' => $id, 'Products.user_id IN' => $allvenid]);
                        }]);

                            //print_r($days->all());
                            //exit;

                            $this->set('days', $days->all());

                            $this->set('allplans', $plans->all());
                            if ($this->request->session()->read('search_plan_id')) {
                                $this->set('srchplan', $this->request->session()->read('search_plan_id'));
                            } else {
                                $this->set('srchplan', 1);
                            }
                        }
                    }

                    public function myaccount() {
                        Configure::write("debug", 0);
                        $query = $this->Users->find('all', [
                            'conditions' => ['Users.id' => $this->Auth->user('id')]
                        ]);
                        $User = $query->first();
                        if ($User->my_r_code == NULL) {
                            $pcode = strtoupper(str_replace(' ', '',$User->fname) . '-' . substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 3));
                            $this->Users->updateAll(array('my_r_code' => $pcode), array('id' => $this->Auth->user('id')));
                        }
                        if ($User->zip == '') {
                            return $this->redirect(['controller' => 'users', 'action' => 'addressupdate']);
                        }
                        if ($this->Auth->user('is_activeplan') == 1) {
                            $id = $this->Auth->user('id');
                            $user = $this->Users->get($id, [
                                'contain' => ['SubscriptionPlans', 'Wallets']
                            ]);

                            // print_r($user);
                            //exit;
                            $address = str_replace(' ', '', $User->zip);
                            $googledata = $this->getLetLong($address);
                            $lat = $googledata['latitude'];
                            $long = $googledata['longitude'];
                            $users = $this->Users->find('all', [
                                'conditions' => ['Users.role' => 'vendor']
                            ]);
                            $users = $users->all();
                            foreach ($users as $d) {
                                $dst = $this->distance($lat, $long, $d->lat, $d->long, '"M"');
                                if ($dst < $d->radius) {
                                    $venid[] = $d->id;
                                }
                            }
                            $this->request->session()->write('vendor_ids', $venid);

                            $this->set('user', $user);
                            $this->set('_serialize', ['user']);
                        } else {
                            return $this->redirect(['controller' => 'users', 'action' => 'home']);
                        }
                    }

                    public function mysubscription() {
                        if ($this->Auth->user('is_activeplan') == 1) {
                            $id = $this->Auth->user('id');
                            $user = $this->Users->get($id, [
                                'contain' => ['SubscriptionPlans']
                            ]);
                            $this->loadModel('UserPlans');
                            $query = $this->UserPlans->find('all', ['conditions' => ['UserPlans.uid' => $id]]);
                            $data = $query->first();
                            $this->set('uplan', $data);
                            $this->set('user', $user);
                            $this->set('_serialize', ['user', 'uplan']);
                        } else {
                            return $this->redirect(['controller' => 'users', 'action' => 'home']);
                        }
                    }

                    public function changefood($id) {
                        $id = base64_decode($id);

                        if ($this->Auth->user('is_activeplan') == 1) {
                            $this->loadModel('Days');
                            $days = $this->Days->find('all')->contain(['Products' => function ($q) {
                                    $ven_id = $this->request->session()->read('vendor_ids');
                                    if (count($ven_id) == 1) {
                                        $allvenid = $ven_id;
                                    } else {

                                        $allvenid = $ven_id;
                                    }
                                    return $q->where(['Products.subscription_plan_id' => $this->Auth->user('subscription_plan_id'), 'Products.user_id IN' => $allvenid]);
                                }]);

                                    $alld = $days->toArray();
                                    $cnt = count($alld);
                                    for ($i = 0; $i < $cnt; $i++) {
                                        if ($alld[$i]['name'] == $id) {
                                            
                                        } else {
                                            unset($alld[$i]);
                                        }
                                    }
                                    $this->loadModel('Addresses');
                                    $query = $this->Addresses->find('all', [
                                        'conditions' => ['Addresses.user_id' => $this->Auth->user('id')]
                                    ]);
                                    $address = $query->all();

                                    $this->set('days', $alld);
                                    $this->set('address', $address);
                                    $this->set('userplans', $this->Auth->user('subscription_plan_id'));
                                } else {
                                    return $this->redirect(['controller' => 'users', 'action' => 'home']);
                                }
                            }

                            /**
                             * $userplans id=1,2,3
                             * $product['category_id']=8,9 =lunch dinner
                             */
                            public function product() {
                                $this->request->session()->delete('vendor_ids');
                                $this->loadModel('Users');
                                $usrd = $this->Users->find('all', [
                                    'conditions' => ['Users.id' => $this->Auth->user('id')]
                                ]);
                                $gUser = $usrd->first();

                                if ($gUser->zip == '') {
                                    $this->Flash->success(__('Please update your location'));
                                    return $this->redirect(['controller' => 'users', 'action' => 'addressupdate']);
                                }
                                if ($this->Auth->user('is_activeplan') == 1) {
                                    $this->loadModel('UserPlans');
                                    $usr_plans = $this->UserPlans->find('all', [
                                        'conditions' => ['UserPlans.uid' => $this->Auth->user('id')]
                                    ]);
                                    if ($usr_plans->first()->subscription_plan_id != $this->Auth->user('subscription_plan_id')) {
                                        if ($this->Auth->logout()) {
                                            return $this->redirect(['action' => 'home']);
                                        }
                                    }
                                    $id = $this->Auth->user('id');
                                    $user = $this->Users->get($id, [
                                        'contain' => ['SubscriptionPlans']
                                    ]);
                                    $address = str_replace(' ', '', $gUser->zip);
                                    $googledata = $this->getLetLong($address);
                                    $lat = $googledata['latitude'];
                                    $long = $googledata['longitude'];
                                    $users = $this->Users->find('all', [
                                        'conditions' => ['Users.role' => 'vendor']
                                    ]);
                                    $users = $users->all();
                                    $venid = array();
                                    foreach ($users as $d) {
                                        $dst = $this->distance($lat, $long, $d->lat, $d->long, '"M"');
                                        if ($dst < $d->radius) {
                                            $venid[] = $d->id;
                                        }
                                    }
                                    if (empty($venid)) {
                                        $this->Flash->success(__('There is no any vendor please update your location'));
                                        return $this->redirect(['controller' => 'users', 'action' => 'addressupdate']);
                                    }
                                    $this->request->session()->write('vendor_ids', $venid);
                                    $this->loadModel('Days');
                                    $days = $this->Days->find('all')->contain(['Products' => function ($q) {
                                            $ven_id = $this->request->session()->read('vendor_ids');
                                            if (count($ven_id) == 1) {
                                                $allvenid = $ven_id;
                                            } else {
                                                $allvenid = $ven_id;
                                            }
                                            return $q->where(['Products.subscription_plan_id' => $this->Auth->user('subscription_plan_id'), 'Products.user_id IN' => $allvenid]);
                                        }]);
                                            $this->loadModel('Addresses');
                                            $query = $this->Addresses->find('all', [
                                                'conditions' => ['Addresses.user_id' => $this->Auth->user('id')]
                                            ]);
                                            $address = $query->all();
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
                                            $this->set('days', $days->all());
                                            $this->set('address', $address);
                                            $this->set('userplans', $this->Auth->user('subscription_plan_id'));
                                        } else {
                                            return $this->redirect(['controller' => 'users', 'action' => 'home']);
                                        }
                                    }

                                    /**
                                     * $userplans id=1,2,3
                                     * $product['category_id']=8,9 =lunch dinner
                                     */
                                    public function newschedule() {
                                        if ($this->Auth->user('is_activeplan') == 1) {
                                            $this->loadModel('Days');
                                            $days = $this->Days->find('all')->contain(['Products' => function ($q) {
                                                    return $q->where(['Products.subscription_plan_id' => $this->Auth->user('subscription_plan_id')]);
                                                }]);
                                                    $this->loadModel('Addresses');
                                                    $query = $this->Addresses->find('all', [
                                                        'conditions' => ['Addresses.user_id' => $this->Auth->user('id')]
                                                    ]);
                                                    $address = $query->all();
                                                    $this->set('days', $days->all());
                                                    $this->set('address', $address);
                                                    $this->set('userplans', $this->Auth->user('subscription_plan_id'));
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
                                                $user = $this->Users->newEntity();
                                                if ($this->request->is('post')) {
                                                    if ($_POST['fname'] == '') {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Please enter your First name!";
                                                    } else if ($_POST['lname'] == '') {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Please enter your Last name!";
                                                    } else if ($_POST['email'] == '') {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Please enter your email!";
                                                    } else if ($_POST['password'] == '') {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Please enter your password!";
                                                    } else if (strlen($_POST["password"]) < '8') {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Your Password Must Contain At Least 8 Characters!";
                                                    } else if (!preg_match("#[0-9]+#", $_POST["password"])) {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Your Password Must Contain At Least 1 Number!";
                                                    } else if (!preg_match("#[A-Z]+#", $_POST['password'])) {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Your Password Must Contain At Least 1 Capital Letter!";
                                                    } else if ($_POST["password"] != $_POST["cpassword"]) {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Please Check You've Entered Or Confirmed Your Password";
                                                    } else if ($_POST['phone'] == '') {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Please enter your phone!";
                                                    } else if ($_POST['zip'] == '') {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Please enter your food location!";
                                                    } else {
                                                        $this->request->data['fname'] = $_POST['fname'];
                                                        $this->request->data['lname'] = $_POST['lname'];
                                                        $this->request->data['username'] = $_POST['email'];
                                                        $this->request->data['password'] = $_POST['password'];
                                                        $this->request->data['email'] = $_POST['email'];
                                                        $this->request->data['phone'] = $_POST['phone'];
                                                        $this->request->data['zip'] = $_POST['zip'];
                                                        $this->request->data['role'] = "user";
                                                        $user = $this->Users->patchEntity($user, $this->request->data);
                                                        if ($this->Users->save($user)) {
                                                            $this->request->session()->write('user_id', $user['id']);
                                                            $burl = Router::fullbaseUrl();
                                                            $hash = md5(time() . rand(111999999999999999999999999, 99999999999999999999999999999999999999999));
                                                            $url = Router::url(['controller' => 'Users', 'action' => 'verifyemail' . '/' . $hash]);
                                                            $this->Users->updateAll(array('tokenhash' => $hash), array('id' => $user->id));
                                                            $ms = "Welcome to Plait<br/>";
                                                            $ms.='<a href=' . $burl . $url . '>Click here to verify your email</a><br/>';
                                                            $email = new Email('default');
                                                            $email->from(['noreply@plait.co.za' => 'Plait'])
                                                                    ->emailFormat('html')
                                                                    ->template('default', 'default')
                                                                    ->to($user->username)
                                                                    ->subject('Thanks for register to our website')
                                                                    ->send($ms);
                                                            $response['data'] = $user;
                                                            $response['isSucess'] = "true";
                                                            $response['msg'] = "thanks for register!Please verify Email to continue your account";
                                                        } else {
                                                            $response['isSucess'] = "false";
                                                            $response['msg'] = "The user could not be saved. Please, try with new Email";
                                                        }
                                                    }
                                                } else {
                                                    return $this->redirect(['controller' => 'users', 'action' => 'home']);
                                                }
                                                $this->set(compact('response'));
                                                $this->set('_serialize', ['response']);
                                            }

                                            /**
                                             * Add method
                                             *
                                             * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
                                             */
                                            public function signup() {
                                                $this->viewBuilder()->layout('default2');
                                                if ($this->request->is('post')) {
                                                    $this->request->session()->write('plan_id', $_POST['subscription_plan_id']);
                                                } else {
                                                    return $this->redirect(['controller' => 'users', 'action' => 'home']);
                                                }
                                            }

                                            public function signupadd() {
                                                $user = $this->Users->newEntity();
                                                if ($this->request->is('post')) {
                                                    if ($_POST['fname'] == '') {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Please enter your First name!";
                                                    } else if ($_POST['lname'] == '') {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Please enter your Last name!";
                                                    } else if ($_POST['email'] == '') {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Please enter your email!";
                                                    } else if ($_POST['password'] == '') {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Please enter your password!";
                                                    } else if (strlen($_POST["password"]) < '8') {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Your Password Must Contain At Least 8 Characters!";
                                                    } else if (!preg_match("#[0-9]+#", $_POST["password"])) {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Your Password Must Contain At Least 1 Number!";
                                                    } else if (!preg_match("#[A-Z]+#", $_POST['password'])) {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Your Password Must Contain At Least 1 Capital Letter!";
                                                    } else if ($_POST["password"] != $_POST["cpassword"]) {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Please Check You've Entered Or Confirmed Your Password";
                                                    } else if ($_POST['phone'] == '') {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Please enter your phone!";
                                                    } else if ($_POST['zip'] == '') {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Please enter your food location!";
                                                    } elseif (empty($this->request->session()->read('plan_id'))) {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "You have not selected any plan so select before plan";
                                                    } else {
                                                        $this->request->data['fname'] = $_POST['fname'];
                                                        $this->request->data['lname'] = $_POST['lname'];
                                                        $this->request->data['username'] = $_POST['email'];
                                                        $this->request->data['password'] = $_POST['password'];
                                                        $this->request->data['email'] = $_POST['email'];
                                                        $this->request->data['phone'] = $_POST['phone'];
                                                        $this->request->data['subscription_plan_id'] = $this->request->session()->read('plan_id');
                                                        $this->request->data['role'] = "user";
                                                        $user = $this->Users->patchEntity($user, $this->request->data);
                                                        if ($this->Users->save($user)) {
                                                            $this->request->session()->write('user_id', $user['id']);
                                                            $burl = Router::fullbaseUrl();
                                                            $hash = md5(time() . rand(111999999999999999999999999, 99999999999999999999999999999999999999999));
                                                            $url = Router::url(['controller' => 'Users', 'action' => 'verifyemail' . '/' . $hash]);
                                                            $this->Users->updateAll(array('tokenhash' => $hash), array('id' => $user->id));
                                                            $ms = "Welcome to Plait<br/>";
                                                            $ms.='<a href=' . $burl . $url . '>Click here to verify your email</a><br/>';
                                                            $email = new Email('default');
                                                            $email->from(['noreply@plait.co.za' => 'Plait'])
                                                                    ->emailFormat('html')
                                                                    ->template('default', 'default')
                                                                    ->to($user->username)
                                                                    ->subject('Thanks for register to our website')
                                                                    ->send($ms);
                                                            $response['data'] = $user;
                                                            $response['isSucess'] = "true";
                                                            $response['msg'] = "thanks for register!Please verify Email to continue your account";
                                                        } else {
                                                            $response['isSucess'] = "false";
                                                            $response['msg'] = "The user could not be saved. Please, try with new Email";
                                                        }
                                                    }
                                                } else {
                                                    return $this->redirect(['controller' => 'users', 'action' => 'home']);
                                                }
                                                $this->set(compact('response'));
                                                $this->set('_serialize', ['response']);
                                            }

                                            public function verifyemail($token) {
                                                $this->viewBuilder()->layout('default2');
                                                $query = $this->Users->find('all', ['conditions' => ['Users.tokenhash' => $token]]);
                                                $data = $query->first();
                                                if ($data) {
                                                    $this->request->data['email_status'] = "1";
                                                    $this->request->data['tokenhash'] = md5(time() . rand(111999999999999999999999999999, 999999999999999999999999999999999));
                                                    $user = $this->Users->get($data->id, [
                                                        'contain' => []
                                                    ]);
                                                    $user = $this->Users->patchEntity($user, $this->request->data);
                                                    if ($this->Users->save($user)) {
                                                        $this->Flash->success(__('You have successfully verified your email'));
                                                        return;
                                                    }
                                                } else {
                                                    $this->Flash->success(__('Invalid Token, try again'));
                                                    return;
                                                }
                                                $this->set(compact('response'));
                                                $this->set('_serialize', ['response']);
                                            }

                                            /**
                                             * Edit method
                                             *
                                             * @param string|null $id User id.
                                             * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
                                             * @throws \Cake\Network\Exception\NotFoundException When record not found.
                                             */
                                            public function edit() {
                                                //$id = Security::decrypt($id, $this->key);
                                                $id = $this->Auth->user('id');
                                                $user = $this->Users->get($id, [
                                                    'contain' => []
                                                ]);

                                                if ($this->request->is(['patch', 'post', 'put'])) {
                                                    $user = $this->Users->patchEntity($user, $this->request->data);
                                                    if ($this->Users->save($user)) {
                                                        $this->Flash->success(__('The user has been saved.'));

                                                        return $this->redirect(['action' => 'myaccount']);
                                                    } else {
                                                        $this->Flash->error(__('The user could not be saved. Please, try again.'));
                                                    }
                                                }
                                                $this->set(compact('user'));
                                                $this->set('_serialize', ['user']);
                                            }

                                            public function addressupdate() {
                                                $this->viewBuilder()->layout('default2');
                                                Configure::write("debug", 0);
                                                if ($_POST['zip'] == '') {
                                                    $response['isSucess'] = "false";
                                                    $response['msg'] = "Please enter your food location!";
                                                } else {
                                                    $id = $this->Auth->user('id');
                                                    $user = $this->Users->get($id, [
                                                        'contain' => []
                                                    ]);
                                                    $this->request->data['zip'] = $_POST['zip'];
                                                    if ($this->request->is(['patch', 'post', 'put'])) {
                                                        $user = $this->Users->patchEntity($user, $this->request->data);
                                                        if ($this->Users->save($user)) {
                                                            $response['isSucess'] = "1";
                                                            $response['msg'] = "You address has been updated";
                                                        } else {
                                                            $response['isSucess'] = "0";
                                                            $response['msg'] = "Error";
                                                        }
                                                    }
                                                }
                                                $this->set(compact('response'));
                                                $this->set('_serialize', ['response']);
                                            }

                                            /**
                                             * Delete method
                                             *
                                             * @param string|null $id User id.
                                             * @return \Cake\Network\Response|null Redirects to index.
                                             * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
                                             */
//                    public function delete($id = null) {
//                        $this->request->allowMethod(['post', 'delete']);
//                        $user = $this->Users->get($id);
//                        if ($this->Users->delete($user)) {
//                            $this->Flash->success(__('The user has been deleted.'));
//                        } else {
//                            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
//                        }
//
//                        return $this->redirect(['action' => 'index']);
//                    }

                                            /**
                                             * login method
                                             * @author ashutoshdev
                                             * @return type
                                             */
                                            public function login() {
                                                if ($this->request->is('post')) {
                                                    $this->request->session()->delete('user_id');
                                                    if ($_POST['username'] == '') {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Please enter your username!";
                                                    } else if ($_POST['password'] == '') {
                                                        $response['isSucess'] = "false";
                                                        $response['msg'] = "Please enter your password!";
                                                    } else {
                                                        $this->request->data['username'] = $_POST['username'];
                                                        $this->request->data['password'] = $_POST['password'];
                                                        $user = $this->Auth->identify();
                                                        if ($user) {
                                                            if ($user['email_status'] == 0) {
                                                                $this->Auth->logout();
                                                                $response['data'] = "no data";
                                                                // $response['user'] = $user['email_status'];
                                                                $response['isSucess'] = "false";
                                                                $response['msg'] = "You have not verified  your email";
                                                            } else {
                                                                $this->Auth->setUser($user);
                                                                $response['data'] = $this->Auth->user();
                                                                $response['isSucess'] = "true";
                                                                $response['msg'] = "Logged In successfully";
                                                            }
                                                        } else {
                                                            $response['data'] = "no data";
                                                            $response['isSucess'] = "false";
                                                            $response['msg'] = "Wrong username && password! please try again!";
                                                        }
                                                    }
                                                } else {
                                                    return $this->redirect(['controller' => 'users', 'action' => 'home']);
                                                }
                                                $this->set(compact('response'));
                                                $this->set('_serialize', ['response']);
                                            }

                                            /**
                                             * logout method
                                             * @author ashutoshdev
                                             * @return type
                                             */
                                            public function logout() {
                                                if ($this->Auth->logout()) {
                                                    return $this->redirect(['controller' => 'users', 'action' => 'home']);
                                                }
                                            }

                                            public function fblogin() {
                                                $user = $this->Users->newEntity();
                                                if ($this->request->is('post')) {
                                                    $this->request->session()->delete('user_id');
                                                    if ($_POST['email'] == '') {
                                                        $_POST['email'] = $_POST['fb_id'] . '@facebook.com';
                                                    }
                                                    $this->request->data['fname'] = $_POST['name'];
                                                    $this->request->data['username'] = $_POST['email'];
                                                    $this->request->data['fb_id'] = $_POST['fb_id'];
                                                    $this->request->data['password'] = $_POST['email'] . 'plaitwebsite';
                                                    $this->request->data['email'] = $_POST['email'];
                                                    $this->request->data['role'] = "user";
                                                    $this->request->data['status'] = "1";
                                                    $this->request->data['email_status'] = "1";
                                                    $user = $this->Users->patchEntity($user, $this->request->data);
                                                    if ($this->Users->save($user)) {
                                                        $user = $this->Auth->identify();
                                                        $this->Auth->setUser($user);
                                                    } else {
                                                        $query = $this->Users->find('all', [
                                                            'conditions' => ['Users.fb_id' => $_POST['fb_id']]
                                                        ]);
                                                        $this->request->data['password'] = $_POST['email'] . 'plaitwebsite';
                                                        $User = $query->first();
                                                        $user = $this->Users->get($User['id'], [
                                                            'contain' => []
                                                        ]);
                                                        $user = $this->Users->patchEntity($user, $this->request->data);
                                                        $this->Users->save($user);
                                                        $user = $this->Auth->identify();
                                                        $this->Auth->setUser($user);
                                                    }
                                                }
                                                $this->set(compact('response'));
                                                $this->set('_serialize', ['response']);
                                            }

                                            public function notify() {
                                                Configure::write("debug", 2);
                                                // $a="PAY_REQUEST_ID=CA63ABB7-87CA-451D-B620-8A272029027B&TRANSACTION_STATUS=1&CHECKSUM=27e4f9c7e5ef83854e011e82c4dd6f06";
                                                $a = file_get_contents("php://input");
                                                ob_start();
                                                echo $a;
                                                $c = ob_get_clean();
                                                $fc = fopen('txtfile' . DS . 'data.txt', 'w');
                                                fwrite($fc, $c);
                                                fclose($fc);
                                                $d = explode('&', $a);
                                                $data = explode('=', $d[0]);
                                                $checksum = explode('CHECKSUM=', $a);
                                                $status = explode('TRANSACTION_STATUS=', $a);
                                                $confirmstatus = substr($status[1], 0, 1);
                                                if ($confirmstatus == 1) {
                                                    $this->loadModel('PaymentHistories');
                                                    $query = $this->PaymentHistories->find('all', [
                                                        'conditions' => ['PaymentHistories.txn_id' => $data[1]]
                                                    ]);
                                                    $this->request->data['created'] = date('Y-m-d H:i:s');
                                                    $this->request->data['checksum_id'] = $checksum[1];
                                                    $this->request->data['status'] = 1;
                                                    $Carts = $query->first();
                                                    $carts = $this->PaymentHistories->get($Carts['id'], [
                                                        'contain' => []
                                                    ]);
                                                    //print_r($this->request->data);
                                                    //exit;
                                                    $carts = $this->PaymentHistories->patchEntity($carts, $this->request->data);
                                                    $this->PaymentHistories->save($carts);
                                                    //exit;
                                                    $crt_id = $carts->cart_id;
                                                    $uid = $carts->uid;
                                                    $this->loadModel('Carts');
                                                    $crt = $this->Carts->find('all', [
                                                        'conditions' => ['Carts.id' => $crt_id],
                                                        'contain' => ['SubscriptionPlans']
                                                    ]);
                                                    $crt_data = $crt->first();
                                                    //print_r($crt_data);
                                                    $this->loadModel('UsePromocodes');
                                                    $UsePromocodes = $this->UsePromocodes->find('all', [
                                                        'conditions' => ['UsePromocodes.uid' => $uid, 'UsePromocodes.promocode' => $crt_data->pcode]
                                                    ]);
                                                    $UsePromocodes = $UsePromocodes->first();
                                                    $this->request->data['uid'] = $uid;
                                                    $this->request->data['total'] = $crt_data->total;
                                                    $this->request->data['subtotal'] = $crt_data->subtotal;
                                                    $this->request->data['promocode'] = $crt_data->pcode;
                                                    if ($UsePromocodes) {
                                                        if ($UsePromocodes->promocode == $crt_data->pcode) {
                                                            $this->request->data['noofuse'] = $UsePromocodes->noofuse + 1;
                                                        }
                                                        $UsePromocodes = $this->UsePromocodes->get($UsePromocodes['id'], [
                                                            'contain' => []
                                                        ]);
                                                    } else {
                                                        $this->request->data['noofuse'] = 1;
                                                        $UsePromocodes = $this->UsePromocodes->newEntity();
                                                    }

                                                    $UsePromocodes = $this->UsePromocodes->patchEntity($UsePromocodes, $this->request->data);
                                                    $this->UsePromocodes->save($UsePromocodes);

                                                    $i = $crt_data->subscription_plan->day;
                                                    $this->request->data['totalmeal'] = $crt_data->subscription_plan->meals;
                                                    $this->request->data['subscription_plan_id'] = $crt_data->subscription_plan->id;
                                                    $this->request->data['created'] = date('Y-m-d H:i:s');
                                                    $this->request->data['expireon'] = date('Y-m-d H:i:s', strtotime("+" . $i . "days"));
                                                    $this->request->data['used_meal'] = 0;
                                                    $this->request->data['uid'] = $uid;
                                                    $this->request->data['is_active'] = 1;
                                                    $this->loadModel('UserPlans');
                                                    $uplans = $this->UserPlans->find('all', [
                                                        'conditions' => ['UserPlans.uid' => $uid]
                                                    ]);
                                                    $uplans = $uplans->first();
                                                    if ($uplans) {
                                                        $uplans = $this->UserPlans->get($uplans['id'], [
                                                            'contain' => []
                                                        ]);
                                                    } else {
                                                        $uplans = $this->UserPlans->newEntity();
                                                    }

                                                    $uplans = $this->UserPlans->patchEntity($uplans, $this->request->data);
                                                    $this->UserPlans->save($uplans);

                                                    $query = $this->Users->find('all', [
                                                        'conditions' => ['Users.id' => $uid]
                                                    ]);
                                                    $this->request->data['subscription_plan_id'] = $crt_data->subscription_plan->id;
                                                    $this->request->data['is_activeplan'] = 1;
                                                    $User = $query->first();
                                                    $user = $this->Users->get($User['id'], [
                                                        'contain' => []
                                                    ]);
                                                    $user = $this->Users->patchEntity($user, $this->request->data);
                                                    $this->Users->save($user);
                                                    $this->loadModel('WeeklyShedules');
                                                    $this->WeeklyShedules->deleteAll(['WeeklyShedules.uid' => $uid]);
                                                    if ($user->use_r_code) {
                                                        $users = $this->Users->find('all', [
                                                            'conditions' => ['Users.my_r_code' => $user->use_r_code]
                                                        ]);
                                                        $users_data = $users->first();
                                                        if ($users_data) {
                                                            $this->loadModel('Wallets');
                                                            $wallet = $this->Wallets->find('all', [
                                                                'conditions' => ['Wallets.uid' => $users_data->id]
                                                            ]);
                                                            $last_w = $wallet->first();
                                                            $this->loadModel('Referrals');
                                                            $referrals = $this->Referrals->find('all');
                                                            $last_r = $referrals->last();
                                                            if ($last_w) {
                                                                $points = $last_w->points + $last_r->refferby;
                                                                $this->Wallets->updateAll(array('points' => $points), array('uid' => $users_data->id));
                                                                $this->Users->updateAll(array('use_r_code' => 'use' . $user->use_r_code), array('id' => $uid));
                                                            } else {
                                                                $newwall = $this->Wallets->newEntity();
                                                                $this->request->data['points'] = 0;
                                                                $this->request->data['uid'] = $users_data->id;
                                                                $referral = $this->Wallets->patchEntity($newwall, $this->request->data);
                                                                $this->Wallets->save($referral);
                                                                $points = $last_r->refferby;
                                                                $this->Wallets->updateAll(array('points' => $points), array('uid' => $users_data->id));
                                                                $this->Users->updateAll(array('use_r_code' => 'use' . $user->use_r_code), array('id' => $uid));
                                                            }
                                                        }
                                                    }
                                                }
                                                exit;
                                            }

                                            public function mobilereturn() {

//                                        $uid = $this->Auth->user('id');
//                                        if ($uid) {
//                                            $this->loadModel('PaymentHistories');
//                                            $query = $this->PaymentHistories->find('all', [
//                                                'conditions' => ['PaymentHistories.uid' => $uid]
//                                            ]);
//                                            $uplans = $query->last();
//                                        } else {
//                                            $uplans['msg'] = "Please login to see the txn id";
//                                        }
//                                        $this->set(compact('uplans'));
//                                        $this->set('_serialize', ['uplans']);
                                            }

                                            public function paymentreturn() {
$this->viewBuilder()->layout('default2');
                                                $uid = $this->Auth->user('id');
                                                if ($uid) {
                                                    $this->loadModel('PaymentHistories');
                                                    $query = $this->PaymentHistories->find('all', [
                                                        'conditions' => ['PaymentHistories.uid' => $uid]
                                                    ]);
                                                    $uplans = $query->last();
                                                    $uplans['d'] = "1";
                                                    $uplans['msg'] = "please logout then login to use the upgrade plan";
                                                } else {
                                                    $uplans['d'] = "0";
                                                    $uplans['msg'] = "Please login to see all payment details";
                                                }
                                                $this->Auth->logout();
                                                $this->set(compact('uplans'));
                                                $this->set('_serialize', ['uplans']);
                                            }

//                                    public function zipcode() {
//                                        //$conn = ConnectionManager::get('default');
//                                        //echo $_POST['zipcode'];
//                                        // $googledata=$this->getLetLong($_POST['zipcode']);
//                                        $lat = 30.7309; //=$googledata['latitude'];
//                                        $long = 76.8433; //$googledata['longitude'];
////                                $query="SELECT ID, get_distance_in_miles_between_geo_locations($lat,$long,'lat','long') as distance  FROM users WHERE role='vendor' ORDER BY distance";
////                                $data = $conn->execute($query); 
////                                $rows = $data->fetchAll('assoc');
//                                        //print_r($rows);
//                                        echo $this->distance(30.7309, 76.8433, 30.7309, 76.8433, '"M"');
//                                        exit;
//                                    }

                                            public function zipcode() {
                                                Configure::write("debug", 0);
                                               // echo $_POST['zipcode'];
                                                $zip = str_replace(' ', '', $_POST['zipcode']); //$_POST['zipcode'];
                                                $googledata = $this->getLetLong($zip);
                                                $lat = $googledata['latitude'];
                                                $long = $googledata['longitude'];
                                                $users = $this->Users->find('all', [
                                                    'conditions' => ['Users.role' => 'vendor']
                                                ]);
                                                $users = $users->all();

                                                foreach ($users as $d) {
                                                    $dst = $this->distance($lat, $long, $d->lat, $d->long, '"M"');
                                                    if ($dst < $d->radius) {
                                                        $venid[] = $d->id;
                                                    }
                                                }
                                                //  print_r($venid);
                                                if ($venid) {
                                                    $this->request->session()->write('venid', $venid);
                                                    $data['pincode'] = $zip;
                                                    $data['venid'] = $venid;
                                                    $data['status'] = '1';
                                                } else {
                                                    $data['status'] = '0';
                                                }

                                                $this->set('data', $data);
                                                $this->set('_serialize', ['data']);
                                            }

                                            public function zipsession() {
                                                $venid = $_POST['vid'];
                                                $d = $this->request->session()->read('venid_home');
                                                if ($d) {
                                                    $this->request->session()->write('venid_home', $venid);
                                                    $response['d'] = 0;
                                                } else {
                                                    $this->request->session()->write('venid_home', $venid);
                                                    $response['d'] = $d;
                                                }
                                                $this->set(compact('response'));
                                                $this->set('_serialize', ['response']);
                                            }

                                            /**
                                             * updateimage method
                                             * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
                                             * @throws \Cake\Network\Exception\NotFoundException When record not found.
                                             */
                                            public function updateimage() {
                                                Configure::write("debug", 0);
                                                $id = $this->Auth->user('id');
                                                $user = $this->Users->get($id, [
                                                    'contain' => []
                                                ]);
                                                if ($this->request->is(['patch', 'post', 'put'])) {
//                                                    print_r($this->request->data);
//                                                    exit;
                                                    $image = $this->request->data['image'];
                                                    $uploadFolder = "user";
                                                    //full path to upload folder
                                                    $uploadPath = WWW_ROOT . $uploadFolder;

                                                    //check if there wasn't errors uploading file on serwer
                                                    if ($image['error'] == 0) {
                                                        //image file name
                                                        $imageName = $image['name'];
                                                        //check if file exists in upload folder
                                                        if (file_exists($uploadPath . DS . $imageName)) {
                                                            //create full filename with timestamp
                                                            $imageName = date('His') . $imageName;
                                                        }
                                                        //create full path with image
                                                        $full_image_path = $uploadPath . DS . $imageName;
                                                        move_uploaded_file($image['tmp_name'], $full_image_path);
                                                        $id = $this->Auth->user('id');
                                                        $user = $this->Users->get($id, [
                                                            'contain' => []
                                                        ]);
                                                        $this->request->data['image'] = $image['name'];
                                                        $user = $this->Users->patchEntity($user, $this->request->data);
                                                        if ($this->Users->save($user)) {
                                                            $this->Flash->success(__('Your image has been updated'));
                                                            return $this->redirect(['action' => 'myaccount']);
                                                        } else {
                                                            $this->Flash->success(__('Your image has not been updated'));
                                                            return $this->redirect(['action' => 'updateimage']);
                                                        }
                                                    }
                                                }
                                                $this->set(compact('user'));
                                                $this->set('_serialize', ['user']);
                                            }

                                            /**
                                             * changepassword
                                             */
                                            public function changepassword() {
                                                Configure::write("debug", 0);
                                                $id = $this->Auth->user('id');
                                                $user = $this->Users->get($id, [
                                                    'contain' => []
                                                ]);
                                                if ($this->request->is(['patch', 'post', 'put'])) {
                                                    if ($this->request->data['new_password'] != $this->request->data['cpassword']) {
                                                        $this->Flash->success(__('New password & confirm password does not match!'));
                                                        return $this->redirect(['action' => 'changepassword']);
                                                    }
                                                    if ((new DefaultPasswordHasher)->check($this->request->data['old_password'], $user['password'])) {
                                                        $this->request->data['password'] = $this->request->data['new_password'];
                                                        $user = $this->Users->patchEntity($user, $this->request->data);
                                                        if ($this->Users->save($user)) {
                                                            $this->Flash->success(__('Your password has been changed'));
                                                            return $this->redirect(['action' => 'myaccount']);
                                                        } else {
                                                            $this->Flash->success(__('Invalid Password, try again'));
                                                            return $this->redirect(['action' => 'changepassword']);
                                                        }
                                                    } else {
                                                        $this->Flash->success(__('Old password did not match'));
                                                        return $this->redirect(['action' => 'changepassword']);
                                                    }
                                                }
                                                $this->set(compact('response'));
                                                $this->set('_serialize', ['response']);
                                            }

                                            public function referral() {
                                                Configure::write("debug", 0);
                                                if ($_POST['pcode']) {
                                                    $uid = $_POST['uid'];
                                                    $rcode = strtoupper($_POST['pcode']);
                                                    if ($rcode == '') {
                                                        $data['msg'] = "Please Enter the referral code";
                                                    }
                                                    $users = $this->Users->find('all', [
                                                        'conditions' => ['Users.my_r_code' => $rcode]
                                                    ]);
                                                    $users_data = $users->first();
                                                    $g_users = $this->Users->find('all', [
                                                        'conditions' => ['Users.id' => $uid]
                                                    ]);
                                                    $g_users = $g_users->first();
                                                    if ($users_data) {
                                                        if ($g_users->use_r_code != '') {
                                                            $data['msg'] = "You have already applied the referral code";
                                                        } else {
                                                            if ($users_data->id == $uid) {
                                                                $data['msg'] = "This is your referral code";
                                                            } else {
                                                                $this->loadModel('Wallets');
                                                                $this->loadModel('Referrals');
                                                                $referrals = $this->Referrals->find('all');
                                                                $last_r = $referrals->last();
                                                                $wallet = $this->Wallets->find('all', [
                                                                    'conditions' => ['Wallets.uid' => $uid]
                                                                ]);
                                                                $last_w = $wallet->first();
                                                                if ($last_w) {
                                                                    $points = $last_w->points + $last_r->refferto;
                                                                    $this->Wallets->updateAll(array('points' => $points), array('uid' => $uid));
                                                                    $this->Users->updateAll(array('use_r_code' => $rcode), array('id' => $uid));
                                                                    $data['msg'] = "You have been applied the referral code";
                                                                    $data['points'] = $points;
                                                                } else {
                                                                    $newwall = $this->Wallets->newEntity();
                                                                    $this->request->data['points'] = 0;
                                                                    $this->request->data['uid'] = $uid;
                                                                    $referral = $this->Wallets->patchEntity($newwall, $this->request->data);
                                                                    $this->Wallets->save($referral);
                                                                    $points = $last_r->refferto;
                                                                    $this->Wallets->updateAll(array('points' => $points), array('uid' => $uid));
                                                                    $this->Users->updateAll(array('use_r_code' => $rcode), array('id' => $uid));
                                                                    $data['msg'] = "You have been applied the referral code";
                                                                    $data['points'] = $points;
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        $data['msg'] = "Referral code is not valid";
                                                    }



//                                                        $this->Flash->success(__('Old password did not match'));
//                                                        return $this->redirect(['action' => 'changepassword']);
                                                }
                                                $this->set(compact('data'));
                                                $this->set('_serialize', ['data']);
                                            }

//                                            public function referral() {
//                                                Configure::write("debug", 0);
//                                                if ($this->request->is(['patch', 'post', 'put'])) {
//                                                    $rcode=  strtoupper($this->request->data['refferal']);
//                                                    if($rcode==''){
//                                                        $this->Flash->success(__('Please Enter the referral code'));
//                                                        return $this->redirect(['action' => 'referral']); 
//                                                    }                                                   
//                                                    $users = $this->Users->find('all', [
//                                                        'conditions' => ['Users.my_r_code' => $rcode]
//                                                    ]);
//                                                    $users_data = $users->first();
//                                                    $g_users = $this->Users->find('all', [
//                                                        'conditions' => ['Users.id' => $this->Auth->user('id')]
//                                                    ]);
//                                                    $g_users = $g_users->first();
//                                                    if($users_data){
//                                                        if($g_users->use_r_code!=''){
//                                                        $this->Flash->success(__('You have already applied the referral code'));
//                                                        return $this->redirect(['action' => 'referral']);  
//                                                        }
//                                                        if($users_data->id==$this->Auth->user('id')){
//                                                        $this->Flash->success(__('This is your referral code'));
//                                                        return $this->redirect(['action' => 'referral']);
//                                                        }else {
//                                                        $this->loadModel('Wallets');
//                                                        $this->loadModel('Referrals');
//                                                        $referrals = $this->Referrals->find('all');
//                                                        $last_r=$referrals->last();
//                                                         $wallet = $this->Wallets->find('all', [
//                                                        'conditions' => ['Wallets.uid' => $this->Auth->user('id')]
//                                                    ]);
//                                                        $last_w=$wallet->first();
//                                                        if($last_w){
//                                                          $points=$last_w->points+$last_r->refferto;
//                                                          $this->Wallets->updateAll(array('points'=>$points),array('uid'=>$this->Auth->user('id')));
//                                                          $this->Users->updateAll(array('use_r_code'=>$rcode),array('id'=>$this->Auth->user('id')));
//                                                           $this->Flash->success(__('You have been applied the referral code'));
//                                                            return $this->redirect(['action' => 'myaccount']);
//                                                        }else {
//                                                          $newwall = $this->Wallets->newEntity();
//                                                          $this->request->data['points']=0;
//                                                           $this->request->data['uid']=$this->Auth->user('id');
//                                                          $referral = $this->Wallets->patchEntity($newwall, $this->request->data);  
//                                                          $this->Wallets->save($referral);
//                                                          $points=$last_r->refferto;
//                                                          $this->Wallets->updateAll(array('points'=>$points),array('uid'=>$this->Auth->user('id')));  
//                                                          $this->Users->updateAll(array('use_r_code'=>$rcode),array('id'=>$this->Auth->user('id')));
//                                                          $this->Flash->success(__('You have been applied the referral code'));
//                                                           return $this->redirect(['action' => 'myaccount']);
//                                                        }
//                                                        }
//                                                       }else {
//                                                        $this->Flash->success(__('Referral code is not valid'));
//                                                        return $this->redirect(['action' => 'referral']);
//                                                    }
//                                                  
//                                                    
//
////                                                        $this->Flash->success(__('Old password did not match'));
////                                                        return $this->redirect(['action' => 'changepassword']);
//                                                }
//                                                $this->set(compact('response'));
//                                                $this->set('_serialize', ['response']);
//                                            }


                                            public function calculator() {

                                                $this->viewBuilder()->layout('default2');
                                            }

                                            public function calculatorin() {

                                                $this->viewBuilder()->layout('default');
                                            }

                                            public function mobilecalc() {

                                                $this->viewBuilder()->layout('mobile');
                                            }

                                            public function mobilerank() {

                                                $this->viewBuilder()->layout('mobile');
                                                $this->loadModel('Wallets');
                                                $query = $this->Wallets->find('all', [
                                                    'contain' => ['Users'],
                                                    'order' => array('Wallets.points DESC'),
                                                    'limit'=>5
                                                ]);
                                                $data = $query->all();
                                                if ($data) {
                                                    $data = $data;
                                                } else {
                                                    $data = array();
                                                }
                                                $this->set(compact('data'));
                                                $this->set('_serialize', ['data']);
                                            }

                                            public function forgetpassword() {
                                                $email = $_POST['email'];
                                                $query = $this->Users->find('all', ['conditions' => ['Users.username' => $email]]);
                                                $data = $query->first();
                                                $burl = Router::fullbaseUrl();
                                                if (empty($email)) {
                                                    $response['msg'] = "Please eneter your email address";
                                                } else {
                                                    if ($data->username) {
                                                        $hash = md5(time() . rand(111999999999999999999999999, 99999999999999999999999999999999999999999));
                                                        $url = Router::url(['controller' => 'Users', 'action' => 'reset' . '/' . $hash]);
                                                        $this->Users->updateAll(array('tokenhash' => $hash), array('id' => $data->id));
                                                        $ms = "Welcome to Plait<br/>";
                                                        $ms.='<a href=' . $burl . $url . '>Click here to reset your password</a><br/>';
                                                        $email = new Email('default');
                                                        $email->from(['noreply@plait.co.za' => 'Plait'])
                                                                ->emailFormat('html')
                                                                ->template('default', 'default')
                                                                ->to($data->username)
                                                                ->subject('Reset Your Password')
                                                                ->send($ms);
                                                        $response['msg'] = "Please check your email address";
                                                    } else {
                                                        $response['msg'] = "Email is invalid";
                                                        exit;
                                                    }
                                                }
                                                $this->set(compact('response'));
                                                $this->set('_serialize', ['response']);
                                            }

                                            public function reset($token) {
                                                $this->viewBuilder()->layout('default2');
                                                $query = $this->Users->find('all', ['conditions' => ['Users.tokenhash' => $token]]);
                                                $data = $query->first();
                                                if ($data) {
                                                    if ($this->request->is(['patch', 'post', 'put'])) {
                                                        if ($this->request->data['password'] != $this->request->data['password_confirm']) {
                                                            $this->Flash->success(__('New password & confirm password does not match!'));
                                                            return;
                                                            //$this->redirect(['action' => 'reset/' . $token]);
                                                        }
                                                        $this->request->data['tokenhash'] = md5(time() . rand(111999999999999999999999999999, 999999999999999999999999999999999));
                                                        $user = $this->Users->get($data->id, [
                                                            'contain' => []
                                                        ]);
                                                        $user = $this->Users->patchEntity($user, $this->request->data);
                                                        if ($this->Users->save($user)) {
                                                            $this->Flash->success(__('Your password has been changed'));
                                                            return;
                                                            //$this->redirect(['action' => 'reset/' . $token]);
                                                        } else {
                                                            $this->Flash->success(__('Invalid Password, try again'));
                                                            return;
                                                            //$this->redirect(['action' => 'reset/' . $token]);
                                                        }
                                                    }
                                                } else {
                                                    $this->Flash->success(__('Invalid Token, try again'));
                                                    return;
                                                }
                                                $this->set(compact('response'));
                                                $this->set('_serialize', ['response']);
                                            }

                                            public function rank() {
                                                $this->loadModel('Wallets');
                                                $query = $this->Wallets->find('all', [
                                                    'contain' => ['Users'],
                                                    'order' => array('Wallets.points DESC'),
                                                    'limit'=>5
                                                ]);
                                                $data = $query->all();
                                                if ($data) {
                                                    $data = $data;
                                                } else {
                                                    $data = array();
                                                }
                                                $this->set(compact('data'));
                                                $this->set('_serialize', ['data']);
                                            }

                                            public function apiforgetpassword() {

                                                Configure::write("debug", 0);
                                                $data1 = $this->CrOrgn();
                                                $this->filewrite($data1);
                                                if ($data1) {
                                                    $email = $data1->email;
                                                    $query = $this->Users->find('all', ['conditions' => ['Users.username' => $email]]);
                                                    $data = $query->first();
                                                    $burl = Router::fullbaseUrl();
                                                    if (empty($email)) {
                                                        $response['msg'] = "Please eneter your email address";
                                                    } else {
                                                        if ($data) {
                                                            $hash = md5(time() . rand(111999999999999999999999999, 99999999999999999999999999999999999999999));
                                                            $url = Router::url(['controller' => 'Users', 'action' => 'reset' . '/' . $hash]);
                                                            $this->Users->updateAll(array('tokenhash' => $hash), array('id' => $data->id));
                                                            $ms = "Welcome to Plait<br/>";
                                                            $ms.='<a href=' . $burl . $url . '>Click here to reset your password</a><br/>';
                                                            $email = new Email('default');
                                                            $email->from(['noreply@plait.co.za' => 'Plait'])
                                                                    ->emailFormat('html')
                                                                    ->template('default', 'default')
                                                                    ->to($data->username)
                                                                    ->subject('Reset Your Password')
                                                                    ->send($ms);
                                                            $response['msg'] = "Please check your email address to change the password";
                                                        } else {
                                                            $response['msg'] = "Email is invalid";
                                                        }
                                                    }
                                                }
                                                $this->set(compact('response'));
                                                $this->set('_serialize', ['response']);
                                            }

                                            public function vlogin() {
                                                $this->viewBuilder()->layout('LoginRegister');
                                                if ($this->request->is('post')) {
                                                    $user = $this->Auth->identify();
                                                    if ($user) {
                                                        if ($user['email_status'] == 0) {
                                                            $this->Auth->logout();
                                                            $this->Flash->success(__('You have not active contact to admin'));
                                                            return;
                                                        } else {
                                                            $this->Auth->setUser($user);
                                                            return $this->redirect(['controller' => 'vendor', 'action' => 'users/dashboard']);
                                                        }
                                                    }
                                                    $this->Flash->error(__('Invalid Username or Password, try again'));
                                                }
                                            }

                                            public function dboard() {
                                                $this->viewBuilder()->layout('LoginRegister');
                                                if ($this->request->is('post')) {
                                                    $user = $this->Auth->identify();

                                                    if ($user) {
                                                        if ($user['email_status'] == 0) {
                                                            $this->Auth->logout();
                                                            $this->Flash->success(__('You have not active contact to admin'));
                                                            return;
                                                        } else {
                                                            $this->Auth->setUser($user);
                                                            return $this->redirect(['controller' => 'dashboard', 'action' => '/users']);
                                                        }
                                                    }
                                                    $this->Flash->error(__('Invalid Username or Password, try again'));
                                                }
                                            }

                                        }
                                        