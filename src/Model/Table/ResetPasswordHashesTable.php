<?php
namespace Integrateideas\User\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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
class ResetPasswordHashesTable extends Table
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

        $this->setTable('reset_password_hashes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Integrateideas/User.Users'
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
            ->requirePresence('hash', 'create')
            ->notEmpty('hash');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
