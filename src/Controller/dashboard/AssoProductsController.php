<?php
namespace App\Controller\Dashboard;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;


/**
 * AssoProducts Controller
 *
 * @property \App\Model\Table\AssoProductsTable $AssoProducts
 */
class AssoProductsController extends AppController
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
            'contain' => ['AssoCategories']
        ];
        $assoProducts = $this->paginate($this->AssoProducts);

        $this->set(compact('assoProducts'));
        $this->set('_serialize', ['assoProducts']);
    }

    /**
     * View method
     *
     * @param string|null $id Asso Product id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assoProduct = $this->AssoProducts->get($id, [
            'contain' => ['AssoCategories']
        ]);

        $this->set('assoProduct', $assoProduct);
        $this->set('_serialize', ['assoProduct']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assoProduct = $this->AssoProducts->newEntity();
        if ($this->request->is('post')) {
                $image = $this->request->data['image'];
            $uploadFolder = "assoproduct";
            //full path to upload folder
            $uploadPath = WWW_ROOT . $uploadFolder;

            //check if there wasn't errors uploading file on serwer
            if ($image['error'] == 0) {
                //image file name
                $imageName = $image['name'];
                //check if file exists in upload folder
                if (file_exists($uploadPath . DS . $imageName)) {
                    //create full filename with timestamp
                    $imageName = date('His') . $imageName;
                }
                //create full path with image
                $full_image_path = $uploadPath . DS . $imageName;
                move_uploaded_file($image['tmp_name'], $full_image_path);

                $this->request->data['image'] = $image['name'];
            }
            $assoProduct = $this->AssoProducts->patchEntity($assoProduct, $this->request->data);
            if ($this->AssoProducts->save($assoProduct)) {
                $this->Flash->success(__('The asso product has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The asso product could not be saved. Please, try again.'));
            }
        }
        $assoCategories = $this->AssoProducts->AssoCategories->find('list', ['limit' => 200]);
        $this->set(compact('assoProduct', 'assoCategories'));
        $this->set('_serialize', ['assoProduct']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Asso Product id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assoProduct = $this->AssoProducts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
                $image = $this->request->data['image'];
            $uploadFolder = "assoproduct";
            //full path to upload folder
            $uploadPath = WWW_ROOT . $uploadFolder;

            //check if there wasn't errors uploading file on serwer
            if ($image['error'] == 0) {
                //image file name
                $imageName = $image['name'];
                //check if file exists in upload folder
                if (file_exists($uploadPath . DS . $imageName)) {
                    //create full filename with timestamp
                    $imageName = date('His') . $imageName;
                }
                //create full path with image
                $full_image_path = $uploadPath . DS . $imageName;
                move_uploaded_file($image['tmp_name'], $full_image_path);

                $this->request->data['image'] = $image['name'];
            }else {
                $this->request->data['image'] =$assoProduct->image;
            
            }
           
            $assoProduct = $this->AssoProducts->patchEntity($assoProduct, $this->request->data);
            if ($this->AssoProducts->save($assoProduct)) {
                $this->Flash->success(__('The asso product has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The asso product could not be saved. Please, try again.'));
            }
        }
        $assoCategories = $this->AssoProducts->AssoCategories->find('list', ['limit' => 200]);
        $this->set(compact('assoProduct', 'assoCategories'));
        $this->set('_serialize', ['assoProduct']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Asso Product id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assoProduct = $this->AssoProducts->get($id);
        if ($this->AssoProducts->delete($assoProduct)) {
            $this->Flash->success(__('The asso product has been deleted.'));
        } else {
            $this->Flash->error(__('The asso product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
