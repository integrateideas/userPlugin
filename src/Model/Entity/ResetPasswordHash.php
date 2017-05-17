<?php
namespace Integrateideas\User\Model\Entity;

use Cake\ORM\Entity;

/**
 * ResetPasswordHash Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $hash
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Integrateideas\User\Model\Entity\User $user
 */
class ResetPasswordHash extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
