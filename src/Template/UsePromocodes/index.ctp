<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Use Promocode'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usePromocodes index large-9 medium-8 columns content">
    <h3><?= __('Use Promocodes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('promocode') ?></th>
                <th scope="col"><?= $this->Paginator->sort('noofuse') ?></th>
                <th scope="col"><?= $this->Paginator->sort('uid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subtotal') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usePromocodes as $usePromocode): ?>
            <tr>
                <td><?= $this->Number->format($usePromocode->id) ?></td>
                <td><?= h($usePromocode->promocode) ?></td>
                <td><?= $this->Number->format($usePromocode->noofuse) ?></td>
                <td><?= $this->Number->format($usePromocode->uid) ?></td>
                <td><?= h($usePromocode->total) ?></td>
                <td><?= h($usePromocode->subtotal) ?></td>
                <td><?= h($usePromocode->created) ?></td>
                <td><?= h($usePromocode->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $usePromocode->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usePromocode->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usePromocode->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usePromocode->id)]) ?>
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
