<?php
namespace Integrateideas\User\Controller;

use Integrateideas\User\Controller\SocialAppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Routing\Router;
use Cake\Network\Session;
use Hybrid_Auth;
use Hybrid_Endpoint;

/**
 * Users Controller
 *
 * @property \Integrateideas\User\Model\Table\UsersTable $Users
 *
 * @method \Integrateideas\User\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class SocialConnectionController extends SocialAppController
{

  public function initialize(){
    parent::initialize();
    $this->Auth->allow(['login']);
  }

  public function login(){

    if (isset($this->request->query['hauth_start']) || isset($this->request->query['hauth_done']))
    {
      Hybrid_Endpoint::process();
    }else{
      $hybridConfig = Configure::read('HybridAuth');
      $hybridauth = new Hybrid_Auth($hybridConfig );
      // $hybridauth = $hybridauth->getAdapter('Facebook');
      $hybridauth = $hybridauth->authenticate( "Facebook" );
      pr($hybridauth->getUserProfile());die;
    }
  }


  public function logout()
  {
    $this->Flash->success('You are now logged out.');
    $session = $this->request->session();
    $session->destroy();
    $this->redirect($this->Auth->logout());
  }


}
