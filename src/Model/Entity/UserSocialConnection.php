<?php
namespace Integrateideas\User\Model\Entity;

use Cake\ORM\Entity;

/**
 * HybridAuth Authenticate
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 */
class UserSocialConnection extends Entity
{

    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
