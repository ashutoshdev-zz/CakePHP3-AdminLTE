<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;

/**
 * WeeklyShedules Controller
 *
 * @property \App\Model\Table\WeeklyShedulesTable $WeeklyShedules
 */
class WeeklyShedulesController extends AppController {

    public $key = 'absbsbsbs123585s55s85s852s202s55s8';

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Orders', 'Products', 'Alergies']
        ];
        $weeklyShedules = $this->paginate($this->WeeklyShedules);

        $this->set(compact('weeklyShedules'));
        $this->set('_serialize', ['weeklyShedules']);
    }

    /**
     * View method
     *
     * @param string|null $id Weekly Shedule id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        Configure::write("debug", 0);
        $id = base64_decode($id);
        $orderItem = $this->WeeklyShedules->get($id, [
            'contain' => ['Products']
        ]);

        if($orderItem->cfood_id){
        $this->loadModel('AssoProducts');
        $pid = unserialize($orderItem->cfood_id);
       
         if(is_array($pid)){
             if(!empty($pid)){
            $query = $this->AssoProducts->find('all', [
            'conditions' => ['AssoProducts.id IN' => $pid]
        ]);
             $assoorders = $query->all();
             }
        }else {   
        $a = explode('",', $pid);
        foreach ($a as $d) {
            $str = str_replace('"', ' ', $d);
            $stra = str_replace(']', ' ', $str);
            $str_id[] = str_replace('[', ' ', $stra);
        }

        $query = $this->AssoProducts->find('all', [
            'conditions' => ['AssoProducts.id IN' => $str_id]
        ]);
         $assoorders = $query->all();
        }
       
        $this->set('assoorders', $assoorders);
        }
        $this->set('orderItem', $orderItem);
        $this->set('_serialize', ['orderItem']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->WeeklyShedules->updateAll(['order_id' => 1], ['uid' => 14]); // 
        exit;
//        $weeklyShedule = $this->WeeklyShedules->newEntity();
//        if ($this->request->is('post')) {
//            $weeklyShedule = $this->WeeklyShedules->patchEntity($weeklyShedule, $this->request->data);
//            if ($this->WeeklyShedules->save($weeklyShedule)) {
//                $this->Flash->success(__('The weekly shedule has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            } else {
//                $this->Flash->error(__('The weekly shedule could not be saved. Please, try again.'));
//            }
//        }
//        $orders = $this->WeeklyShedules->Orders->find('list', ['limit' => 200]);
//        $products = $this->WeeklyShedules->Products->find('list', ['limit' => 200]);
//        $alergies = $this->WeeklyShedules->Alergies->find('list', ['limit' => 200]);
//        $this->set(compact('weeklyShedule', 'orders', 'products', 'alergies', 'cfoods'));
//        $this->set('_serialize', ['weeklyShedule']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Weekly Shedule id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $weeklyShedule = $this->WeeklyShedules->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $weeklyShedule = $this->WeeklyShedules->patchEntity($weeklyShedule, $this->request->data);
            if ($this->WeeklyShedules->save($weeklyShedule)) {
                $this->Flash->success(__('The weekly shedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The weekly shedule could not be saved. Please, try again.'));
            }
        }
        $orders = $this->WeeklyShedules->Orders->find('list', ['limit' => 200]);
        $products = $this->WeeklyShedules->Products->find('list', ['limit' => 200]);
        $alergies = $this->WeeklyShedules->Alergies->find('list', ['limit' => 200]);
        $cfoods = $this->WeeklyShedules->Cfoods->find('list', ['limit' => 200]);
        $this->set(compact('weeklyShedule', 'orders', 'products', 'alergies', 'cfoods'));
        $this->set('_serialize', ['weeklyShedule']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Weekly Shedule id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $weeklyShedule = $this->WeeklyShedules->get($id);
        if ($this->WeeklyShedules->delete($weeklyShedule)) {
            $this->Flash->success(__('The weekly shedule has been deleted.'));
        } else {
            $this->Flash->error(__('The weekly shedule could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function wantfood($id) {
        $id = base64_decode($id);
        $this->loadModel('UserPlans');
        $query = $this->UserPlans->find('all', ['conditions' => ['UserPlans.uid' => $this->Auth->user('id')]]);
        $user_plans = $query->first();
        if (($user_plans->totalmeal - $user_plans->used_meal) >=1) {
        $update=$this->UserPlans->updateAll(['used_meal' => $user_plans->used_meal+1],['id' => $user_plans->id]);     
        if($update){       
        $this->WeeklyShedules->updateAll(['dl_status' => 0],['id' => $id]);
        $this->Flash->success(__('You have requested for food'));
        return $this->redirect(['controller' => 'orders', 'action' => 'schedules']);
        
        }
       }else {
           $this->Flash->success(__('You have not left any meal'));
           return $this->redirect(['controller' => 'orders', 'action' => 'schedules']);

       }
    }
     public function nowantfood($id) {
        $id = base64_decode($id);
        $this->loadModel('UserPlans');
        $query = $this->UserPlans->find('all', ['conditions' => ['UserPlans.uid' => $this->Auth->user('id')]]);
        $user_plans = $query->first();
        $update=$this->UserPlans->updateAll(['used_meal' => $user_plans->used_meal-1],['id' => $user_plans->id]);     
        if($update){       
        $this->WeeklyShedules->updateAll(['dl_status' => 1],['id' => $id]);
        $this->Flash->success(__('You have requested for not want food'));
        return $this->redirect(['controller' => 'orders', 'action' => 'schedules']);
        }
    }

}
