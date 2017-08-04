<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Promocode'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="promocodes index large-9 medium-8 columns content">
    <h3><?= __('Promocodes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pcode') ?></th>
                <th scope="col"><?= $this->Paginator->sort('peruser') ?></th>
                <th scope="col"><?= $this->Paginator->sort('totalusage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('percent') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($promocodes as $promocode): ?>
            <tr>
                <td><?= $this->Number->format($promocode->id) ?></td>
                <td><?= h($promocode->pcode) ?></td>
                <td><?= h($promocode->peruser) ?></td>
                <td><?= h($promocode->totalusage) ?></td>
                <td><?= $this->Number->format($promocode->percent) ?></td>
                <td><?= $this->Number->format($promocode->status) ?></td>
                <td><?= h($promocode->created) ?></td>
                <td><?= h($promocode->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $promocode->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $promocode->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $promocode->id], ['confirm' => __('Are you sure you want to delete # {0}?', $promocode->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
