<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Use Promocodes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="usePromocodes form large-9 medium-8 columns content">
    <?= $this->Form->create($usePromocode) ?>
    <fieldset>
        <legend><?= __('Add Use Promocode') ?></legend>
        <?php
            echo $this->Form->input('promocode');
            echo $this->Form->input('noofuse');
            echo $this->Form->input('uid');
            echo $this->Form->input('total');
            echo $this->Form->input('subtotal');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
