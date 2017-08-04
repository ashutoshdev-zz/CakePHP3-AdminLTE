<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SubscriptionTypes Controller
 *
 * @property \App\Model\Table\SubscriptionTypesTable $SubscriptionTypes
 */
class SubscriptionTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $subscriptionTypes = $this->paginate($this->SubscriptionTypes);

        $this->set(compact('subscriptionTypes'));
        $this->set('_serialize', ['subscriptionTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Subscription Type id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subscriptionType = $this->SubscriptionTypes->get($id, [
            'contain' => ['SubscriptionPlans']
        ]);

        $this->set('subscriptionType', $subscriptionType);
        $this->set('_serialize', ['subscriptionType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subscriptionType = $this->SubscriptionTypes->newEntity();
        if ($this->request->is('post')) {
            $subscriptionType = $this->SubscriptionTypes->patchEntity($subscriptionType, $this->request->data);
            if ($this->SubscriptionTypes->save($subscriptionType)) {
                $this->Flash->success(__('The subscription type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The subscription type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('subscriptionType'));
        $this->set('_serialize', ['subscriptionType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Subscription Type id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subscriptionType = $this->SubscriptionTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subscriptionType = $this->SubscriptionTypes->patchEntity($subscriptionType, $this->request->data);
            if ($this->SubscriptionTypes->save($subscriptionType)) {
                $this->Flash->success(__('The subscription type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The subscription type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('subscriptionType'));
        $this->set('_serialize', ['subscriptionType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Subscription Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subscriptionType = $this->SubscriptionTypes->get($id);
        if ($this->SubscriptionTypes->delete($subscriptionType)) {
            $this->Flash->success(__('The subscription type has been deleted.'));
        } else {
            $this->Flash->error(__('The subscription type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
