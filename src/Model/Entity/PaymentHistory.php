<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PaymentHistory Entity
 *
 * @property int $id
 * @property int $cart_id
 * @property int $uid
 * @property string $checksum_id
 * @property string $txn_id
 * @property string $amt
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Cart $cart
 * @property \App\Model\Entity\Checksum $checksum
 * @property \App\Model\Entity\Txn $txn
 */
class PaymentHistory extends Entity
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
