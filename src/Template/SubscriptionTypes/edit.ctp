<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $subscriptionType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $subscriptionType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Subscription Types'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Subscription Plans'), ['controller' => 'SubscriptionPlans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subscription Plan'), ['controller' => 'SubscriptionPlans', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="subscriptionTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($subscriptionType) ?>
    <fieldset>
        <legend><?= __('Edit Subscription Type') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
