<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Mailer\Email;

/**
 * Staticpages Controller
 *
 * @property \App\Model\Table\StaticpagesTable $Staticpages
 */
class StaticpagesController extends AppController {

    public function beforeFilter(Event $event) {
        $this->Auth->allow(['index', 'contact']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        Configure::write("debug", 0);
        $data = $this->CrOrgn();
        $this->filewrite($data);
        $pos = $data->StaticPages->pos;
        if ($pos) {
            $static = TableRegistry::get('Staticpages');
            $staticpages = $static->find('all', [
                'conditions' => ['Staticpages.position' => $pos]
            ]);


            $this->set(compact('staticpages'));
            $this->set('_serialize', ['staticpages']);
        }
    }

    /**
     * View method
     *
     * @param string|null $id Staticpage id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $staticpage = $this->Staticpages->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('staticpage', $staticpage);
        $this->set('_serialize', ['staticpage']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $staticpage = $this->Staticpages->newEntity();
        if ($this->request->is('post')) {
            $staticpage = $this->Staticpages->patchEntity($staticpage, $this->request->data);
            if ($this->Staticpages->save($staticpage)) {
                $this->Flash->success(__('The staticpage has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The staticpage could not be saved. Please, try again.'));
            }
        }
        $users = $this->Staticpages->Users->find('list', ['limit' => 200]);
        $this->set(compact('staticpage', 'users'));
        $this->set('_serialize', ['staticpage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Staticpage id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $staticpage = $this->Staticpages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $staticpage = $this->Staticpages->patchEntity($staticpage, $this->request->data);
            if ($this->Staticpages->save($staticpage)) {
                $this->Flash->success(__('The staticpage has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The staticpage could not be saved. Please, try again.'));
            }
        }
        $users = $this->Staticpages->Users->find('list', ['limit' => 200]);
        $this->set(compact('staticpage', 'users'));
        $this->set('_serialize', ['staticpage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Staticpage id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $staticpage = $this->Staticpages->get($id);
        if ($this->Staticpages->delete($staticpage)) {
            $this->Flash->success(__('The staticpage has been deleted.'));
        } else {
            $this->Flash->error(__('The staticpage could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function contact() {
        $data = $this->CrOrgn();
        if (!empty($data)) {
            $ms = "Plait<br/>";
            $ms.='Name:' . $data->StaticPages->name . '<br/>';
            $ms.='Email:' . $data->StaticPages->email . '<br/>';
            $ms.='Mobile:' . $data->StaticPages->mobile . '<br/>';
            $ms.='Subject:' . $data->StaticPages->subject . '<br/>';
            $ms.='Message:' . $data->StaticPages->comnt . '<br/>';
            $email = new Email('default');
            $email->from(['noreply@plait.co.za' => 'Plait'])
                    ->emailFormat('html')
                    ->template('default', 'default')
                    ->to("ashutosh@avainfotech.com")
                    ->subject('Thanks for Contact us')
                    ->send($ms);
             $response['isSucess'] = "true";
             $response['msg'] = "Message has been sent successfully";
        } else {
            $response['isSucess'] = "false";
            $response['msg'] = "Message has not been sent successfully";
        }
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }
}
    