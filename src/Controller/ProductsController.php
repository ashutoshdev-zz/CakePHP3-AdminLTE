<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController {

    public function beforeFilter(Event $event) {
        $this->Auth->allow(['showalergy']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        Configure::write("debug", 0);
        $this->paginate = [
            'contain' => ['SubscriptionPlans', 'Users', 'Alergies', 'Days', 'Categories', 'Subcategories']
        ];
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
        $this->set('_serialize', ['products']);
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $product = $this->Products->get($id, [
            'contain' => ['SubscriptionPlans', 'Users', 'Days', 'Categories', 'Subcategories', 'OrderItems']
        ]);

        $this->set('product', $product);
        $this->set('_serialize', ['product']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        }
        $subscriptionPlans = $this->Products->SubscriptionPlans->find('list', ['limit' => 200]);
        $users = $this->Products->Users->find('list', ['limit' => 200]);
        $alergies = $this->Products->Alergies->find('list', ['limit' => 200]);
        $days = $this->Products->Days->find('list', ['limit' => 200]);
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $subcategories = $this->Products->Subcategories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'subscriptionPlans', 'users', 'alergies', 'days', 'categories', 'subcategories'));
        $this->set('_serialize', ['product']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        }
        $subscriptionPlans = $this->Products->SubscriptionPlans->find('list', ['limit' => 200]);
        $users = $this->Products->Users->find('list', ['limit' => 200]);
        $alergies = $this->Products->Alergies->find('list', ['limit' => 200]);
        $days = $this->Products->Days->find('list', ['limit' => 200]);
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $subcategories = $this->Products->Subcategories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'subscriptionPlans', 'users', 'alergies', 'days', 'categories', 'subcategories'));
        $this->set('_serialize', ['product']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function showalergy() {
        Configure::write("debug", 0);
        $d = explode('-', $_POST['id']);
        $this->loadModel('Products');
        $query = $this->Products->find('all', [
            'conditions' => ['Products.id' =>$d[1]]
        ]);
        $products = $query->first();
        if ($d[0] == 'alergy') {
            $algry_id = unserialize($products->alergy_id);
            $this->loadModel('Alergies');
            if ($algry_id) {
                $data_al = $this->Alergies->find('all', [
                    'conditions' => ['Alergies.id IN' => $algry_id]
                ]);
                $allalergy = $data_al->all();
                $data['isdata'] = "1";
                $data['data'] = $allalergy;
            } else {
                $data['isdata'] = "0";
            }
        } else if ($d[0] == 'cfood') {
            $proid = unserialize($products->assopro_id);
            //print_r($proid);
            $this->loadModel('AssoProducts');
            if ($proid) {
                $data_al = $this->AssoProducts->find('all', [
                    'conditions' => ['AssoProducts.id IN' => $proid]                                      
                ]);
                $allpro = $data_al->all();
                foreach($allpro as $ap){
                    $pro_id[]=$ap['id'];
                }  
                $this->request->session()->write('prid',$pro_id);
                $this->loadModel('AssoCategories');                         
                $days = $this->AssoCategories->find('all')->contain(['AssoProducts' => function ($q) {
                    $id = $this->request->session()->read('prid');
                    return $q->where(['AssoProducts.id IN' =>$id]);
                }]);
                $data['isdata'] = "1";
                $data['data'] = $days->all();
            } else {
                $data['isdata'] = "0";
            }
        }
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }

}
