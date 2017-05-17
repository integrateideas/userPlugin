<?php

namespace Integrateideas\User\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{

	public function initialize()
    {
    	parent::initialize();
    	$this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Integrateideas/User.Events');
    }

}
