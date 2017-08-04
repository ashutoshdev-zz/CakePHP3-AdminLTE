<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;
use Cake\ORM\TableRegistry;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController {

    /**
     * Event
     * @param Event $event
     */
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow(['view', 'alergy']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
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
    public function view() {
        Configure::write("debug", 2);
        $data = $this->CrOrgn();
        $this->filewrite($data);

        if ($data) {
            $id = $data->Plan->id;
            $lat = $data->lat;
            $long = $data->long;
            $user_id=$data->uid;
            $this->request->session()->write('id', $data->Plan->id);
            $this->request->session()->write('lat', $lat);
            $this->request->session()->write('long', $long);

            $this->loadModel('Days');
            $this->loadModel('Users');
            $this->loadModel('WeeklyShedules');
            $schedule=$this->WeeklyShedules->find('all',['conditions' => ['AND'=>['WeeklyShedules.uid' => $user_id,'WeeklyShedules.product_id !='=>0]]]);
            $users = $this->Users->find('all', [
                'conditions' => ['Users.role' => 'vendor']
            ]);
            $users = $users->all();

            foreach ($users as $d) {
                $dst = $this->distance($lat, $long, $d->lat, $d->long, '"M"');
                if ($dst < $d->radius) {
                    $venid[] = $d->id;
                }
            }

            if (empty($venid)) {
                $days = NULL;
            } else {
                $days = $this->Days->find('all')->contain(['Products' => function ($q) {

                        $id = $this->request->session()->read('id');
                        $lat = $this->request->session()->read('lat');
                        $long = $this->request->session()->read('long');
                        $this->loadModel('Users');
                        $users = $this->Users->find('all', [
                            'conditions' => ['Users.role' => 'vendor']
                        ]);
                        $users = $users->all();

                        foreach ($users as $d) {
                            $dst = $this->distance($lat, $long, $d->lat, $d->long, '"M"');
                            if ($dst < $d->radius) {
                                $venid[] = $d->id;
                            }
                        }
                        return $q->where(['Products.subscription_plan_id' => $id, 'Products.user_id IN' => $venid]);
                    }
                        ]);
                        $days = $days->all();
                      
                       
                    }
                    /* $products = $this->Products->find('all',['conditions'=>['Products.subscription_plan_id'=>$id]]);
                      $products=$products->all()->toArray();
                      $day=[];
                      foreach($products as $product)
                      {
                      if(!in_array($product->toArray()['day_id'],$day))
                      {
                      array_push($day,$product->toArray()['day_id']);
                      $pos=array_search($product->toArray()['day_id'],$day);
                      $products['data'][$pos]=array();
                      array_push($products['data'][$pos],$product->toArray());
                      }
                      else
                      {
                      $pos=array_search($product->toArray()['day_id'],$day);
                      array_push($products['data'][$pos],$product->toArray());
                      }
                      } */
                    $response['isSucess'] = "true";
                    $response['pro'] = $days;
                    $response['schedule']=$schedule;
                } else {
                    $response['isSucess'] = "false";
                    $response['msg'] = "No data submitted";
                }
                $this->set('products', $response);
                $this->set('_serialize', ['products']);
            }

            public function alergy() {

                Configure::write("debug", 2);
                $data = $this->CrOrgn();
                $this->filewrite($data);

                if ($data) {
                    $pid = $data->pid;
                    $this->loadModel('Products');
                    $product = $this->Products->find('all', ['conditions' => ['Products.id' => $pid]]);
                    if ($product) {
                        $alergy = $product->first()->alergy_id;
                        $alergy = unserialize($alergy);
                        $this->loadModel('Alergies');
                        $p['alergy'] = $this->Alergies->find('all')->where(['Alergies.id IN' => $alergy]);
                    }
                }
                $this->set('alergy', $p);
                $this->set('_serialize', ['alergy']);
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

        }
        