<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Order Item</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <h3><?= h($orderItem->name) ?></h3>
    <table class="table table-bordered table-hover dataTable">
        <tr>
            <th scope="row"><?= __('Order') ?></th>
            <td><?= $orderItem->has('order') ? $this->Html->link($orderItem->order->id, ['controller' => 'Orders', 'action' => 'view', $orderItem->order->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product') ?></th>
            <td><?= $orderItem->has('product') ? $this->Html->link($orderItem->product->name, ['controller' => 'Products', 'action' => 'view', $orderItem->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($orderItem->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($orderItem->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($orderItem->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($orderItem->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($orderItem->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($orderItem->modified) ?></td>
        </tr>
    </table>
</div> </div> </div>
</section>
