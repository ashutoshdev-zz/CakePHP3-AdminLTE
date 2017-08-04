<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User Plan'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="userPlans index large-9 medium-8 columns content">
    <h3><?= __('User Plans') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subscription_plan_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('totalmeal') ?></th>
                <th scope="col"><?= $this->Paginator->sort('used_meal') ?></th>
                <th scope="col"><?= $this->Paginator->sort('uid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expireon') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_active') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userPlans as $userPlan): ?>
            <tr>
                <td><?= $this->Number->format($userPlan->id) ?></td>
                <td><?= $this->Number->format($userPlan->subscription_plan_id) ?></td>
                <td><?= h($userPlan->totalmeal) ?></td>
                <td><?= $this->Number->format($userPlan->used_meal) ?></td>
                <td><?= $this->Number->format($userPlan->uid) ?></td>
                <td><?= h($userPlan->created) ?></td>
                <td><?= h($userPlan->expireon) ?></td>
                <td><?= $this->Number->format($userPlan->is_active) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $userPlan->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userPlan->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userPlan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userPlan->id)]) ?>
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
