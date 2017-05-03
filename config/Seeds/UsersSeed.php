<?php
use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Text;

/**
 * Roles seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
      $hasher = new DefaultPasswordHasher();
        $data = [
                    [
                      'first_name'    => 'admin',
                      'last_name'    => 'admin',
                      'username' => 'admin',
                      'email'   =>'kshitiz.sekhri@twinspark.co',
                      'password'   =>$hasher->hash('12345678'),
                      'uuid'=>Text::uuid(),
                      'phone'=> '9999999999',
                      'role_id'=>'1',
                      'created' => '2017-04-20 10:01:27',
                      'modified'=> '2017-04-20 10:01:27'
                      ]
                    
                     
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
