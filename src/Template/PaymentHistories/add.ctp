<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Payment Histories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Carts'), ['controller' => 'Carts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cart'), ['controller' => 'Carts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="paymentHistories form large-9 medium-8 columns content">
    <?= $this->Form->create($paymentHistory) ?>
    <fieldset>
        <legend><?= __('Add Payment History') ?></legend>
        <?php
            echo $this->Form->input('cart_id', ['options' => $carts]);
            echo $this->Form->input('uid');
            echo $this->Form->input('checksum_id');
            echo $this->Form->input('txn_id');
            echo $this->Form->input('amt');
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
