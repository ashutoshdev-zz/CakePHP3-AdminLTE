<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Promocode'), ['action' => 'edit', $promocode->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Promocode'), ['action' => 'delete', $promocode->id], ['confirm' => __('Are you sure you want to delete # {0}?', $promocode->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Promocodes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Promocode'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="promocodes view large-9 medium-8 columns content">
    <h3><?= h($promocode->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Pcode') ?></th>
            <td><?= h($promocode->pcode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Peruser') ?></th>
            <td><?= h($promocode->peruser) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Totalusage') ?></th>
            <td><?= h($promocode->totalusage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($promocode->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Percent') ?></th>
            <td><?= $this->Number->format($promocode->percent) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($promocode->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($promocode->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($promocode->modified) ?></td>
        </tr>
    </table>
</div>
