<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserPlans Controller
 *
 * @property \App\Model\Table\UserPlansTable $UserPlans
 */
class UserPlansController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $userPlans = $this->paginate($this->UserPlans);

        $this->set(compact('userPlans'));
        $this->set('_serialize', ['userPlans']);
    }

    /**
     * View method
     *
     * @param string|null $id User Plan id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userPlan = $this->UserPlans->get($id, [
            'contain' => []
        ]);

        $this->set('userPlan', $userPlan);
        $this->set('_serialize', ['userPlan']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userPlan = $this->UserPlans->newEntity();
        if ($this->request->is('post')) {
            $userPlan = $this->UserPlans->patchEntity($userPlan, $this->request->data);
            if ($this->UserPlans->save($userPlan)) {
                $this->Flash->success(__('The user plan has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user plan could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('userPlan'));
        $this->set('_serialize', ['userPlan']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Plan id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userPlan = $this->UserPlans->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userPlan = $this->UserPlans->patchEntity($userPlan, $this->request->data);
            if ($this->UserPlans->save($userPlan)) {
                $this->Flash->success(__('The user plan has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user plan could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('userPlan'));
        $this->set('_serialize', ['userPlan']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Plan id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userPlan = $this->UserPlans->get($id);
        if ($this->UserPlans->delete($userPlan)) {
            $this->Flash->success(__('The user plan has been deleted.'));
        } else {
            $this->Flash->error(__('The user plan could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
