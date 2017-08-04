<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $userPlan->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $userPlan->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List User Plans'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="userPlans form large-9 medium-8 columns content">
    <?= $this->Form->create($userPlan) ?>
    <fieldset>
        <legend><?= __('Edit User Plan') ?></legend>
        <?php
            echo $this->Form->input('subscription_plan_id');
            echo $this->Form->input('totalmeal');
            echo $this->Form->input('used_meal');
            echo $this->Form->input('uid');
            echo $this->Form->input('expireon');
            echo $this->Form->input('is_active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
