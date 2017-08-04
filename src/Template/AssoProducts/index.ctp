<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Asso Product'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assoProducts index large-9 medium-8 columns content">
    <h3><?= __('Asso Products') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assoProducts as $assoProduct): ?>
            <tr>
                <td><?= $this->Number->format($assoProduct->id) ?></td>
                <td><?= h($assoProduct->name) ?></td>
                <td><?= h($assoProduct->description) ?></td>
                <td><?= h($assoProduct->image) ?></td>
                <td><?= h($assoProduct->created) ?></td>
                <td><?= h($assoProduct->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assoProduct->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assoProduct->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assoProduct->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assoProduct->id)]) ?>
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
