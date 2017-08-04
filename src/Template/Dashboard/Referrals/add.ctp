<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Referrals'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="referrals form large-9 medium-8 columns content">
    <?= $this->Form->create($referral) ?>
    <fieldset>
        <legend><?= __('Add Referral') ?></legend>
        <?php
            echo $this->Form->input('refferby');
            echo $this->Form->input('refferto');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
