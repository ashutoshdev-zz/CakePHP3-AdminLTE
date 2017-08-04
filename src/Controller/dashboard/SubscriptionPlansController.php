<?php
namespace App\Controller\Dashboard;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;

/**
 * SubscriptionPlans Controller
 *
 * @property \App\Model\Table\SubscriptionPlansTable $SubscriptionPlans
 */
class SubscriptionPlansController extends AppController
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
            'contain' => ['SubscriptionTypes']
        ];
        $subscriptionPlans = $this->paginate($this->SubscriptionPlans);

        $this->set(compact('subscriptionPlans'));
        $this->set('_serialize', ['subscriptionPlans']);
    }

    /**
     * View method
     *
     * @param string|null $id Subscription Plan id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subscriptionPlan = $this->SubscriptionPlans->get($id, [
            'contain' => ['SubscriptionTypes']
        ]);

        $this->set('subscriptionPlan', $subscriptionPlan);
        $this->set('_serialize', ['subscriptionPlan']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subscriptionPlan = $this->SubscriptionPlans->newEntity();
        if ($this->request->is('post')) {
            $subscriptionPlan = $this->SubscriptionPlans->patchEntity($subscriptionPlan, $this->request->data);
            if ($this->SubscriptionPlans->save($subscriptionPlan)) {
                $this->Flash->success(__('The subscription plan has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The subscription plan could not be saved. Please, try again.'));
            }
        }
        $subscriptionTypes = $this->SubscriptionPlans->SubscriptionTypes->find('list', ['limit' => 200]);
        $this->set(compact('subscriptionPlan', 'subscriptionTypes'));
        $this->set('_serialize', ['subscriptionPlan']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Subscription Plan id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subscriptionPlan = $this->SubscriptionPlans->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subscriptionPlan = $this->SubscriptionPlans->patchEntity($subscriptionPlan, $this->request->data);
            if ($this->SubscriptionPlans->save($subscriptionPlan)) {
                $this->Flash->success(__('The subscription plan has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The subscription plan could not be saved. Please, try again.'));
            }
        }
        $subscriptionTypes = $this->SubscriptionPlans->SubscriptionTypes->find('list', ['limit' => 200]);
        $this->set(compact('subscriptionPlan', 'subscriptionTypes'));
        $this->set('_serialize', ['subscriptionPlan']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Subscription Plan id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subscriptionPlan = $this->SubscriptionPlans->get($id);
        if ($this->SubscriptionPlans->delete($subscriptionPlan)) {
            $this->Flash->success(__('The subscription plan has been deleted.'));
        } else {
            $this->Flash->error(__('The subscription plan could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
