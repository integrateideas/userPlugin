<?php
namespace Integrateideas\User\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;
use Cake\Event\EventManager;
use Cake\Core\Configure;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Roles
 * @property \Cake\ORM\Association\HasMany $ResetPasswordHashes
 * @property \Cake\ORM\Association\HasMany $UserOldPasswords
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

        $this->hasMany('ResetPasswordHashes', [
            'foreignKey' => 'user_id',
            'className' => 'Integrateideas/User.ResetPasswordHashes'
        ]);
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
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->uuid('uuid')
            ->requirePresence('uuid', 'create')
            ->notEmpty('uuid');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');
        $validator
            ->allowEmpty('role_id');
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

    public function beforeMarshal( \Cake\Event\Event $event, \ArrayObject $data, \ArrayObject $options){
       if (!isset($data['uuid'])) {
           $data['uuid'] = Text::uuid();
       }

    }
    public function findWithDisabled(Query $query, array $options)
    {
        $field = 'Users.status';

        return $query->where(['OR' => [
            $query->newExpr()->add([$field => 1]),
            $query->newExpr()->add([$field =>  0]),
        ]]);

    }
}
