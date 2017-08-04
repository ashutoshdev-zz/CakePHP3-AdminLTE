<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Asso Products'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="assoProducts form large-9 medium-8 columns content">
    <?= $this->Form->create($assoProduct) ?>
    <fieldset>
        <legend><?= __('Add Asso Product') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('image');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
