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

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Routing\Router;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth');
        $userdata = $this->Auth->user();
        $this->set('loggeduser', $userdata);
        
    }
    
    

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event) {
      
        if (!array_key_exists('_serialize', $this->viewVars) &&
                in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
        if (($this->request->params['prefix'] === 'dashboard') && ( $this->Auth->user('role') != 'admin')) {
            echo '<a href="' . $this->request->webroot . 'dashboard/users/logout">Logout</a><br />';
            die('Invalid request');
        }
        if (($this->request->params['prefix'] === 'vendor') && ($this->Auth->user('role') != 'vendor')) {
            echo '<a href="' . $this->request->webroot . 'vendor/users/logout">Logout</a><br />';
            die('Invalid request');
        }
        $this->set('base_url', Router::fullbaseUrl().'/plait');
        
    }

    /**
     * allow cross origin url
     * @return json_decode($postdata) this is for get content from ionic resquest url
     */
    protected function CrOrgn() {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        $postdata = file_get_contents("php://input");
        return json_decode($postdata);
    }

    /**
     * write data in file=data.txt
     * folder=txtfile
     * @param type $data
     */
    protected function filewrite($data = NULL) {
        ob_start();
        print_r($data);
        $c = ob_get_clean();
        $fc = fopen('txtfile' . DS . 'data.txt', 'w');
        fwrite($fc, $c);
        fclose($fc);
    }

    /**
     * find url from string
     * @param type $haystack
     * @param type $needle
     * @param type $offset
     * @return boolean
     */
    protected function strposa($haystack, $needle, $offset = 0) {
        if (!is_array($needle))
            $needle = array($needle);
        foreach ($needle as $query) {
            if (strpos($haystack, $query, $offset) !== false)
                return true; // stop on first true result
        }
        return false;
    }

    public function authcontent() {
        $this->set('userdata', $this->Auth->user());
    }

    protected function getLetLong($complete_address) {
        if (!empty($complete_address)) {
            $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $complete_address . '&sensor=true', false);
            $output = json_decode($geocodeFromAddr);
            if (!empty($output)) {
                $data['latitude'] = $output->results[0]->geometry->location->lat;
                $data['longitude'] = $output->results[0]->geometry->location->lng;
            }
            if (!empty($data)) {

                return $data;
            } else {
                $data['latitude'] = 0;
                $data['longitude'] = 0;
            }
        }
    }

    protected function distance($lat1, $lon1, $lat2, $lon2, $unit) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

}
