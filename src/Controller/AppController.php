<?php

namespace Integrateideas\User\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{
	const SUPER_ADMIN_LABEL = 'admin';
    const STAFF_ADMIN_LABEL = 'staff_admin';
    const STAFF_MANAGER_LABEL = 'staff_manager';

	public function initialize()
    {
    	parent::initialize();
    	$this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
        	'authorize' => 'Controller',
            'authenticate' => [
                'Form' => [
                    // 'fields' => [
                    //     'username' => 'username',
                    //     'password' => 'password'
                    // ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'unauthorizedRedirect' => $this->referer() // If unauthorized, return them to page they were just on
        ]);

        // Allow the display action so our pages controller
        // continues to work.
        $this->Auth->allow(['display']);
    }
    public function isAuthorized($user)
	{
    return true;
	}
}
