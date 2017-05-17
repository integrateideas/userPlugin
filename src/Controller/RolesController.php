<?php
namespace Integrateideas\User\Controller;

use Integrateideas\User\Controller\AppController;

/**
 * Roles Controller
 *
 * @property \Integrateideas\User\Model\Table\RolesTable $Roles
 *
 * @method \Integrateideas\User\Model\Entity\Role[] paginate($object = null, array $settings = [])
 */
class RolesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $roles = $this->paginate($this->Roles);
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
        $role = $this->Roles->get($id, [
            'contain' => ['Users']
        ]);

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
        $addEnterEvent = $this->Events->fireEvent('roles.add.enter', []);
        $role = $this->Roles->newEntity();
        if ($this->request->is('post')) {
            // pr($this->request->data);
            $addSaveEvent = false;
            if(isset($this->request->data['addSaveEvent']) && $this->request->data['addSaveEvent']){
              $addSaveEvent = $this->request->data['addSaveEvent'];
              unset($this->request->data['addSaveEvent']);
            }

            $role = $this->Roles->patchEntity($role, $this->request->getData());
            // pr($role);die;
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));
                $data = ['addSaveEvent' => $addSaveEvent, 'role' => $role];
                $addSaveEvent = $this->Events->fireEvent('roles.add.save', $data);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $this->set(compact('role', 'addEnterEvent'));
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
        $role = $this->Roles->get($id, [
            'contain' => []
        ]);

        $editEnterEvent = $this->Events->fireEvent('roles.edit.enter', $user);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $editSaveEvent = false;
            if(isset($this->request->data['editSaveEvent']) && $this->request->data['editSaveEvent']){
                $editSaveEvent = $this->request->data['editSaveEvent'];
                unset($this->request->data['editSaveEvent']);
            }

            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));
                
                $data = ['editSaveEvent' => $editSaveEvent, 'role' => $role];
                $editSaveEvent = $this->Events->fireEvent('roles.edit.save', $data);
                
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $this->set(compact('role'));
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
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            $this->Flash->success(__('The role has been deleted.'));
            $this->Events->fireEvent('roles.delete', $role);
        } else {
            $this->Flash->error(__('The role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
