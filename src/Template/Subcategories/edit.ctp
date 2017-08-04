<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $subcategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $subcategory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Subcategories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="subcategories form large-9 medium-8 columns content">
    <?= $this->Form->create($subcategory) ?>
    <fieldset>
        <legend><?= __('Edit Subcategory') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('category_id', ['options' => $categories]);
            echo $this->Form->input('status');
            echo $this->Form->input('is_main');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
