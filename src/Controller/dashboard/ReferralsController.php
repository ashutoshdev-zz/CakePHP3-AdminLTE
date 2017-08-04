<?php
namespace App\Controller\Dashboard;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;

/**
 * Referrals Controller
 *
 * @property \App\Model\Table\ReferralsTable $Referrals
 */
class ReferralsController extends AppController
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
        $referrals = $this->paginate($this->Referrals);

        $this->set(compact('referrals'));
        $this->set('_serialize', ['referrals']);
    }

    /**
     * View method
     *
     * @param string|null $id Referral id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $referral = $this->Referrals->get($id, [
            'contain' => []
        ]);

        $this->set('referral', $referral);
        $this->set('_serialize', ['referral']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $referral = $this->Referrals->newEntity();
        if ($this->request->is('post')) {
            $referral = $this->Referrals->patchEntity($referral, $this->request->data);
            if ($this->Referrals->save($referral)) {
                $this->Flash->success(__('The referral has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The referral could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('referral'));
        $this->set('_serialize', ['referral']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Referral id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $referral = $this->Referrals->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $referral = $this->Referrals->patchEntity($referral, $this->request->data);
            if ($this->Referrals->save($referral)) {
                $this->Flash->success(__('The referral has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The referral could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('referral'));
        $this->set('_serialize', ['referral']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Referral id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $referral = $this->Referrals->get($id);
        if ($this->Referrals->delete($referral)) {
            $this->Flash->success(__('The referral has been deleted.'));
        } else {
            $this->Flash->error(__('The referral could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
