<?php
namespace App\Controller\Dashboard;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;


/**
 * AssoCategories Controller
 *
 * @property \App\Model\Table\AssoCategoriesTable $AssoCategories
 */
class AssoCategoriesController extends AppController
{
    
          /**
       * beforeFilter
       * @param Event $event
       */
      public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if($this->request->params['prefix']=='dashboard'){
        $this->viewBuilder()->layout('dashboard');    
        }
        $this->authcontent();
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $assoCategories = $this->paginate($this->AssoCategories);

        $this->set(compact('assoCategories'));
        $this->set('_serialize', ['assoCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Asso Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assoCategory = $this->AssoCategories->get($id, [
            'contain' => []
        ]);

        $this->set('assoCategory', $assoCategory);
        $this->set('_serialize', ['assoCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assoCategory = $this->AssoCategories->newEntity();
        if ($this->request->is('post')) {
            $assoCategory = $this->AssoCategories->patchEntity($assoCategory, $this->request->data);
            if ($this->AssoCategories->save($assoCategory)) {
                $this->Flash->success(__('The asso category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The asso category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('assoCategory'));
        $this->set('_serialize', ['assoCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Asso Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assoCategory = $this->AssoCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assoCategory = $this->AssoCategories->patchEntity($assoCategory, $this->request->data);
            if ($this->AssoCategories->save($assoCategory)) {
                $this->Flash->success(__('The asso category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The asso category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('assoCategory'));
        $this->set('_serialize', ['assoCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Asso Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assoCategory = $this->AssoCategories->get($id);
        if ($this->AssoCategories->delete($assoCategory)) {
            $this->Flash->success(__('The asso category has been deleted.'));
        } else {
            $this->Flash->error(__('The asso category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
