<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Asso Category'), ['action' => 'edit', $assoCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Asso Category'), ['action' => 'delete', $assoCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assoCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Asso Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asso Category'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assoCategories view large-9 medium-8 columns content">
    <h3><?= h($assoCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($assoCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assoCategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($assoCategory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($assoCategory->modified) ?></td>
        </tr>
    </table>
</div>
