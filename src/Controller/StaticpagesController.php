<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Staticpages Controller
 *
 * @property \App\Model\Table\StaticpagesTable $Staticpages
 */
class StaticpagesController extends AppController
{
    public function beforeFilter(Event $event) {
        $this->Auth->allow(['cjob']);
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $staticpages = $this->paginate($this->Staticpages);

        $this->set(compact('staticpages'));
        $this->set('_serialize', ['staticpages']);
    }

    /**
     * View method
     *
     * @param string|null $id Staticpage id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
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
    public function add()
    {
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
    public function edit($id = null)
    {
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
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $staticpage = $this->Staticpages->get($id);
        if ($this->Staticpages->delete($staticpage)) {
            $this->Flash->success(__('The staticpage has been deleted.'));
        } else {
            $this->Flash->error(__('The staticpage could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function cjob() {
        echo "ss";
        exit;
    }
}
