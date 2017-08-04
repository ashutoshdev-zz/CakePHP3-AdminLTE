<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Subscription Type'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subscription Plans'), ['controller' => 'SubscriptionPlans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subscription Plan'), ['controller' => 'SubscriptionPlans', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="subscriptionTypes index large-9 medium-8 columns content">
    <h3><?= __('Subscription Types') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subscriptionTypes as $subscriptionType): ?>
            <tr>
                <td><?= $this->Number->format($subscriptionType->id) ?></td>
                <td><?= h($subscriptionType->name) ?></td>
                <td><?= $this->Number->format($subscriptionType->status) ?></td>
                <td><?= h($subscriptionType->created) ?></td>
                <td><?= h($subscriptionType->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $subscriptionType->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $subscriptionType->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $subscriptionType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscriptionType->id)]) ?>
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
