<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cart'), ['action' => 'edit', $cart->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cart'), ['action' => 'delete', $cart->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cart->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Carts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cart'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subscription Plans'), ['controller' => 'SubscriptionPlans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subscription Plan'), ['controller' => 'SubscriptionPlans', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="carts view large-9 medium-8 columns content">
    <h3><?= h($cart->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($cart->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subscription Plan') ?></th>
            <td><?= $cart->has('subscription_plan') ? $this->Html->link($cart->subscription_plan->name, ['controller' => 'SubscriptionPlans', 'action' => 'view', $cart->subscription_plan->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cart->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uid') ?></th>
            <td><?= $this->Number->format($cart->uid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($cart->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subtotal') ?></th>
            <td><?= $this->Number->format($cart->subtotal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($cart->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($cart->modified) ?></td>
        </tr>
    </table>
</div>
