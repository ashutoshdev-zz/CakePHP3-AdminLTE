<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Asso Categories'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="assoCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($assoCategory) ?>
    <fieldset>
        <legend><?= __('Add Asso Category') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
