<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Subscription Plan'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subscription Types'), ['controller' => 'SubscriptionTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subscription Type'), ['controller' => 'SubscriptionTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="subscriptionPlans index large-9 medium-8 columns content">
    <h3><?= __('Subscription Plans') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('day') ?></th>
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
                <td><?= $subscriptionPlan->has('subscription_type') ? $this->Html->link($subscriptionPlan->subscription_type->name, ['controller' => 'SubscriptionTypes', 'action' => 'view', $subscriptionPlan->subscription_type->id]) : '' ?></td>
                <td><?= $this->Number->format($subscriptionPlan->status) ?></td>
                <td><?= h($subscriptionPlan->created) ?></td>
                <td><?= h($subscriptionPlan->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $subscriptionPlan->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $subscriptionPlan->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $subscriptionPlan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscriptionPlan->id)]) ?>
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
