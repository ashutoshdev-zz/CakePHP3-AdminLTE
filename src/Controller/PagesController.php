<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Error\Debugger;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use Cake\Datasource\ConnectionManager;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Routing\Router;
use Cake\Mailer\Email;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

    public function beforeFilter(Event $event) {

//       require '/home/ashutosh/public_html/php-graph-sdk-5.0.0/src/Facebook/autoload.php';
//        $fb = new Facebook\Facebook([
//            'app_id' => '1910287989203056', // Replace {app-id} with your app id
//            'app_secret' => '07741879c90da2f9889f320767066838',
//            'default_graph_version' => 'v2.2',
//        ]);
//
//        $helper = $fb->getRedirectLoginHelper();
//
//        $permissions = ['email']; // Optional permissions
//        $loginUrl = $helper->getLoginUrl('http://ashutosh.crystalbiltech.com/plait/users/fblogin', $permissions);
//        $this->set('loginUrl', $loginUrl);
        $this->Auth->allow(['about', 'privacypolicy', 'howitwork', 'help', 'contact', 'faq', 'subscriptionplan', 'didyouknow']);
    }

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display() {
        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }

    public function about() {
        $this->viewBuilder()->layout('default2');
        $this->loadModel('Staticpages');
        $query = $this->Staticpages->find('all', [
            'conditions' => ['Staticpages.position' => 'aboutus']
        ]);
        $this->set('d', $query->first());
    }

    public function privacypolicy() {
        $this->viewBuilder()->layout('default2');
        $this->loadModel('Staticpages');
        $query = $this->Staticpages->find('all', [
            'conditions' => ['Staticpages.position' => 'privacypolicy']
        ]);
        $this->set('d', $query->first());
    }

    public function howitwork() {
        $this->viewBuilder()->layout('default2');
        $this->loadModel('Staticpages');
        $query = $this->Staticpages->find('all', [
            'conditions' => ['Staticpages.position' => 'howitwork']
        ]);
        $this->set('d', $query->first());
    }

    public function help() {
        $this->viewBuilder()->layout('default2');
        $this->loadModel('Staticpages');
        $query = $this->Staticpages->find('all', [
            'conditions' => ['Staticpages.position' => 'help']
        ]);
        $this->set('d', $query->first());
    }

    public function contact() {
        $this->viewBuilder()->layout('default2');
        if ($this->request->is('post')) {
           
            $ms = "Plait<br/>";
            $ms.='Name:'.$_POST['name'].'<br/>';
            $ms.='Email:'.$_POST['email'].'<br/>';
            $ms.='Mobile:'.$_POST['mobile'].'<br/>';
            $ms.='Subject:'.$_POST['subject'].'<br/>';
            $ms.='Message:'.$_POST['message'].'<br/>';
            $email = new Email('default');
            $email->from(['noreply@plait.co.za' => 'Plait'])
                    ->emailFormat('html')
                    ->template('default', 'default')
                    ->to("ashutosh@avainfotech.com")
                    ->subject('Thanks for Contact us')
                    ->send($ms);
            $this->Flash->success(__('Your message has been sent successfully we will get back to you within 24 hours!'));
            return $this->redirect(['action' => 'contact']);
        }
    }

    public function faq() {
        $this->viewBuilder()->layout('default2');
    }

    public function subscriptionplan() {
        $this->viewBuilder()->layout('default2');
        
    }

    public function didyouknow() {
        $this->viewBuilder()->layout('default2');
        
    }

}
