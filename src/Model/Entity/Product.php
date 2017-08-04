<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property int $available_quantity
 * @property int $subscription_plan_id
 * @property int $user_id
 * @property string $alergy_id
 * @property int $day_id
 * @property int $category_id
 * @property int $subcategory_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\SubscriptionPlan $subscription_plan
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Alergy $alergy
 * @property \App\Model\Entity\Day $day
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Subcategory $subcategory
 * @property \App\Model\Entity\OrderItem[] $order_items
 */
class Product extends Entity
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
