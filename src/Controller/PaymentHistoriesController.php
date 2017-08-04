<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PaymentHistories Controller
 *
 * @property \App\Model\Table\PaymentHistoriesTable $PaymentHistories
 */
class PaymentHistoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
           $query = $this->PaymentHistories->find('all', [
            'conditions' => ['PaymentHistories.uid' => $this->Auth->user('id')]
        ]);
        //$orders = $query->all();
        $paymentHistories = $this->paginate($query);

        $this->set(compact('paymentHistories'));
        $this->set('_serialize', ['paymentHistories']);
    }

    /**
     * View method
     *
     * @param string|null $id Payment History id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paymentHistory = $this->PaymentHistories->get($id, [
            'contain' => ['Carts', 'Checksums', 'Txns']
        ]);

        $this->set('paymentHistory', $paymentHistory);
        $this->set('_serialize', ['paymentHistory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $paymentHistory = $this->PaymentHistories->newEntity();
        if ($this->request->is('post')) {
            $paymentHistory = $this->PaymentHistories->patchEntity($paymentHistory, $this->request->data);
            if ($this->PaymentHistories->save($paymentHistory)) {
                $this->Flash->success(__('The payment history has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The payment history could not be saved. Please, try again.'));
            }
        }
        $carts = $this->PaymentHistories->Carts->find('list', ['limit' => 200]);
        $checksums = $this->PaymentHistories->Checksums->find('list', ['limit' => 200]);
        $txns = $this->PaymentHistories->Txns->find('list', ['limit' => 200]);
        $this->set(compact('paymentHistory', 'carts', 'checksums', 'txns'));
        $this->set('_serialize', ['paymentHistory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment History id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $paymentHistory = $this->PaymentHistories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paymentHistory = $this->PaymentHistories->patchEntity($paymentHistory, $this->request->data);
            if ($this->PaymentHistories->save($paymentHistory)) {
                $this->Flash->success(__('The payment history has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The payment history could not be saved. Please, try again.'));
            }
        }
        $carts = $this->PaymentHistories->Carts->find('list', ['limit' => 200]);
        $checksums = $this->PaymentHistories->Checksums->find('list', ['limit' => 200]);
        $txns = $this->PaymentHistories->Txns->find('list', ['limit' => 200]);
        $this->set(compact('paymentHistory', 'carts', 'checksums', 'txns'));
        $this->set('_serialize', ['paymentHistory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment History id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $paymentHistory = $this->PaymentHistories->get($id);
        if ($this->PaymentHistories->delete($paymentHistory)) {
            $this->Flash->success(__('The payment history has been deleted.'));
        } else {
            $this->Flash->error(__('The payment history could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
