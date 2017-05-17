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
        $this->loadComponent('Auth', [
        	'authorize' => 'Controller',
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            // 'unauthorizedRedirect' => $this->referer() // If unauthorized, return them to page they were just on
        ]);
    }

    public function isAuthorized($user){
    	return true;
    }

}
