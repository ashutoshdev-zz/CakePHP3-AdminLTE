<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $promocode->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $promocode->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Promocodes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="promocodes form large-9 medium-8 columns content">
    <?= $this->Form->create($promocode) ?>
    <fieldset>
        <legend><?= __('Edit Promocode') ?></legend>
        <?php
            echo $this->Form->input('pcode');
            echo $this->Form->input('peruser');
            echo $this->Form->input('totalusage');
            echo $this->Form->input('percent');
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
