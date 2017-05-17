<?php
namespace Integrateideas\User\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Inflector;
use Cake\Utility\Text;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \Integrateideas\User\Model\Entity\User get($primaryKey, $options = [])
 * @method \Integrateideas\User\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \Integrateideas\User\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \Integrateideas\User\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Integrateideas\User\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Integrateideas\User\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \Integrateideas\User\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER',
            'className' => 'Integrateideas/User.Roles'
        ]);

        $this->hasMany('UserOldPasswords', [
            'foreignKey' => 'user_id',
            'className' => 'Integrateideas/User.UserOldPasswords'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('first_name');

        $validator
            ->allowEmpty('last_name');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('phone');

        // $validator
        //     ->requirePresence('uuid', 'create')
        //     ->notEmpty('uuid');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->dateTime('is_deleted')
            ->allowEmpty('is_deleted');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }

     public function beforeSave( \Cake\Event\Event $event, $entity, \ArrayObject $options){
      if ($entity->isNew()){
           $entity->uuid = Text::uuid();
       }
    }

    public function getUsername($data){

      $proposedUsername = $data['email'];
      $usernameExists = $this->find('all')->where(['username'=> $proposedUsername])->count();

      //check if username generated from email
      if($usernameExists > 0){
        $proposedUsername1 = $data['first_name'].$data['last_name'];
        $proposedUsername1 = Inflector::slug(strtolower($proposedUsername1));
        $username = $proposedUsername1;
        $usernameExists1 = $this->find('all')->where(['username LIKE'=>$proposedUsername1.'%'])->count();

        //check if username from first and last name already  exists
        if($usernameExists1 > 0){
          $auto = 1;
          $countIncrement = $usernameExists1+$auto;
          $username = $proposedUsername1.$countIncrement;
        }

        return $username;

      }else{

        return $proposedUsername;
      } 
    }
}
