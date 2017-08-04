<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $assoCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $assoCategory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Asso Categories'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="assoCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($assoCategory) ?>
    <fieldset>
        <legend><?= __('Edit Asso Category') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
