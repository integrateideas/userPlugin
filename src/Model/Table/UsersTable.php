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
      $this->hasMany('ADmad/HybridAuth.UserSocialConnections');

      \Cake\Event\EventManager::instance()->on('HybridAuth.newUser', [$this, 'createUser']);
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
      ->boolean('status');
            // ->requirePresence('status', 'create')
            // ->notEmpty('status');

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

  public function getPassword( $type = 'alnum', $length = 8 )
  {
    switch ( $type ) {
      case 'alnum':
      $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      break;
      case 'alpha':
      $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      break;
      case 'hexdec':
      $pool = '0123456789abcdef';
      break;
      case 'numeric':
      $pool = '0123456789';
      break;
      case 'nozero':
      $pool = '123456789';
      break;
      case 'distinct':
      $pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
      break;
      default:
      $pool = (string) $type;
      break;
    }


    $crypto_rand_secure = function ( $min, $max ) {
      $range = $max - $min;
          if ( $range < 0 ) return $min; // not so random...
          $log    = log( $range, 2 );
          $bytes  = (int) ( $log / 8 ) + 1; // length in bytes
          $bits   = (int) $log + 1; // length in bits
          $filter = (int) ( 1 << $bits ) - 1; // set all lower bits to 1
          do {
            $rnd = hexdec( bin2hex( openssl_random_pseudo_bytes( $bytes ) ) );
            $rnd = $rnd & $filter; // discard irrelevant bits
          } while ( $rnd >= $range );
          return $min + $rnd;
        };

        $token = "";
        $max   = strlen( $pool );
        for ( $i = 0; $i < $length; $i++ ) {
          $token .= $pool[$crypto_rand_secure( 0, $max )];
        }
        return $token;
      }    
      public function createUser(\Cake\Event\Event $event) {
        $profile = $event->data()['profile'];
        $req = [
        'email' => $profile->email,
        'username'=>$this->_suggestUsername($profile->first_name.$profile->last_name),
        'first_name' => $profile->first_name,
        'last_name' => $profile->last_name,
        'password'=>'12345678'
        ];
        $user = $this->newEntity($req);
        $user = $this->patchEntity($user,$req);
        $user = $this->save($user);
        if (!$user) {
          throw new \RuntimeException('Unable to register new user');
        }

        return $user;
      }

      protected function _suggestUsername($name){

        $name = trim(strtolower($name));
  // pr($tempUsername); die;
        $usernameCheck1 = $this->find()->where(['username' => $name])->first();
        if(!$usernameCheck1){
          $username = $name;
        }else{
          $usernameCheck2 = $this->find()->where(['username LIKE' => $name.'%'])->all()->toArray();
          if(!count($usernameCheck2)){
            $username = $name;
          }else{
            $username = $name.count($usernameCheck2);
          }
        }
        return $username;

      }
    }
