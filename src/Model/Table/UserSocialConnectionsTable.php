<?php
namespace Integrateideas\User\Model\Table;

use Cake\ORM\Table;

/**
 * HybridAuth Authenticate
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 */
class UserSocialConnectionsTable extends Table
{

    /**
     * Initialize table.
     *
     * @param array $config Configuration
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users');
        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'className' => 'Integrateideas/User.Users'
        ]);
    }
}