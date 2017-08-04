<?php
namespace App\Controller;

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;

/**
 * Promocodes Controller
 *
 * @property \App\Model\Table\PromocodesTable $Promocodes
 */
class PromocodesController extends AppController
{

 public function beforeFilter(Event $event) {
        $this->Auth->allow(['applypcode']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
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
    public function view($id = null)
    {
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
    public function add()
    {
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
    public function edit($id = null)
    {
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
    public function delete($id = null)
    {
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
        Configure::write("debug", 2);
        $data = $this->CrOrgn();
        $this->filewrite($data);
        if ($data) {
            $uid=$data->uid;
            $pcode=$data->promocode;
            $query = $this->Promocodes->find('all', [
                'conditions' => ['Promocodes.pcode' => strtoupper($pcode)]
            ]);           
            $Promocodes = $query->first();
            $this->loadModel('UsePromocodes');
            $usepcode= $this->UsePromocodes->find('all', [
                'conditions' => ['UsePromocodes.promocode' => strtoupper($pcode),'UsePromocodes.uid' =>$uid]
            ]);
            $usepcode = $usepcode->first();
            if($usepcode){
              $nou=  $usepcode->noofuse/3;
            }else {
                $nou=0;
            }
       
            if($Promocodes){
            if ($Promocodes->peruser > $nou) {
                $this->loadModel('Carts');
                $Carts = $this->Carts->find('all', [
                    'conditions' => ['Carts.uid' => $uid, 'Carts.pcode' => strtoupper($pcode)]
                ]);
               $Carts = $Carts->first();
                if ($Carts) {
                 
                    $pr['msg']="already applied";
                    $pr['subtotal']= $Carts;
                } else {

                    $Carts = $this->Carts->find('all', [
                        'conditions' => ['Carts.uid' => $uid]
                    ]);

                    $Carts = $Carts->first();
                    
                    $percent= ($Carts->total*$Promocodes->percent/100);
                    // 10
                    $subtotal=$Carts->total-$percent;
                    $carts = $this->Carts->get($Carts['id'], [
                        'contain' => []]);                    
                    $this->request->data['subtotal']=round($subtotal);
                    $this->request->data['pcode']=strtoupper($pcode);
                    $carts = $this->Carts->patchEntity($carts, $this->request->data);
                    $d=$this->Carts->save($carts);
                    
                    $pr['subtotal']=$d;
                    $pr['msg']="You have applied the promocode";
                }
            } else {
                $pr['msg']="You have exceeded your limit";
                
            }
            }else {
               $pr['msg']="Invalid Promocode Applied";
            }
        }
                                $this->set(compact('pr'));
                                $this->set('_serialize', ['pr']);
    }
}
