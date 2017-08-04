<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Staticpage'), ['action' => 'edit', $staticpage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Staticpage'), ['action' => 'delete', $staticpage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $staticpage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Staticpages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Staticpage'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="staticpages view large-9 medium-8 columns content">
    <h3><?= h($staticpage->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $staticpage->has('user') ? $this->Html->link($staticpage->user->id, ['controller' => 'Users', 'action' => 'view', $staticpage->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Position') ?></th>
            <td><?= h($staticpage->position) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($staticpage->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($staticpage->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($staticpage->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($staticpage->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($staticpage->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($staticpage->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($staticpage->description)); ?>
    </div>
</div>
