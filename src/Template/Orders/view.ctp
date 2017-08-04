<?php 
use Cake\Utility\Security;
$key = 'absbsbsbs123585s55s85s852s202s55s8';   
?>
<div class="order-history_sec">
    <div class="container">
        <div class="order-history_inner clearfix">
            <h1>Order ID:-<?= h($order->id) ?></h1>
            <div class="row">
                <div class="table-responsive">
                   
        <h4><?= __('Order Items') ?></h4>
        <?php if (!empty($order->order_items)): ?>
      <table class="table table-bordered ordr-h_tbl">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Order Id') ?></th>
                <th scope="col"><?= __('DayName') ?></th>
                <th scope="col"><?= __('Food Time') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($order->order_items as $orderItems): ?>
            <tr> 
                
                <td><?= h($orderItems->id) ?></td>
                <td><?= h($orderItems->order_id) ?></td>
                <td><?= h($orderItems->dayname) ?></td>
                <td><?= h($orderItems->foodtime) ?></td>
                <td><?= h($orderItems->quantity) ?></td>
                <td><?= h($orderItems->created) ?></td>
                <td class="actions">
                    
                    <?= $this->Html->link(__('View'), ['controller' => 'OrderItems', 'action' => 'view', base64_encode($orderItems->id)]) ?>                  
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
            </div></div>
