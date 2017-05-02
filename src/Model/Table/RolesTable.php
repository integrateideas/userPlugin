<?php
namespace Integrateideas\User\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Behavior\TimestampBehavior;

/**
 * ResetPasswordHashes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \Integrateideas\User\Model\Entity\ResetPasswordHash get($primaryKey, $options = [])
 * @method \Integrateideas\User\Model\Entity\ResetPasswordHash newEntity($data = null, array $options = [])
 * @method \Integrateideas\User\Model\Entity\ResetPasswordHash[] newEntities(array $data, array $options = [])
 * @method \Integrateideas\User\Model\Entity\ResetPasswordHash|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Integrateideas\User\Model\Entity\ResetPasswordHash patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Integrateideas\User\Model\Entity\ResetPasswordHash[] patchEntities($entities, array $data, array $options = [])
 * @method \Integrateideas\User\Model\Entity\ResetPasswordHash findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RolesTable extends Table
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

        $this->table('roles');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Users', [
            'foreignKey' => 'role_id',
            'className' => 'Integrateideas/User.Roles'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('label', 'create')
            ->notEmpty('label');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function findRolesByName(Query $query, array $options)
    {
        $role = $options['role'];
        return $query->where(['name' => $role['name']]);
    }
    public function findRolesById(Query $query, array $options)
    {
        return $query->where(['id' => $options['role']]);
    }
}
