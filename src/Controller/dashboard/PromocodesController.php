<?php

namespace App\Controller\Dashboard;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;

/**
 * Promocodes Controller
 *
 * @property \App\Model\Table\PromocodesTable $Promocodes
 */
class PromocodesController extends AppController {

    /**
     * beforeFilter
     * @param Event $event
     */
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        if ($this->request->params['prefix'] == 'dashboard') {
            $this->viewBuilder()->layout('dashboard');
        }
        $this->Auth->allow(['applypcode']);
        $this->authcontent();
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $promocodes = $this->paginate($this->Promocodes);

        $this->set(compact('promocodes'));
        $this->set('_serialize', ['promocodes']);
    }

    /**
     * View method
     *
     * @param string|null $id Promocode id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $promocode = $this->Promocodes->get($id, [
            'contain' => []
        ]);

        $this->set('promocode', $promocode);
        $this->set('_serialize', ['promocode']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $promocode = $this->Promocodes->newEntity();
        if ($this->request->is('post')) {
            $promocode = $this->Promocodes->patchEntity($promocode, $this->request->data);
            if ($this->Promocodes->save($promocode)) {
                $this->Flash->success(__('The promocode has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The promocode could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('promocode'));
        $this->set('_serialize', ['promocode']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Promocode id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $promocode = $this->Promocodes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $promocode = $this->Promocodes->patchEntity($promocode, $this->request->data);
            if ($this->Promocodes->save($promocode)) {
                $this->Flash->success(__('The promocode has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The promocode could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('promocode'));
        $this->set('_serialize', ['promocode']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Promocode id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $promocode = $this->Promocodes->get($id);
        if ($this->Promocodes->delete($promocode)) {
            $this->Flash->success(__('The promocode has been deleted.'));
        } else {
            $this->Flash->error(__('The promocode could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function applypcode() {
        Configure::write("debug", 0);
        if ($this->request->is('post')) {
            $query = $this->Promocodes->find('all', [
                'conditions' => ['Promocodes.pcode' => strtoupper($_POST['pcode'])]
            ]);            
            $Promocodes = $query->first();
       
            $this->loadModel('UsePromocodes');
            $usepcode= $this->UsePromocodes->find('all', [
                'conditions' => ['UsePromocodes.promocode' => strtoupper($_POST['pcode']),'UsePromocodes.uid' =>$_POST['uid']]
            ]);
            $usepcode = $usepcode->first();
            //print_r($usepcode->noofuse/3);
            //print_r($Promocodes->peruser);
           // exit;
            if($usepcode){
              $nou=  $usepcode->noofuse/3;
            }else {
                $nou=0;
            }
       
            if($Promocodes->peruser > $nou){
            if ($Promocodes) {
                $this->loadModel('Carts');
                $Carts = $this->Carts->find('all', [
                    'conditions' => ['Carts.uid' => $_POST['uid'], 'Carts.pcode' => strtoupper($_POST['pcode'])]
                ]);
                $Carts = $Carts->first();
                if ($Carts) {
                    $data['msg']="already applied";
                } else {
                    $Carts = $this->Carts->find('all', [
                        'conditions' => ['Carts.uid' => $_POST['uid']]
                    ]);
                    $Carts = $Carts->first();
                    //print_r($Carts);     
                    $percent= ($Carts->total*$Promocodes->percent/100);
                    // 10
                    $subtotal=$Carts->total-$percent;
                    $carts = $this->Carts->get($Carts['id'], [
                        'contain' => []]);                    
                    $this->request->data['subtotal']=round($subtotal);
                    $this->request->data['pcode']=strtoupper($_POST['pcode']);
                    $carts = $this->Carts->patchEntity($carts, $this->request->data);
                    $d=$this->Carts->save($carts);
                    
                    $data['subtotal']=$d;
                    $data['msg']="You have applied the promocode";
                }
            } else {
                $data['msg']="You have applied Wrong code";
                
            }
            }else {
               $data['msg']="You have exceeded your limit";
            }
        }
                                $this->set(compact('data'));
                                $this->set('_serialize', ['data']);
    }

}
