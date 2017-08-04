<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property int $uid
 * @property int $order_item_count
 * @property int $subscription_plan_type
 * @property int $status
 * @property string $ip_address
 * @property \Cake\I18n\Time $created
 * @property string $notes
 * @property \Cake\I18n\Time $modified
 * @property int $delivery_status
 *
 * @property \App\Model\Entity\OrderItem[] $order_items
 */
class Order extends Entity
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
