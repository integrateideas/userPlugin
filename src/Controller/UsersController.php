<?php
namespace Integrateideas\User\Controller;

use Integrateideas\User\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Session;
use Cake\Auth\DefaultPasswordHasher;
use Cake\I18n\Time;
use Cake\Routing\Router;
use Cake\Mailer\Email;
/**
 * Users Controller
 *
 * @property \Integrateideas\User\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    const SUPER_ADMIN_LABEL = 'admin';
    const MANAGEMENT_LABEL = 'manager';
    const EMPLOYEES_LABEL = 'employee';

    public function initialize(){
        parent::initialize();
        $this->Auth->config('authorize', ['Controller']);
        $this->Auth->allow(['add','logout','forgotPassword','resetPassword']);
    }

    public function index()
    {
        // $users = $this->Users->find('WithDisabled')->contain(['Roles'])->where(['Users.username !=' => 'admin'])->all();
        // $loggedInUser = $this->Auth->user();
        // if($loggedInUser['role']->name == self::SUPER_ADMIN_LABEL){      
        //     $users = $this->Users->find('WithDisabled')->contain(['Roles'])->all();    
        //     $roles = $this->Users->Roles->find('list')->where(['status'=>1])->all()->toArray();
        // }
        // else if($loggedInUser['role']->name == self::STAFF_ADMIN_LABEL){
        //     $users = $this->Users->find('WithDisabled')->contain(['Roles'])->where(['Roles.name <>'=>self::SUPER_ADMIN_LABEL])->all();
        // }
        // else {
        //     $users = $this->Users->find('WithDisabled')->contain(['Roles'])->where(['Roles.name'=>self::STAFF_MANAGER_LABEL])->all();
        //     $roles = $this->Users->Roles->find('list')->where(['status'=>1,'name <>'=>'admin'])->all()->toArray();
        // }
        $users = $this->Users->find('WithDisabled')->all();
        // pr($users);die;
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
        // $this->set('loggedInUser', $loggedInUser);
    }


    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {   
        $user = $this->Users->find('WithDisabled')->contain(['Roles'])->where(['Users.id' => $id])->first();
          if(!$user){
          $this->Flash->error(__('USER NOT FOUND'));
          $this->redirect(['action' => 'index']);
        }
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if(!$user->errors()){
            if ($this->Users->save($user)) {
              $this->Flash->success(__('The user has been saved.'));
              $this->_fireEvent('registerUser', $user);
              if($user['role_id'] == '1'){  
                return $this->redirect('/users/adminDashboard');
              }elseif ($user['role_id'] == '2') {
                return $this->redirect('/users/managementDashboard');
              }else{
                return $this->redirect('/users/employeeDashboard');
              }
            }else{
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
          }else{
            $this->Flash->error(__('KINDLY_PROVIDE_VALID_DATA'));
          }
      }

      $loggedInUser = $this->Auth->user();
      if($loggedInUser['role']->name == self::SUPER_ADMIN_LABEL){
          $roles = $this->Users->Roles->find('list')->where(['status'=>1])->all()->toArray();
      }elseif ($loggedInUser['role']->name == self::MANAGEMENT_LABEL) {
          $roles = $this->Users->Roles->find('list')->where(['status'=>1,'name <>'=>'admin'])->all()->toArray();
      }else {
        $roles = $this->Users->Roles->find('list')->where(['status'=>1,'name '=>'employee'])->all()->toArray();
      }
      $this->set('roles', $roles);
      $this->set('user', $user);
      $this->set('loggedInUser', $loggedInUser);
      $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
            ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $loggedInUser = $this->Auth->user();
        if($loggedInUser['role']->name == self::SUPER_ADMIN_LABEL){
            $roles = $this->Users->Roles->find('list')->where(['status'=>1])->all()->toArray();
        }elseif ($loggedInUser['role']->name == self::MANAGEMENT_LABEL) {
            $roles = $this->Users->Roles->find('list')->where(['status'=>1,'name <>'=>'admin'])->all()->toArray();
        }else {
          $roles = $this->Users->Roles->find('list')->where(['status'=>1,'name '=>'employee'])->all()->toArray();
        }
  
        $this->set('loggedInUser', $loggedInUser);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->loadModel('Roles');
                $user['role'] = $query = $this->Roles->findById($user['role_id'])->select(['name', 'label'])->first();
                $this->Auth->setUser($user);
                //Setup Session Data to Handle View Elements
                $loggedInUser = $this->Auth->user();
                $userId = $loggedInUser['id'];
                $roleName = $loggedInUser['role']->name;
                $className = '\App\Integrateideas\User\CustomRedirect';
                $redirectUrl = new $className();
                $redirectUrl = $redirectUrl->getRedirectUrl($roleName);
                $this->redirect($redirectUrl);
            }else{
                $this->Flash->error(__('LOGIN_FAILED'));
            }
        }
    }

    private function _isPasswordResetRequired(){
    $user = $this->Auth->user();
    $this->loadModel('UserOldPasswords');
    $userOldPasswordCheck = $this->UserOldPasswords->find('all')
    ->where(['user_id'=>$user['id']])
    ->order('created DESC')
    ->first();
    if(!empty($userOldPasswordCheck)){
      $time = new Time($userOldPasswordCheck->modified);
    }else{
      $time = new Time($user['created']);
    }
    if(!$time->wasWithinLast(60)){
      $resetPwdHash =$this->_createResetPasswordHash($user['id'],$user['uuid']);
      return $resetPwdHash;
    }else{
      return false;
    }

  }

    protected function _createResetPasswordHash($userId,$uuid){
        $this->loadModel('ResetPasswordHashes');
        $hasher = new DefaultPasswordHasher();
        $reqData = ['user_id'=>$userId,'hash'=> $hasher->hash($uuid)];
        $this->ResetPasswordHashes->addBehavior('Timestamp');
        $createPasswordhash = $this->ResetPasswordHashes->newEntity();
        $createPasswordhash = $this->ResetPasswordHashes->patchEntity($createPasswordhash,$reqData);
        if($this->ResetPasswordHashes->save($createPasswordhash)){

          return $createPasswordhash->hash;
      }else{
          pr($reqData->errors());die;
      }
  }

  public function forgotPassword(){

    if($this->Auth->user()){
      $this->Flash->error(__("UNAUTHORIZED_REQUEST"));
      $this->redirect(['action' => 'logout']);
  }
  if($this->request->is('post')){

      $email = $this->request->data['email'];
      $created = '';
      $user = $this->Users->find('all')->where(['email'=>$email])->first();
      if(!$user){
        return $this->Flash->error(__('ENTITY_DOES_NOT_EXISTS','Email'));
    }
    $this->loadModel('ResetPasswordHashes');
    if(empty($checkExistPasswordHash)){
    $checkExistPasswordHash = $this->ResetPasswordHashes->find()->where(['user_id'=>$user->id])->first();
    $resetPwdHash = $this->_createResetPasswordHash($user->id,$user->uuid);
    }else{
        $resetPwdHash = $checkExistPasswordHash->hash;
        $time = new Time($checkExistPasswordHash->created);
        if(!$time->wasWithinLast(1)){
          $this->ResetPasswordHashes->delete($checkExistPasswordHash);
          $resetPwdHash =$this->_createResetPasswordHash($user->id,$user->uuid);
      }
  }
  $resetPwdHash = [$resetPwdHash,$email];
  $this->_fireEvent('forgotPassword', $resetPwdHash);
  }
}

public function forceResetPassword()
  {
    $uuid = $this->request->query('reset-token');
    if ($this->request->is('get') && !$uuid) {
      $this->Flash->error(__('BAD_REQUEST'));
      $this->redirect(['action' => 'login']);
    }
    $this->set('resetToken',$uuid);
    $this->set('_serialize', ['reset-token']);
  }

public function resetPassword(){
    $uuid = $this->request->query('reset-token');
    if ($this->request->is('get') && !$uuid) {
      $this->Flash->error(__('BAD_REQUEST'));
      $this->redirect(['action' => 'login']);
      return;
    }
     if ($this->request->is('post')) {
      $uuid = (isset($this->request->data['reset-token']))?$this->request->data['reset-token']:'';

      if(!$uuid){
        $this->Flash->error(__('BAD_REQUEST'));
        $this->redirect(['action' => 'login']);
        return;
      }
      $password = (isset($this->request->data['new_pwd']))?$this->request->data['new_pwd']:'';
      if(!$password){
        $this->Flash->error(__('PROVIDE_PASSWORD'));
        $this->redirect(['action' => 'resetPassword','?'=>['reset-token'=>$uuid]]);
        return;
      }
      $cnfPassword = (isset($this->request->data['cnf_new_pwd']))?$this->request->data['cnf_new_pwd']:'';
      if(!$cnfPassword){
        $this->Flash->error(__('CONFIRM_PASSWORD'));
        $this->redirect(['action' => 'resetPassword','?'=>['reset-token'=>$uuid]]);
        return;
      }
      if($password !== $cnfPassword){
        $this->Flash->error(__('MISMATCH_PASSWORD'));
        $this->redirect(['action' => 'resetPassword','?'=>['reset-token'=>$uuid]]);
        return;
      }
      $this->loadModel('ResetPasswordHashes');
      // $this->ResetPasswordHashes->addBehavior('Timestamp');
      $checkExistPasswordHash = $this->ResetPasswordHashes->find()->where(['hash'=>$uuid])->first();
      // pr($checkExistPasswordHash);die;
      if(!$checkExistPasswordHash){
        $this->Flash->error(__('INVALID_RESET_PASSWORD'));
        $this->redirect(['action' => 'login']);
        return;
      }
      $userUpdate = $this->Users->findById($checkExistPasswordHash->user_id)->first();
      if(!$userUpdate){
        $this->Flash->error(__('ENTITY_DOES_NOT_EXISTS','User'));
        $this->redirect(['action' => 'login']);
        return;
      }
      if(! preg_match("/^[A-Za-z0-9~!@#$%^*&;?.+_]{8,}$/", $password)){
        $this->Flash->error(__('PASSWORD_CONDITION'));
        $this->redirect(['action' => 'resetPassword','?'=>['reset-token'=>$uuid]]);
        return;
      }
      $isContainChars = false;
      for( $i = 0; $i <= strlen($userUpdate->username)-3; $i++ ) {
        $char = substr( $userUpdate->username, $i, 3 );
        if(strpos($password,$char,0) !== false ){
          $isContainChars = true;
          break;
        }
      }
      if($isContainChars){
        $this->Flash->error(__('PASSWORD_USER_CONDITION'));
        $this->redirect(['action' => 'resetPassword','?'=>['reset-token'=>$uuid]]);
        return;
      }
      $fullname = $userUpdate->full_name;
      // pr($fullname);die;  
      for( $i = 0; $i <= strlen($fullname)-3; $i++ ) {
        $char = substr( $fullname, $i, 3 );
        if(strpos($password,$char,0) !== false ){
          $isContainChars = true;
          break;
        }
      }
      if($isContainChars){
        $this->Flash->error(__('PASSWORD_NAME_CONDITION'));
        $this->redirect(['action' => 'resetPassword','?'=>['reset-token'=>$uuid]]);
        return;
      }
      $reqData = ['password'=>$password];
      $this->loadModel('UserOldPasswords');
      $this->UserOldPasswords->addBehavior('Timestamp');
      $userOldPasswordCheck = $this->UserOldPasswords->find('all')->where(['user_id'=>$checkExistPasswordHash->user_id])->toArray();
      $hasher = new DefaultPasswordHasher();
      foreach ($userOldPasswordCheck as $key => $value) {
        if($hasher->check( $password,$value['password'])){
          $this->Flash->error(__('PASSWORD_LIMIT'));
          $this->redirect(['action' => 'resetPassword','?'=>['reset-token'=>$uuid]]);
          return;
        }
      }
      $userUpdate = $this->Users->patchEntity($userUpdate,$reqData);
      if($this->Users->save($userUpdate)){

        $reqData = ['user_id'=>$checkExistPasswordHash->user_id,'password'=>$password];

        $userOldPasswordCheck = $this->UserOldPasswords->newEntity($reqData);
        $userOldPasswordCheck = $this->UserOldPasswords->patchEntity($userOldPasswordCheck, $reqData);
        if($this->UserOldPasswords->save($userOldPasswordCheck)){
          $userOldPasswordCheck = $this->UserOldPasswords->find('all')->where(['user_id'=>$checkExistPasswordHash->user_id]);
          if($userOldPasswordCheck->count() > 6){
            $userOldPasswordCheck =$userOldPasswordCheck->order('created ASC')->first();
            $userOldPasswordCheck = $this->UserOldPasswords->delete($userOldPasswordCheck);

          }
          $this->ResetPasswordHashes->delete($checkExistPasswordHash);
        }else{
  // pr($userOldPasswordCheck->errors());die;
  //log password not changed
  // throw new BadRequestException(__('can not use earlier used 6 passwords'));
        }

        $this->Flash->success(__('NEW_PASSWORD_UPDATED'));
        $this->redirect(['action' => 'login']);
      }else{
        $this->Flash->error(__('KINDLY_PROVIDE_VALID_DATA'));
        $this->redirect(['action' => 'resetPassword','?'=>['reset-token'=>$uuid]]);
      }
  }
    $this->set('resetToken',$uuid);
    $this->set('_serialize', ['reset-token']);
}

    public function logout()
    {
        $user = $this->Auth->user();
        $this->redirect($this->Auth->logout());
        $this->Flash->success('You are now logged out.');
    }

    protected function _fireEvent($name, $data){
        $name = 'PerformanceMonitoring.'.$name;
        $event = new Event($name, $this, [
                $name => $data
            ]);
        $this->eventManager()->dispatch($event);
    }
}
