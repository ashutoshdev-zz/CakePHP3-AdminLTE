<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Staticpage'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="staticpages index large-9 medium-8 columns content">
    <h3><?= __('Staticpages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('position') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($staticpages as $staticpage): ?>
            <tr>
                <td><?= $this->Number->format($staticpage->id) ?></td>
                <td><?= $staticpage->has('user') ? $this->Html->link($staticpage->user->id, ['controller' => 'Users', 'action' => 'view', $staticpage->user->id]) : '' ?></td>
                <td><?= h($staticpage->position) ?></td>
                <td><?= h($staticpage->title) ?></td>
                <td><?= h($staticpage->image) ?></td>
                <td><?= $this->Number->format($staticpage->status) ?></td>
                <td><?= h($staticpage->created) ?></td>
                <td><?= h($staticpage->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $staticpage->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $staticpage->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $staticpage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $staticpage->id)]) ?>
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
