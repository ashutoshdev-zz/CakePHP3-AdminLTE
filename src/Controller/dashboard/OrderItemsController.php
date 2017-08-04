<?php
namespace App\Controller\Dashboard;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;

/**
 * OrderItems Controller
 *
 * @property \App\Model\Table\OrderItemsTable $OrderItems
 */
class OrderItemsController extends AppController
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
            'contain' => ['Orders', 'Products']
        ];
        $orderItems = $this->paginate($this->OrderItems);

        $this->set(compact('orderItems'));
        $this->set('_serialize', ['orderItems']);
    }

    /**
     * View method
     *
     * @param string|null $id Order Item id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderItem = $this->OrderItems->get($id, [
            'contain' => ['Orders', 'Products']
        ]);
      
        $this->set('orderItem', $orderItem);
        $this->set('_serialize', ['orderItem']);
    }
     public function associateview($id = null)
    {
        $orderItem = $this->OrderItems->get($id, [
            'contain' => ['Orders', 'Products']
        ]);
         $this->loadModel('AssoProducts');
         $pid=unserialize($orderItem->cfood_id);
         $a=explode('",', $pid);
         foreach($a as $d){
         $str=str_replace('"',' ',$d);
         $stra=str_replace(']',' ',$str);
         $str_id[]=str_replace('[',' ',$stra);
         }
         $query = $this->AssoProducts->find('all', [
                'conditions' => ['AssoProducts.id IN' =>$str_id]
            ]);
        $assoorders = $query->all();
        $this->set('assoorders', $assoorders);
        $this->set('orderItem', $orderItem);
        $this->set('_serialize', ['orderItem','assoorders']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderItem = $this->OrderItems->newEntity();
        if ($this->request->is('post')) {
            $orderItem = $this->OrderItems->patchEntity($orderItem, $this->request->data);
            if ($this->OrderItems->save($orderItem)) {
                $this->Flash->success(__('The order item has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order item could not be saved. Please, try again.'));
            }
        }
        $orders = $this->OrderItems->Orders->find('list', ['limit' => 200]);
        $products = $this->OrderItems->Products->find('list', ['limit' => 200]);
        $this->set(compact('orderItem', 'orders', 'products'));
        $this->set('_serialize', ['orderItem']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Order Item id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orderItem = $this->OrderItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderItem = $this->OrderItems->patchEntity($orderItem, $this->request->data);
            if ($this->OrderItems->save($orderItem)) {
                $this->Flash->success(__('The order item has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order item could not be saved. Please, try again.'));
            }
        }
        $orders = $this->OrderItems->Orders->find('list', ['limit' => 200]);
        $products = $this->OrderItems->Products->find('list', ['limit' => 200]);
        $this->set(compact('orderItem', 'orders', 'products'));
        $this->set('_serialize', ['orderItem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Order Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderItem = $this->OrderItems->get($id);
        if ($this->OrderItems->delete($orderItem)) {
            $this->Flash->success(__('The order item has been deleted.'));
        } else {
            $this->Flash->error(__('The order item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
