<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Timeslot'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="timeslots index large-9 medium-8 columns content">
    <h3><?= __('Timeslots') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('timeslot') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($timeslots as $timeslot): ?>
            <tr>
                <td><?= $this->Number->format($timeslot->id) ?></td>
                <td><?= h($timeslot->timeslot) ?></td>
                <td><?= $timeslot->has('category') ? $this->Html->link($timeslot->category->name, ['controller' => 'Categories', 'action' => 'view', $timeslot->category->id]) : '' ?></td>
                <td><?= h($timeslot->created) ?></td>
                <td><?= h($timeslot->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $timeslot->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $timeslot->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $timeslot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $timeslot->id)]) ?>
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
