<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Subscription Plan'), ['action' => 'edit', $subscriptionPlan->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Subscription Plan'), ['action' => 'delete', $subscriptionPlan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscriptionPlan->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Subscription Plans'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subscription Plan'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subscription Types'), ['controller' => 'SubscriptionTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subscription Type'), ['controller' => 'SubscriptionTypes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="subscriptionPlans view large-9 medium-8 columns content">
    <h3><?= h($subscriptionPlan->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($subscriptionPlan->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subscription Type') ?></th>
            <td><?= $subscriptionPlan->has('subscription_type') ? $this->Html->link($subscriptionPlan->subscription_type->name, ['controller' => 'SubscriptionTypes', 'action' => 'view', $subscriptionPlan->subscription_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($subscriptionPlan->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($subscriptionPlan->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Day') ?></th>
            <td><?= $this->Number->format($subscriptionPlan->day) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($subscriptionPlan->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($subscriptionPlan->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($subscriptionPlan->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($subscriptionPlan->description)); ?>
    </div>
</div>
