<?php
namespace Integrateideas\User\Controller;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Routing\Router;
use Cake\Network\Session;
use Hybrid_Auth;
use Cake\Core\Configure;
use Hybrid_Endpoint;
use Cake\Event\Event;
use Cake\Log\Log;
//use Integrateideas\User\Controller\AppController;
use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \Integrateideas\User\Model\Table\UsersTable $Users
 *
 * @method \Integrateideas\User\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UserSocialConnectionsController extends AppController
{

  public function initialize(){
    parent::initialize();
    $this->Auth->allow(['login']);
  }
  /**
    * Allow methods 'endpoint' and 'authenticated'.
    *
    * @param \Cake\Event\Event $event Before filter event.
    * @return void
    */
   public function beforeFilter(Event $event)
   {
       parent::beforeFilter($event);
       $this->Auth->allow(['endpoint', 'authenticated']);
   }

   /**
    * Endpoint method
    *
    * @return void
    */
   public function endpoint()
   {
       $this->request->session()->start();
       \Hybrid_Endpoint::process();
   }

   /**
    * This action exists just to ensure AuthComponent fetches user info from
    * hybridauth after successful login
    *
    * Hyridauth's `hauth_return_to` is set to this action.
    *
    * @return \Cake\Network\Response
    */
   public function authenticated()
   {
       $user = $this->Auth->identify();
       pr($user);die;
       if ($user) {
           $this->Auth->setUser($user);
           Log::write('debug', json_encode($user));
           return $this->redirect($this->Auth->redirectUrl());
       }
       return $this->redirect($this->Auth->config('loginAction'));
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
