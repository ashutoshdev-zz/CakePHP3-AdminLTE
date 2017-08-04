<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Products</h3>
                </div>
<div class="products index large-9 medium-8 columns content">
    <h3><?= __('Products') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('available_quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subscription_plan_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id',array('label'=>'Vendor')) ?></th>                
                <th scope="col"><?= $this->Paginator->sort('day_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
<!--                <th scope="col"><?= $this->Paginator->sort('subcategory_id') ?></th>-->
                <th scope="col"><?= $this->Paginator->sort('calories') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $this->Number->format($product->id) ?></td>
                <td><?= h($product->name) ?></td>
                <td><img src="<?php echo $this->request->webroot ?>product/<?php echo $product->image; ?>" height="30px"></td>
                <td><?= $this->Number->format($product->available_quantity) ?></td>
                <td><?= $product->has('subscription_plan') ? $this->Html->link($product->subscription_plan->name, ['controller' => 'SubscriptionPlans', 'action' => 'view', $product->subscription_plan->id]) : '' ?></td>
                <td><?= $product->has('user') ? $this->Html->link($product->user->fname, ['controller' => 'Users', 'action' => 'view', $product->user->id]) : '' ?></td>
               
                <td><?= $product->has('day') ? $this->Html->link($product->day->name, ['controller' => 'Days', 'action' => 'view', $product->day->id]) : '' ?></td>
                <td><?= $product->has('category') ? $this->Html->link($product->category->name, ['controller' => 'Categories', 'action' => 'view', $product->category->id]) : '' ?></td>
<!--                <td><?= $product->has('subcategory') ? $this->Html->link($product->subcategory->name, ['controller' => 'Subcategories', 'action' => 'view', $product->subcategory->id]) : '' ?></td>-->
                <td><?= h($product->calorie) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $product->id],array('class'=>'btn btn-primary')) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id],array('class'=>'btn btn-success')) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id),'class'=>'btn btn-danger']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div> </div>
</div> </div>
</section>
