<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Days</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <h3><?= h($day->name) ?></h3>
    <table class="table table-bordered table-hover dataTable">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($day->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($day->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($day->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($day->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Products') ?></h4>
        <?php if (!empty($day->products)): ?>
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-hover dataTable">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
               
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Available Quantity') ?></th>
                <th scope="col"><?= __('Plan Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Alergy Id') ?></th>
                <th scope="col"><?= __('Day Id') ?></th>
                
                <th scope="col"><?= __('Calories') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($day->products as $products): ?>
            <tr>
                <td><?= h($products->id) ?></td>
                <td><?= h($products->name) ?></td>
              
                <td><?= h($products->image) ?></td>
                <td><?= h($products->available_quantity) ?></td>
                <td><?= h($products->subscription_plan_id) ?></td>
                <td><?= h($products->user_id) ?></td>
                <td><?= h($products->alergy_id) ?></td>
                <td><?= h($products->day_id) ?></td>
                <td><?= h($products->calorie) ?></td>
                
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $products->id],array('class'=>'btn btn-primary')) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $products->id],array('class'=>'btn btn-success')) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $products->id], ['confirm' => __('Are you sure you want to delete # {0}?', $products->id),'class'=>'btn btn-danger']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
 </div> </div> </div>
</section>