<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Subscription Type'), ['action' => 'edit', $subscriptionType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Subscription Type'), ['action' => 'delete', $subscriptionType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscriptionType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Subscription Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subscription Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subscription Plans'), ['controller' => 'SubscriptionPlans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subscription Plan'), ['controller' => 'SubscriptionPlans', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="subscriptionTypes view large-9 medium-8 columns content">
    <h3><?= h($subscriptionType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($subscriptionType->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($subscriptionType->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($subscriptionType->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($subscriptionType->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($subscriptionType->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($subscriptionType->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Subscription Plans') ?></h4>
        <?php if (!empty($subscriptionType->subscription_plans)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Day') ?></th>
                <th scope="col"><?= __('Subscription Type Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($subscriptionType->subscription_plans as $subscriptionPlans): ?>
            <tr>
                <td><?= h($subscriptionPlans->id) ?></td>
                <td><?= h($subscriptionPlans->name) ?></td>
                <td><?= h($subscriptionPlans->description) ?></td>
                <td><?= h($subscriptionPlans->price) ?></td>
                <td><?= h($subscriptionPlans->day) ?></td>
                <td><?= h($subscriptionPlans->subscription_type_id) ?></td>
                <td><?= h($subscriptionPlans->status) ?></td>
                <td><?= h($subscriptionPlans->created) ?></td>
                <td><?= h($subscriptionPlans->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SubscriptionPlans', 'action' => 'view', $subscriptionPlans->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SubscriptionPlans', 'action' => 'edit', $subscriptionPlans->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SubscriptionPlans', 'action' => 'delete', $subscriptionPlans->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscriptionPlans->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
