<?php
namespace App\Controller\Dashboard;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;

/**
 * Subcategories Controller
 *
 * @property \App\Model\Table\SubcategoriesTable $Subcategories
 */
class SubcategoriesController extends AppController
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
        $this->paginate = [
            'contain' => ['Categories']
        ];
        $subcategories = $this->paginate($this->Subcategories);

        $this->set(compact('subcategories'));
        $this->set('_serialize', ['subcategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Subcategory id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subcategory = $this->Subcategories->get($id, [
            'contain' => ['Categories']
        ]);

        $this->set('subcategory', $subcategory);
        $this->set('_serialize', ['subcategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subcategory = $this->Subcategories->newEntity();
        if ($this->request->is('post')) {
            $subcategory = $this->Subcategories->patchEntity($subcategory, $this->request->data);
            if ($this->Subcategories->save($subcategory)) {
                $this->Flash->success(__('The subcategory has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The subcategory could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Subcategories->Categories->find('list', ['limit' => 200]);
        $this->set(compact('subcategory', 'categories'));
        $this->set('_serialize', ['subcategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Subcategory id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subcategory = $this->Subcategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subcategory = $this->Subcategories->patchEntity($subcategory, $this->request->data);
            if ($this->Subcategories->save($subcategory)) {
                $this->Flash->success(__('The subcategory has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The subcategory could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Subcategories->Categories->find('list', ['limit' => 200]);
        $this->set(compact('subcategory', 'categories'));
        $this->set('_serialize', ['subcategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Subcategory id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subcategory = $this->Subcategories->get($id);
        if ($this->Subcategories->delete($subcategory)) {
            $this->Flash->success(__('The subcategory has been deleted.'));
        } else {
            $this->Flash->error(__('The subcategory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
