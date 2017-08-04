<?php

namespace App\Controller\Dashboard;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;

/**
 * Alergies Controller
 *
 * @property \App\Model\Table\AlergiesTable $Alergies
 */
class AlergiesController extends AppController {
    
   /**
    * beforeFilter
    * @param \App\Controller\Event $event
    */ 
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        if ($this->request->params['prefix'] == 'dashboard') {
            $this->viewBuilder()->layout('dashboard');
        }
        $this->Auth->allow(['add', 'logout']);
        $this->authcontent();
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $alergies = $this->paginate($this->Alergies);

        $this->set(compact('alergies'));
        $this->set('_serialize', ['alergies']);
    }

    /**
     * View method
     *
     * @param string|null $id Alergy id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $alergy = $this->Alergies->get($id);

        $this->set('alergy', $alergy);
        $this->set('_serialize', ['alergy']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $alergy = $this->Alergies->newEntity();
        if ($this->request->is('post')) {
            $alergy = $this->Alergies->patchEntity($alergy, $this->request->data);
            if ($this->Alergies->save($alergy)) {
                $this->Flash->success(__('The alergy has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The alergy could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('alergy'));
        $this->set('_serialize', ['alergy']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Alergy id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $alergy = $this->Alergies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $alergy = $this->Alergies->patchEntity($alergy, $this->request->data);
            if ($this->Alergies->save($alergy)) {
                $this->Flash->success(__('The alergy has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The alergy could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('alergy'));
        $this->set('_serialize', ['alergy']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Alergy id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $alergy = $this->Alergies->get($id);
        if ($this->Alergies->delete($alergy)) {
            $this->Flash->success(__('The alergy has been deleted.'));
        } else {
            $this->Flash->error(__('The alergy could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
