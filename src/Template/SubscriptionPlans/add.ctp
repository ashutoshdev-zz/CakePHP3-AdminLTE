<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Subscription Plans'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Subscription Types'), ['controller' => 'SubscriptionTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subscription Type'), ['controller' => 'SubscriptionTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="subscriptionPlans form large-9 medium-8 columns content">
    <?= $this->Form->create($subscriptionPlan) ?>
    <fieldset>
        <legend><?= __('Add Subscription Plan') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('price');
            echo $this->Form->input('day');
            echo $this->Form->input('meals');
            echo $this->Form->input('subscription_type_id', ['options' => $subscriptionTypes]);
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
