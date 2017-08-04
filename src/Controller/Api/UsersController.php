<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;
use Cake\Routing\Router;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Email;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

    public $urlfilter = array("www", "com", "http", "https");

    /**
     * Event
     * @param Event $event
     */
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow(['add', 'login', 'index', 'edit', 'updateimage', 'changepassword', 'fblogin', 'cart',
            'confirmation', 'weeklyschedule', 'changeschedule', 'referral', 'wallet', 'forgetpassword', 'rank','verifyemail']);
    }

    /**
     * RequestHandler 
     */
    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        Configure::write("debug", 0);
        $data = $this->CrOrgn();
        //$this->filewrite($data);
        $user = $this->Users->newEntity();
        if (!empty($data)) {
            $this->request->data['fname'] = $data->User->fname;
            $this->request->data['lname'] = $data->User->lname;
            $this->request->data['username'] = $data->User->username;
            $this->request->data['password'] = $data->User->password;
            $this->request->data['email'] = $data->User->email;
            $this->request->data['phone'] = $data->User->phone;
            $this->request->data['role'] = "user";
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $query = $this->Users->find('all', [
                    'conditions' => ['Users.id' => $user->id]
                ]);
                $User = $query->first();
                if ($User->my_r_code == '') {
                    $pcode = strtoupper(str_replace(' ', '', $User->fname) . '-' . substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 2));
                    $this->Users->updateAll(array('my_r_code' => $pcode), array('id' => $user->id));
                }
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
                $response['msg'] = "The user has been saved.";
            } else {
                $response['isSucess'] = "false";
                $response['msg'] = "The user could not be saved. Please, try with new Email";
            }
        } else {
            $response['isSucess'] = "false";
            $response['msg'] = "No data submitted";
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
        Configure::write("debug", 0);
        $data = $this->CrOrgn();
        $this->filewrite($data);
        if (!empty($data)) {
            $id = $data->User->id;
            $this->request->data['id'] = $data->User->id;
            $this->request->data['fname'] = $data->User->fname;
            $this->request->data['lname'] = $data->User->lname;
            $this->request->data['phone'] = $data->User->phone;
            $user = $this->Users->get($id, [
                'contain' => []
            ]);
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $response['data'] = $user;
                $response['isSucess'] = "true";
                $response['msg'] = "Your data has been updated";
            } else {
                $response['isSucess'] = "false";
                $response['msg'] = "Your data has not been updated";
            }
        } else {
            $response['isSucess'] = "false";
            $response['msg'] = "No data submitted";
        }
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    /**
     * login method
     * @author ashutoshdev
     * @return type
     */
    public function login() {
        Configure::write("debug", 0);
        $data = $this->CrOrgn();
        $this->filewrite($data);
        if (!empty($data)) {
            $this->request->data['username'] = $data->User->username;
            $this->request->data['password'] = $data->User->password;
            $user = $this->Auth->identify();
            if ($user) {
                if ($user['email_status'] == 0) {
                    $response['isSucess'] = "false";
                    $response['msg'] = "You have not verified your email";
                } else {
                    if ($this->strposa($user['image'], $this->urlfilter)) {
                        $user['image'];
                    } else {
                        $user['image'] = Router::fullbaseUrl() . $this->request->webroot . "user/" . $user['image'];
                    }
                    $this->loadModel('UserPlans');
                    $query = $this->UserPlans->find('all', ['conditions' => ['UserPlans.uid' => $user['id']]]);
                    $data = $query->first();

                    $response['plan'] = $data;
                    $response['data'] = $user;
                    $response['isSucess'] = "true";
                    $response['msg'] = "Logged In successfully";
                }
            } else {
                $response['isSucess'] = "false";
                $response['msg'] = "Invalid Username or Password, try again";
            }
        } else {
            $response['isSucess'] = "false";
            $response['msg'] = "No data submitted";
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
        $data = $this->CrOrgn();
        $this->filewrite($data);
        if (!empty($data)) {
            $id = $data->User->id;
            $img = base64_decode($data->User->image);
            $im = imagecreatefromstring($img);
            if ($im !== false) {
                $image = "profile" . time() . ".png";
                imagepng($im, WWW_ROOT . "user" . DS . $image);
                imagedestroy($im);
            }
            $user = $this->Users->get($id, [
                'contain' => []
            ]);
            $this->request->data['id'] = $data->User->id;
            $this->request->data['image'] = $image;
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $response['data']['image'] = Router::fullbaseUrl() . $this->request->webroot . "user/" . $image;
                $response['isSucess'] = "true";
                $response['msg'] = "Your image has been updated";
            } else {
                $response['isSucess'] = "false";
                $response['msg'] = "Your image has not been updated";
            }
        } else {
            $response['isSucess'] = "false";
            $response['msg'] = "No data submitted";
        }
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    /**
     * changepassword
     */
    public function changepassword() {
        Configure::write("debug", 0);
        $data = $this->CrOrgn();
        $this->filewrite($data);
        if (!empty($data)) {
            $this->request->data['old_password'] = $data->User->old_password;
            $this->request->data['password'] = $data->User->new_password;
            $this->request->data['id'] = $data->User->id;
            $id = $data->User->id;
            $user = $this->Users->get($id, [
                'contain' => []
            ]);
            if ((new DefaultPasswordHasher)->check($this->request->data['old_password'], $user['password'])) {
                $user = $this->Users->patchEntity($user, $this->request->data);
                if ($this->Users->save($user)) {
                    $response['data'] = $user;
                    $response['isSucess'] = "true";
                    $response['msg'] = "Your password has been changed";
                } else {
                    $response['isSucess'] = "false";
                    $response['msg'] = "Invalid Password, try again";
                }
            } else {
                $response['isSucess'] = "false";
                $response['msg'] = "Old password did not match";
            }
        } else {
            $response['isSucess'] = "false";
            $response['msg'] = "No data submitted";
        }
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function fblogin() {

        Configure::write("debug", 0);
        $data = $this->CrOrgn();
        $this->filewrite($data);
        if (!empty($data)) {
            $user = $this->Users->newEntity();
            $this->request->data['fname'] = $data->name;
            $this->request->data['lname'] = "";
            $this->request->data['username'] = $data->email;
            $this->request->data['fb_id'] = $data->id;
            $this->request->data['password'] = $data->email . 'plaitwebsite';
            $this->request->data['email'] = $data->email;
            $this->request->data['role'] = "user";
            $this->request->data['email_status'] = "1";
            $this->request->data['status'] = "1";
           
            $user = $this->Users->patchEntity($user, $this->request->data);
            
            if ($this->Users->save($user)) {
                $user = $this->Auth->identify();
                if ($user['my_r_code'] == NULL) {
                $pcode = strtoupper(str_replace(' ', '', $user['fname']) . '-' . substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 2));
                $this->Users->updateAll(array('my_r_code' => $pcode), array('id' => $user['id']));
                }
                $this->Auth->setUser($user);
            } else {
                $query = $this->Users->find('all', [
                    'conditions' => ['Users.fb_id' => $data->id]
                ]);
                $this->request->data['password'] = $data->email . 'plaitwebsite';
                $User = $query->first();
                if ($User->my_r_code == NULL) {
                $pcode = strtoupper(str_replace(' ', '', $User->fname) . '-' . substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 2));
                $this->Users->updateAll(array('my_r_code' => $pcode), array('id' => $User->id));
                }
                $user = $this->Users->get($User['id'], [
                    'contain' => []
                ]);
                $user = $this->Users->patchEntity($user, $this->request->data);
                $this->Users->save($user);
                $user = $this->Auth->identify();
                $this->Auth->setUser($user);
            }
            $this->loadModel('UserPlans');
            $UserPlans = $this->UserPlans->find('all', ['conditions' => ['UserPlans.uid' => $user['id']]]);
            
            $dataa = $UserPlans->first();
            $user = $this->Auth->identify();
            $response['plan'] = $dataa;
            $response['isSucess'] = "true";
            $response['data'] = $user;
        } else {
            $response['isSucess'] = "false";
            $response['msg'] = "No data submitted";
        }
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function cart() {
        Configure::write("debug", 2);
        $data = $this->CrOrgn();
        $this->filewrite($data);
        if ($data) {
            $uid = $data->uid;
            $pid = $data->pid;
            $this->loadModel('SubscriptionPlans');
            $query = $this->SubscriptionPlans->find('all', [
                'conditions' => ['SubscriptionPlans.id' => $pid]]);
            $User = $query->first();
            //print_r($User);
            $this->loadModel('Carts');
            $this->Carts->deleteAll(['Carts.uid' => $uid]);
            $cart = $this->Carts->newEntity();
            $this->request->data['uid'] = $uid;
            $this->request->data['subscription_plans_id'] = $pid;
            $this->request->data['subtotal'] = $User['price'];
            $this->request->data['total'] = $User['price'];
            $carts = $this->Carts->patchEntity($cart, $this->request->data);
            $result = $this->Carts->save($carts);
            if ($result) {
                //$cart['data']=$result;
                $cart['msg'] = "Added in the cart";
                $cart['status'] = true;
            } else {
                $cart['msg'] = "Unable to add";
                $cart['status'] = false;
            }
        } else {
            $cart['msg'] = "Unable to add";
            $cart['status'] = false;
        }
        $this->set(compact('cart'));
        $this->set('_serialize', ['cart']);
    }

    public function confirmation() {
        Configure::write("debug", 0);
        $data = $this->CrOrgn();
        $this->filewrite($data);
        if ($data) {
            $uid = $data->uid;
            $user = $this->Users->find('all', ['conditions' => ['Users.id' => $uid]]);
            $this->loadModel('PaymentHistories');
            $result['user'] = $user->first();
            $payment = $this->PaymentHistories->find('all', ['conditions' => ['PaymentHistories.uid' => $uid, 'PaymentHistories.status' => 1], 'fields' => ['PaymentHistories.txn_id', 'PaymentHistories.amt']]);
            $result['payment'] = $payment->last();
            $this->loadModel('UserPlans');
            $query = $this->UserPlans->find('all', ['conditions' => ['UserPlans.uid' => $uid]]);
            $dataa = $query->first();
            if ($result) {
                $confirm['plan'] = $dataa;
                $confirm['data'] = $result;
                $confirm['msg'] = "Success";
                $confirm['status'] = true;
            } else {
                $confirm['msg'] = "UnSuccessful";
                $confirm['status'] = false;
            }
        } else {
            $confirm['msg'] = "Unable to add";
            $confirm['status'] = false;
        }
        $this->set(compact('confirm'));
        $this->set('_serialize', ['confirm']);
    }

    public function weeklyschedule() {
        Configure::write("debug", 2);
        $data = $this->CrOrgn();
        $this->filewrite($data);
        $uid = $data->uid;
        $this->loadModel('WeeklyShedules');
        $ws = $this->WeeklyShedules->find('all', [
            'conditions' => ['WeeklyShedules.uid' => $uid]
        ]);
        $ws = $ws->first();
        $this->loadModel('Orders');
        $order = $this->Orders->newEntity();
        $this->request->data['address_id'] = 0;
        $this->request->data['uid'] = $uid;
        $this->request->data['delivery_status'] = 0;
        $this->request->data['enddate'] = date('Y-m-d', strtotime('+7 days'));
        $this->request->data['plan_id'] = $data->plan_id;
        $this->request->data['ip_address'] = $this->request->clientIp();
        $this->request->data['is_active'] = 1;
        $order = $this->Orders->patchEntity($order, $this->request->data);
        if ($data->plan_id == 3 || $data->plan_id == 2) {

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
                    $this->request->data['uid'] = $uid;
                    $this->request->data['quantity'] = 0;
                    $this->request->data['order_id'] = $orderid;
                    $this->request->data['order_id'] = $orderid;
                    $wshe = $this->WeeklyShedules->newEntity();
                    $wshe = $this->WeeklyShedules->patchEntity($wshe, $this->request->data);
                    $this->WeeklyShedules->save($wshe);
                }
                $confirm['status'] = true;
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
                    $this->request->data['uid'] = $uid;
                    $this->request->data['quantity'] = 0;
                    $this->request->data['order_id'] = $orderid;
                    $wshe = $this->WeeklyShedules->newEntity();
                    $wshe = $this->WeeklyShedules->patchEntity($wshe, $this->request->data);
                    $this->WeeklyShedules->save($wshe);
                }
                $confirm['status'] = true;
            }
        }
        $this->set(compact('confirm'));
        $this->set('_serialize', ['confirm']);
    }

   public function changeschedule() {
        Configure::write("debug", 0);
        $data = $this->CrOrgn();
        $this->filewrite($data);
        if ($data) {
            $this->loadModel('WeeklyShedules');
            foreach ($data->food as $k => $fd) {
                $this->WeeklyShedules->updateAll(array('product_id' => $fd), array('dayname' => $data->day, 'uid' => $data->uid, 'foodtime' => $k));
            }
            foreach ($data->address as $k => $fd) {
                $this->WeeklyShedules->updateAll(array('address_id' => $fd), array('dayname' => $data->day, 'uid' => $data->uid, 'foodtime' => $k));
            }
            foreach ($data->timeslot as $k => $fd) {
                $this->WeeklyShedules->updateAll(array('timeslot' => $fd), array('dayname' => $data->day, 'uid' => $data->uid, 'foodtime' => $k));
            }
            foreach ($data->quantity as $k => $fd) {
                $this->WeeklyShedules->updateAll(array('quantity' => $fd), array('dayname' => $data->day, 'uid' => $data->uid, 'foodtime' => $k));
            }

            foreach ($data->custom as $k => $fd) {
                $fd = serialize($fd);
                $this->WeeklyShedules->updateAll(array('cfood_id' => $fd), array('dayname' => $data->day, 'uid' => $data->uid, 'foodtime' => $k));
            }
            $response['isSucess'] = '1';
        } else {
            $response['isSucess'] = '1';
        }
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function referral() {
        Configure::write("debug", 2);
        $data1 = $this->CrOrgn();
        $this->filewrite($data1);
        if ($data1) {
            $uid = $data1->uid;
            $rcode = strtoupper($data1->refer);
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
                            $data['msg'] = "You have applied the referral code Successfully";
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
                            $data['msg'] = "You have applied the referral code Successfully";
                            $data['points'] = $points;
                        }
                    }
                }
            } else {
                $data['msg'] = "Referral code is not valid";
            }
        }
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }

    public function wallet() {

        Configure::write("debug", 2);
        $data1 = $this->CrOrgn();
        $this->filewrite($data1);
        if ($data1) {
            $uid = $data1->uid;
            if ($uid) {
                $this->loadModel('Wallets');
                $data = $this->Wallets->find('all', ['conditions' => ['Wallets.uid' => $uid]]);
            }
        }
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }

    public function forgetpassword() {

        Configure::write("debug", 2);
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

    public function rank() {
        Configure::write("debug", 2);
        $data1 = $this->CrOrgn();
        $this->filewrite($data1);
        $this->loadModel('Wallets');
        $query = $this->Wallets->find('all', [
            'contain' => ['Users'],
            'order' => array('Wallets.points DESC'),
            'limit' => 5
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

    public function verifyemail($token) {
        return $this->redirect('http://plait.co.za/plait/users/verifyemail/'.$token);
        exit;
    }

}
