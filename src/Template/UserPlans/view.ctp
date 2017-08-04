<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User Plan'), ['action' => 'edit', $userPlan->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User Plan'), ['action' => 'delete', $userPlan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userPlan->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User Plans'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Plan'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="userPlans view large-9 medium-8 columns content">
    <h3><?= h($userPlan->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Totalmeal') ?></th>
            <td><?= h($userPlan->totalmeal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userPlan->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subscription Plan Id') ?></th>
            <td><?= $this->Number->format($userPlan->subscription_plan_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Used Meal') ?></th>
            <td><?= $this->Number->format($userPlan->used_meal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uid') ?></th>
            <td><?= $this->Number->format($userPlan->uid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= $this->Number->format($userPlan->is_active) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($userPlan->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expireon') ?></th>
            <td><?= h($userPlan->expireon) ?></td>
        </tr>
    </table>
</div>
