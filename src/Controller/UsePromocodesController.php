<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsePromocodes Controller
 *
 * @property \App\Model\Table\UsePromocodesTable $UsePromocodes
 */
class UsePromocodesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $usePromocodes = $this->paginate($this->UsePromocodes);

        $this->set(compact('usePromocodes'));
        $this->set('_serialize', ['usePromocodes']);
    }

    /**
     * View method
     *
     * @param string|null $id Use Promocode id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usePromocode = $this->UsePromocodes->get($id, [
            'contain' => []
        ]);

        $this->set('usePromocode', $usePromocode);
        $this->set('_serialize', ['usePromocode']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usePromocode = $this->UsePromocodes->newEntity();
        if ($this->request->is('post')) {
            $usePromocode = $this->UsePromocodes->patchEntity($usePromocode, $this->request->data);
            if ($this->UsePromocodes->save($usePromocode)) {
                $this->Flash->success(__('The use promocode has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The use promocode could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('usePromocode'));
        $this->set('_serialize', ['usePromocode']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Use Promocode id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usePromocode = $this->UsePromocodes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usePromocode = $this->UsePromocodes->patchEntity($usePromocode, $this->request->data);
            if ($this->UsePromocodes->save($usePromocode)) {
                $this->Flash->success(__('The use promocode has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The use promocode could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('usePromocode'));
        $this->set('_serialize', ['usePromocode']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Use Promocode id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usePromocode = $this->UsePromocodes->get($id);
        if ($this->UsePromocodes->delete($usePromocode)) {
            $this->Flash->success(__('The use promocode has been deleted.'));
        } else {
            $this->Flash->error(__('The use promocode could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
