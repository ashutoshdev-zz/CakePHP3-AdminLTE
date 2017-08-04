<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Wallet'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="wallets index large-9 medium-8 columns content">
    <h3><?= __('Wallets') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('uid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('points') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($wallets as $wallet): ?>
            <tr>
                <td><?= $this->Number->format($wallet->id) ?></td>
                <td><?= $this->Number->format($wallet->uid) ?></td>
                <td><?= h($wallet->points) ?></td>
                <td><?= h($wallet->created) ?></td>
                <td><?= h($wallet->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $wallet->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $wallet->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $wallet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wallet->id)]) ?>
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
