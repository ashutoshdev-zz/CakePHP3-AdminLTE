<?php

namespace App\Shell;

use Cake\Console\Shell;

class HelloShell extends Shell {

    public function main() {
        $this->loadModel('Users');
        $query = $this->Users->find('all');
        $User = $query->first();
        //print_r($User);
    }

}

?>