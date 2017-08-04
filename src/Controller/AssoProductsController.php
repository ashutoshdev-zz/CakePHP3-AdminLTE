<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssoProducts Controller
 *
 * @property \App\Model\Table\AssoProductsTable $AssoProducts
 */
class AssoProductsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['AssoCategories']
        ];
        $assoProducts = $this->paginate($this->AssoProducts);

        $this->set(compact('assoProducts'));
        $this->set('_serialize', ['assoProducts']);
    }

    /**
     * View method
     *
     * @param string|null $id Asso Product id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assoProduct = $this->AssoProducts->get($id, [
            'contain' => ['AssoCategories']
        ]);

        $this->set('assoProduct', $assoProduct);
        $this->set('_serialize', ['assoProduct']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assoProduct = $this->AssoProducts->newEntity();
        if ($this->request->is('post')) {
            $assoProduct = $this->AssoProducts->patchEntity($assoProduct, $this->request->data);
            if ($this->AssoProducts->save($assoProduct)) {
                $this->Flash->success(__('The asso product has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The asso product could not be saved. Please, try again.'));
            }
        }
        $assoCategories = $this->AssoProducts->AssoCategories->find('list', ['limit' => 200]);
        $this->set(compact('assoProduct', 'assoCategories'));
        $this->set('_serialize', ['assoProduct']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Asso Product id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assoProduct = $this->AssoProducts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assoProduct = $this->AssoProducts->patchEntity($assoProduct, $this->request->data);
            if ($this->AssoProducts->save($assoProduct)) {
                $this->Flash->success(__('The asso product has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The asso product could not be saved. Please, try again.'));
            }
        }
        $assoCategories = $this->AssoProducts->AssoCategories->find('list', ['limit' => 200]);
        $this->set(compact('assoProduct', 'assoCategories'));
        $this->set('_serialize', ['assoProduct']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Asso Product id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assoProduct = $this->AssoProducts->get($id);
        if ($this->AssoProducts->delete($assoProduct)) {
            $this->Flash->success(__('The asso product has been deleted.'));
        } else {
            $this->Flash->error(__('The asso product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
