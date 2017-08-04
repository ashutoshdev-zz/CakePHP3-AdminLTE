<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Days Controller
 *
 * @property \App\Model\Table\DaysTable $Days
 */
class DaysController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $days = $this->paginate($this->Days);

        $this->set(compact('days'));
        $this->set('_serialize', ['days']);
    }

    /**
     * View method
     *
     * @param string|null $id Day id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $day = $this->Days->get($id, [
            'contain' => ['Products']
        ]);

        $this->set('day', $day);
        $this->set('_serialize', ['day']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $day = $this->Days->newEntity();
        if ($this->request->is('post')) {
            $day = $this->Days->patchEntity($day, $this->request->data);
            if ($this->Days->save($day)) {
                $this->Flash->success(__('The day has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The day could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('day'));
        $this->set('_serialize', ['day']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Day id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $day = $this->Days->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $day = $this->Days->patchEntity($day, $this->request->data);
            if ($this->Days->save($day)) {
                $this->Flash->success(__('The day has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The day could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('day'));
        $this->set('_serialize', ['day']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Day id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $day = $this->Days->get($id);
        if ($this->Days->delete($day)) {
            $this->Flash->success(__('The day has been deleted.'));
        } else {
            $this->Flash->error(__('The day could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
