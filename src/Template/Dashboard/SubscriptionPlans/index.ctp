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
                    <h3 class="box-title">Subscription Plans</h3>
                </div>
<div class="subscriptionPlans index large-9 medium-8 columns content">
    <h3><?= __('Subscription Plans') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('day') ?></th>
                <th scope="col"><?= $this->Paginator->sort('meals') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subscription_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subscriptionPlans as $subscriptionPlan): ?>
            <tr>
                <td><?= $this->Number->format($subscriptionPlan->id) ?></td>
                <td><?= h($subscriptionPlan->name) ?></td>
                <td><?= $this->Number->format($subscriptionPlan->price) ?></td>
                <td><?= $this->Number->format($subscriptionPlan->day) ?></td>
                <td><?= $this->Number->format($subscriptionPlan->meals) ?></td>
                <td><?= $subscriptionPlan->has('subscription_type') ? $this->Html->link($subscriptionPlan->subscription_type->name, ['controller' => 'SubscriptionTypes', 'action' => 'view', $subscriptionPlan->subscription_type->id]) : '' ?></td>
                <td><?= $this->Number->format($subscriptionPlan->status) ?></td>
                <td><?= h($subscriptionPlan->created) ?></td>
                <td><?= h($subscriptionPlan->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $subscriptionPlan->id],array('class'=>'btn btn-primary')) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $subscriptionPlan->id],array('class'=>'btn btn-success')) ?>
                    <?php //$this->Form->postLink(__('Delete'), ['action' => 'delete', $subscriptionPlan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscriptionPlan->id),'class'=>'btn btn-danger']) ?>
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
</div>
</div>
</div></div>
</section>