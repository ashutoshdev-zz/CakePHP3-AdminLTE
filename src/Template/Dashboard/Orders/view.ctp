<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Order</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <h3><?= h($order->id) ?></h3>
    <table class="table table-bordered table-hover dataTable">
        <tr>
            <th scope="row"><?= __('Ip Address') ?></th>
            <td><?= h($order->ip_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($order->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uid') ?></th>
            <td><?= $this->Number->format($order->uid) ?></td>
        </tr>
<!--        <tr>
            <th scope="row"><?= __('Order Item Count') ?></th>
            <td><?= $this->Number->format($order->order_item_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subscription Plan Type') ?></th>
            <td><?= $this->Number->format($order->subscription_plan_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($order->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delivery Status') ?></th>
            <td><?= $this->Number->format($order->delivery_status) ?></td>
        </tr>-->
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($order->created) ?></td>
        </tr>
<!--        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($order->modified) ?></td>
        </tr>-->
    </table>
    <div class="row">
        <h4><?= __('Notes') ?></h4>
        <?= $this->Text->autoParagraph(h($order->notes)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Order Items') ?></h4>
        <?php if (!empty($order->order_items)): ?>
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-hover dataTable">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Order Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($order->order_items as $orderItems): ?>
            <tr>
                <td><?= h($orderItems->id) ?></td>
                <td><?= h($orderItems->order_id) ?></td>
                <td><?= h($orderItems->product_id) ?></td>
                <td><?= h($orderItems->name) ?></td>
                <td><?= h($orderItems->image) ?></td>
                <td><?= h($orderItems->quantity) ?></td>
                <td><?= h($orderItems->created) ?></td>
                <td><?= h($orderItems->modified) ?></td>
                <td class="actions">
            <?php  if($orderItems->cfood_id) {?>
            <?= $this->Html->link(__('Asso View'), ['controller' => 'OrderItems', 'action' => 'associateview', $orderItems->id],array('class'=>'btn btn-primary'))  ?><?php }?>
                    <?= $this->Html->link(__('View'), ['controller' => 'OrderItems', 'action' => 'view', $orderItems->id],array('class'=>'btn btn-primary')) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'OrderItems', 'action' => 'edit', $orderItems->id],array('class'=>'btn btn-success')) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'OrderItems', 'action' => 'delete', $orderItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderItems->id)],array('class'=>'btn btn-danger')) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
 </div>
</div>
</div>
</section>
