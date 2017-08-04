<?php

namespace App\Controller\Dashboard;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController {

    /**
     * beforeFilter
     * @param Event $event
     */
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        if ($this->request->params['prefix'] == 'dashboard') {
            $this->viewBuilder()->layout('dashboard');
        }
        $this->authcontent();
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    
    public function index() {
        $this->paginate = [
            'contain' => ['SubscriptionPlans', 'Users', 'Days', 'Categories']
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
            'contain' => ['SubscriptionPlans', 'Users', 'Days', 'Categories', 'OrderItems']
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
        Configure::write("debug", 0);
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['alergy_id'] = serialize($this->request->data['alergy_id']);
            $this->request->data['assopro_id'] = serialize($this->request->data['assopro_id']);
           
             $image = $this->request->data['image'];
            $uploadFolder = "product";
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

                $this->request->data['image'] = $image['name'];
            }
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
        //$subcategories = $this->Products->Subcategories->find('list', ['limit' => 200]);
        $assoproducts = $this->Products->AssoProducts->find('list', ['limit' => 200]);
        $this->set(compact('product', 'subscriptionPlans', 'users', 'alergies', 'days', 'categories', 'subcategories', 'assoproducts'));
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
        Configure::write("debug", 0);

        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['alergy_id'] = serialize($this->request->data['alergy_id']);
            $this->request->data['assopro_id'] = serialize($this->request->data['assopro_id']);
//            print_r($this->request->data);
//            exit;
            
            $image = $this->request->data['image'];
            $uploadFolder = "product";
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

                $this->request->data['image'] = $image['name'];
            }else {
                $this->request->data['image'] =$product->image;
            
            }
            if($this->request->data['alergy_id']=="N;"){
                $this->request->data['alergy_id'] =$product->alergy_id;
            }
            if($this->request->data['assopro_id']=="N;"){
                $this->request->data['assopro_id'] =$product->assopro_id;
            }
            $producta = $this->Products->patchEntity($product, $this->request->data);
          
            if ($this->Products->save($producta)) {
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
       // $subcategories = $this->Products->Subcategories->find('list', ['limit' => 200]);
        $assoproducts = $this->Products->AssoProducts->find('list', ['limit' => 200]);
        $this->set(compact('product', 'subscriptionPlans', 'users', 'alergies', 'days', 'categories', 'subcategories', 'assoproducts'));
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

}
