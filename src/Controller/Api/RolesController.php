<?php
namespace Integrateideas\User\Controller\Api;

use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Exception\InternalErrorException;


/**
* Legacy Redemptions Controller
*
* @property \App\Model\Table\LegacyRedemptionsTable $legacyRedemptions
*/
class RolesController extends ApiController
{
	public function initialize()
	{
		parent::initialize();
	}

	/**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {	
    	if(!$this->request->is(['get'])){
			throw new MethodNotAllowedException(__('BAD_REQUEST'));
		}
        $roles = $this->Roles->find()->all();
        $indexEvent = $this->Events->fireEvent('roles.index', $roles);
        $this->set(compact('roles', 'indexEvent'));        
        $this->set('_serialize', ['roles']);
    }
/**
     * View method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {	
    	if(!$this->request->is(['get'])){
			throw new MethodNotAllowedException(__('BAD_REQUEST'));
		}

		if(!isset($id) && $id){
			throw new BadRequestException(__('MANDATORY_FIELD_MISSING','role Id'));
		}

        $role = $this->Roles->get($id, [
            'contain' => ['Roles']
        ]);

        if(!$role){
			throw new NotFoundException(__('ENTITY_DOES_NOT_EXISTS','role'));
		}
		$viewEvent = $this->Events->fireEvent('roles.view', $role);

        $this->set(compact('role','viewEvent'));
        $this->set('_serialize', ['role']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        if (!$this->request->is('post')) {
        	throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }
        
        $addSaveEvent = false;
        if(isset($this->request->data['addSaveEvent']) && $this->request->data['addSaveEvent']){
          $addSaveEvent = $this->request->data['addSaveEvent'];
          unset($this->request->data['addSaveEvent']);
        }

        $role = $this->Roles->newEntity();
        $role = $this->Roles->patchEntity($role, $this->request->getData());
        
        if (!$this->Roles->save($role)) {
            throw new InternalErrorException(__('Could not be saved')); 
        }

		$data = ['addSaveEvent' => $addSaveEvent, 'role' => $role];
		$addSaveEvent = $this->Events->fireEvent('roles.add.save', $data);
        
        $this->set(compact('role', 'addSaveEvent'));
        $this->set('_serialize', ['role']);
    }
	
	/**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if(!$this->request->is(['put'])){
			throw new MethodNotAllowedException(__('BAD_REQUEST'));
		}

		if(!isset($id) && $id){
			throw new BadRequestException(__('MANDATORY_FIELD_MISSING','role Id'));
		}

        $editSaveEvent = false;
		if(isset($this->request->data['editSaveEvent']) && $this->request->data['editSaveEvent']){
          $editSaveEvent = $this->request->data['editSaveEvent'];
          unset($this->request->data['editSaveEvent']);
        }

        $role = $this->Roles->findById($id)->first();
        $role = $this->Roles->patchEntity($role, $this->request->getData());
		
		if (!$this->Roles->save($role)){

            throw new InternalErrorException(__('Could not be saved')); 
        }

        $data = ['editSaveEvent' => $editSaveEvent, 'role' => $role];
        $editSaveEvent = $this->Events->fireEvent('roles.edit.save', $data);

        $this->set(compact('role', 'editSaveEvent'));
        $this->set('_serialize', ['role']);
    }
	
	/**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if(!$this->request->is(['delete'])){
			throw new MethodNotAllowedException(__('BAD_REQUEST'));
		}

		if(!isset($id) && $id){
			throw new BadRequestException(__('MANDATORY_FIELD_MISSING','role Id'));
		}

        $role = $this->Roles->get($id);
        if (!$this->Roles->delete($role)) {
            throw new InternalErrorException(__('Could not be deleted')); 
        }

        $deleteEvent = $this->Events->fireEvent('roles.delete', $role);
        $response = ['message' => 'Role has been deleted', 'deleteEvent' => $deleteEvent];

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

}
