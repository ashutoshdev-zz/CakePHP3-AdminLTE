<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WeeklyShedule Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property string $dayname
 * @property string $foodtime
 * @property int $quantity
 * @property string $alergy_id
 * @property string $cfood_id
 * @property int $dl_status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Alergy $alergy
 * @property \App\Model\Entity\Cfood $cfood
 */
class WeeklyShedule extends Entity
{

}
