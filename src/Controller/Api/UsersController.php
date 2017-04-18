<?php
namespace Integrateideas\User\Controller\Api;

use Integrateideas\User\Controller\Api\ApiController;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ConflictException;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Exception\InternalErrorException;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Collection\Collection;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Routing\Router;

/**
* Legacy Redemptions Controller
*
* @property \App\Model\Table\LegacyRedemptionsTable $legacyRedemptions
*/
class UsersController extends ApiController
{
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('RequestHandler');

	}
	/** */
	public function updatePassword(){
		// echo "here"; die();
		if(!$this->request->is(['put'])){
			throw new MethodNotAllowedException(__('BAD_REQUEST'));
		}
		$data = $this->request->data;
		// pr($data); die();
		if(!isset($data['new_password'])){
			throw new BadRequestException(__('MANDATORY_FIELD_MISSING','new_password'));
		}
		if(isset($data['new_password']) && empty($data['new_password'])){
			throw new BadRequestException(__('EMPTY_NOT_ALLOWED','new_password'));
		}
		if(!isset($data['old_password'])){
			throw new BadRequestException(__('MANDATORY_FIELD_MISSING','old_password'));
		}
		if(isset($data['old_password']) && empty($data['old_password'])){
			throw new BadRequestException(__('EMPTY_NOT_ALLOWED','old_password'));
		}
		if(!isset($data['user_id'])){
			throw new BadRequestException(__('MANDATORY_FIELD_MISSING','user_id'));
		}
		if(isset($data['user_id']) && empty($data['user_id'])){
			throw new BadRequestException(__('EMPTY_NOT_ALLOWED','user_id'));
		}
		$id = $data['user_id'];
		$user = $this->Users->find()->where(['id'=>$id])->first();
		//pr($user); die('user');
		if(!$user){
			throw new NotFoundException(__('ENTITY_DOES_NOT_EXISTS','User'));
		}
		$password = $data['new_password'];
		$oldPassword = $data['old_password'];
// 		pr($oldPassword); 
// pr($user->password);
// 		die('old pass');


		$hasher = new DefaultPasswordHasher();
		// pr($hasher);die('here in hasher');
		if(!$hasher->check( $oldPassword,$user->password)){
			//pr($hasher->check); die('ss');
			throw new BadRequestException(__('UNAUTHORIZED_PROVIDE_OLD_PASSWORD'));
		}
		//pr('qq'); die();
		if(! preg_match("/^[A-Za-z0-9~!@#$%^*&;?.+_]{8,}$/", $password)){
			throw new BadRequestException(__('Only numbers 0-9, alphabets a-z A-Z and special characters ~!@#$%^*&;?.+_ are allowed.'));
		}
		$reqData = ['password'=>$password];
		//pr($reqData);die('ie');

		$isContainChars = false;
		for( $i = 0; $i <= strlen($user->username)-3; $i++ ) {
			$char = substr( $user->username, $i, 3 );
			if(strpos($password,$char,0) !== false ){
				$isContainChars = true;
				break;
			}
		}
		if($isContainChars){
			throw new BadRequestException(__('THREE_CONTIGUOUS_CHARACTERS','username'));
		}
		$fullname = $user->full_name;
		for( $i = 0; $i <= strlen($fullname)-3; $i++ ) {
			$char = substr( $fullname, $i, 3 );
			if(strpos($password,$char,0) !== false ){
				$isContainChars = true;
				break;
			}
		}
		if($isContainChars){
			throw new BadRequestException(__('THREE_CONTIGUOUS_CHARACTERS','full name'));
		}
		$this->loadModel('UserOldPasswords');

		$userOldPasswordCheck = $this->UserOldPasswords->find('all')->where(['user_id'=>$id])->toArray();
		foreach ($userOldPasswordCheck as $key => $value) {
			if($hasher->check( $password,$value['password'])){
				throw new BadRequestException(__('SIX_EARLIER_PASSWORD'));
			}
		}
		$user = $this->Users->patchEntity($user, $reqData);
		if($this->Users->save($user)){
			$reqData = ['user_id'=>$id,'password'=>$password];

			$userOldPasswordCheck = $this->UserOldPasswords->newEntity($reqData);
			$userOldPasswordCheck = $this->UserOldPasswords->patchEntity($userOldPasswordCheck, $reqData);
			if($this->UserOldPasswords->save($userOldPasswordCheck)){
				$userOldPasswordCheck = $this->UserOldPasswords->find('all')->where(['user_id'=>$id]);
				if($userOldPasswordCheck->count() > 6){
					$userOldPasswordCheck =$userOldPasswordCheck->order('created ASC')->first();
					$userOldPasswordCheck = $this->UserOldPasswords->delete($userOldPasswordCheck);
				}
				$data =array();
				$data['status']=true;
				$data['data']['id']=$user->id;
				$data['data']['message']='password saved';
				$this->set('response',$data);
				$this->set('_serialize', ['response']);

			}else{
				// pr($userOldPasswordCheck->errors());die;
				//log password not changed
				// throw new BadRequestException(__('can not use earlier used 6 passwords'));
			}
		}else{	
			// pr($user->errors());die;
			throw new BadRequestException(__('BAD_REQUEST'));
		}

	}

}
