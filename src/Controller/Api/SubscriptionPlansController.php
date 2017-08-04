<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;
use Cake\Routing\Router;
use Cake\ORM\TableRegistry;

/**
 * SubscriptionPlans Controller
 *
 * @property \App\Model\Table\SubscriptionPlansTable $SubscriptionPlans
 */
class SubscriptionPlansController extends AppController
{


 /**
     * Event
     * @param Event $event
     */
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow([ 'view' ]);
    }
 /**
     * RequestHandler 
     */
    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $subscriptionPlan = $this->SubscriptionPlans->get($id, [
            'contain' => ['SubscriptionTypes']
        ]);

        $this->set('subscriptionPlan', $subscriptionPlan);
        $this->set('_serialize', ['subscriptionPlan']);
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
        Configure::write("debug", 0);
        $data = $this->CrOrgn();
        
        $splans= $this->SubscriptionPlans->find('all',[
            'contain' => ['SubscriptionTypes']
        ]);
       
        $this->set(compact('splans'));
        $this->set('_serialize', ['splans']);
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
