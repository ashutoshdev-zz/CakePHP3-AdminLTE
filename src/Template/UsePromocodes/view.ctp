<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Use Promocode'), ['action' => 'edit', $usePromocode->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Use Promocode'), ['action' => 'delete', $usePromocode->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usePromocode->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Use Promocodes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Use Promocode'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usePromocodes view large-9 medium-8 columns content">
    <h3><?= h($usePromocode->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Promocode') ?></th>
            <td><?= h($usePromocode->promocode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total') ?></th>
            <td><?= h($usePromocode->total) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subtotal') ?></th>
            <td><?= h($usePromocode->subtotal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($usePromocode->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Noofuse') ?></th>
            <td><?= $this->Number->format($usePromocode->noofuse) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uid') ?></th>
            <td><?= $this->Number->format($usePromocode->uid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($usePromocode->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($usePromocode->modified) ?></td>
        </tr>
    </table>
</div>
