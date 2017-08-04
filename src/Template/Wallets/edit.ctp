<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $wallet->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $wallet->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Wallets'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="wallets form large-9 medium-8 columns content">
    <?= $this->Form->create($wallet) ?>
    <fieldset>
        <legend><?= __('Edit Wallet') ?></legend>
        <?php
            echo $this->Form->input('uid');
            echo $this->Form->input('points');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
