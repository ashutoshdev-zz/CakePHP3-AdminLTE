<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;
use Cake\ORM\TableRegistry;

/**
 * Addresses Controller
 *
 * @property \App\Model\Table\AddressesTable $Addresses
 */
class AddressesController extends AppController {

    /**
     * Event
     * @param Event $event
     */
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow(['add', 'edit', 'view', 'viewall', 'delete']);
    }

    /**
     * RequestHandler 
     */
    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * View method
     *
     * @param string|null $id Address id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view() {
        Configure::write("debug", 0);
        $data = $this->CrOrgn();
        // $this->filewrite($data);
        if (!empty($data)) {
            $id = $data->Address->id;
            $address = $this->Addresses->get($id, [
                'contain' => []
            ]);
        } else {
            $response['isSucess'] = "false";
            $response['msg'] = "No data submitted";
        }
        $this->set('address', $address);
        $this->set('_serialize', ['address']);
    }

    /**
     * Viewall method
     *
     * @param string|null $id Address id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewall() {
        Configure::write("debug", 0);
        $data = $this->CrOrgn();
        $this->filewrite($data);

        if (!empty($data)) {
            $uid = $data->Address->user_id;
            $addresses = TableRegistry::get('Addresses');
            $address = $addresses->find('all', [
                'conditions' => ['Addresses.user_id' => $uid ]
            ]);
            $response['isSucess'] = "true";
            $response['data'] = $address;
            $response['msg'] = "All data available";
        } else {
            $response['isSucess'] = "false";
            $response['msg'] = "No data submitted";
        }
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        Configure::write("debug", 0);
        $data = $this->CrOrgn();
        //$this->filewrite($data);
        if (!empty($data)) {
            $this->request->data['first_name'] = $data->Address->first_name;
            $this->request->data['last_name'] = $data->Address->last_name;
            $this->request->data['addresstype'] = $data->Address->addresstype;
            $this->request->data['address1'] = $data->Address->address1;
            $this->request->data['address2'] = $data->Address->address2;
            $this->request->data['email'] = $data->Address->email;
            $this->request->data['phone'] = $data->Address->phone;
            $this->request->data['city'] = $data->Address->city;
            $this->request->data['state'] = $data->Address->state;
            $this->request->data['zip'] = $data->Address->zip;
            $this->request->data['country'] = $data->Address->country;
            $this->request->data['user_id'] = $data->Address->user_id;
            $address = $this->Addresses->newEntity();
            $address = $this->Addresses->patchEntity($address, $this->request->data);
            if ($this->Addresses->save($address)) {
                $response['data'] = $address;
                $response['isSucess'] = "true";
                $response['msg'] = "The address has been saved.";
            } else {
                $response['isSucess'] = "false";
                $response['msg'] = "The address could not be saved. Please, try with new Email";
            }
        } else {
            $response['isSucess'] = "false";
            $response['msg'] = "No data submitted";
        }
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    /**
     * Edit method
     *
     * @param 
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit() {
        Configure::write("debug", 0);
        $data = $this->CrOrgn();
//      $this->filewrite($data);
        if (!empty($data)) {
            $id = $data->Address->id;
            $this->request->data['id'] = $data->Address->id;
            $this->request->data['first_name'] = $data->Address->first_name;
            $this->request->data['last_name'] = $data->Address->last_name;
            $this->request->data['addresstype'] = $data->Address->addresstype;
            $this->request->data['address1'] = $data->Address->address1;
            $this->request->data['address2'] = $data->Address->address2;
            $this->request->data['email'] = $data->Address->email;
            $this->request->data['phone'] = $data->Address->phone;
            $this->request->data['city'] = $data->Address->city;
            $this->request->data['state'] = $data->Address->state;
            $this->request->data['zip'] = $data->Address->zip;
            $this->request->data['country'] = $data->Address->country;
            $this->request->data['user_id'] = $data->Address->user_id;
            $address = $this->Addresses->get($id, [
                'contain' => []
            ]);
            $user = $this->Addresses->patchEntity($address, $this->request->data);
            if ($this->Addresses->save($address)) {
                $response['data'] = $user;
                $response['isSucess'] = "true";
                $response['msg'] = "Your address has been updated";
            } else {
                $response['isSucess'] = "false";
                $response['msg'] = "Your address has not been updated";
            }
        } else {
            $response['isSucess'] = "false";
            $response['msg'] = "No data submitted";
        }
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Address id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete() {
        Configure::write("debug", 0);
        $data = $this->CrOrgn();
        $this->filewrite($data);
        if (!empty($data)) {
            $id = $data->Address->id;
            $address = $this->Addresses->get($id);
            if ($this->Addresses->delete($address)) {
                $response['isSucess'] = "true";
                $response['msg'] = "The address has been deleted.";
            } else {
                $response['isSucess'] = "false";
                $response['msg'] = "The address could not be deleted. Please, try again.";
            }
        } else {
            $response['isSucess'] = "false";
            $response['msg'] = "No data submitted";
        }
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

}
