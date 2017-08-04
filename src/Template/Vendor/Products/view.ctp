<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Product</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <h3><?= h($product->name) ?></h3>
    <table class="table table-bordered table-hover dataTable">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($product->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><img src="<?php echo $this->request->webroot?>product/<?php echo $product->image; ?>" style="width: 100px;"></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subscription Plan') ?></th>
            <td><?= $product->has('subscription_plan') ? $this->Html->link($product->subscription_plan->name, ['controller' => 'SubscriptionPlans', 'action' => 'view', $product->subscription_plan->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $product->has('user') ? $this->Html->link($product->user->id, ['controller' => 'Users', 'action' => 'view', $product->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Alergy') ?></th>
            <td><?= $product->has('alergy') ? $this->Html->link($product->alergy->name, ['controller' => 'Alergies', 'action' => 'view', $product->alergy->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Day') ?></th>
            <td><?= $product->has('day') ? $this->Html->link($product->day->name, ['controller' => 'Days', 'action' => 'view', $product->day->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $product->has('category') ? $this->Html->link($product->category->name, ['controller' => 'Categories', 'action' => 'view', $product->category->id]) : '' ?></td>
        </tr>
<!--        <tr>
            <th scope="row"><?= __('Subcategory') ?></th>
            <td><?php // $product->has('subcategory') ? $this->Html->link($product->subcategory->name, ['controller' => 'Subcategories', 'action' => 'view', $product->subcategory->id]) : '' ?></td>
        </tr>-->
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($product->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Available Quantity') ?></th>
            <td><?= $this->Number->format($product->available_quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($product->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($product->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Calorie') ?></th>
            <td><?= h($product->calorie) ?></td>
        </tr>
<tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= $this->Text->autoParagraph(h($product->description)); ?></td>
        </tr>
    </table>
   
    <div class="related">
        <h4><?= __('Related Order Items') ?></h4>
        <?php if (!empty($product->order_items)): ?>
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
            <?php foreach ($product->order_items as $orderItems): ?>
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
