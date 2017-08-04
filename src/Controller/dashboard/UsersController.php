<?php

namespace App\Controller\Dashboard;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

    /**
     * beforeFilter
     * @param Event $event
     */
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        if ($this->request->params['prefix'] == 'dashboard') {
            $this->viewBuilder()->layout('dashboard');
        }
        $this->Auth->allow(['logout', 'reset']);
        $this->authcontent();
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function vendorlist() {
        $query = $this->Users->find('all', [
            'conditions' => ['Users.role' => 'vendor']
        ]);
        //$orders = $query->all();
        $users = $this->paginate($query);
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * 
     */
    public function dashboard() {
        
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->Users->get($id, [
            'contain' => ['Staticpages']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $address = str_replace(' ', '', $this->request->data['zip']);
            $googledata = $this->getLetLong($address);
            $this->request->data['lat'] = $googledata['latitude'];
            $this->request->data['long'] = $googledata['longitude'];
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
             $address = str_replace(' ', '', $this->request->data['zip']);
            $googledata = $this->getLetLong($address);
           
            $this->request->data['lat'] = $googledata['latitude'];
            $this->request->data['long'] = $googledata['longitude'];
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * login method
     * @author ashutoshdev
     * @return type
     */
    public function login() {
        $this->viewBuilder()->layout('LoginRegister');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect(['action' => 'dashboard']);
            }
            $this->Flash->error(__('Invalid Username or Password, try again'));
        }
    }

    /**
     * logout method
     * @author ashutoshdev
     * @return type
     */
    public function logout() {
        if ($this->Auth->logout()) {
            return $this->redirect('/');
        }
    }
    /**
     * 
     * @param type $token
     * @return type
     */
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
    
}
