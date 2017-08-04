<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Wallet'), ['action' => 'edit', $wallet->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Wallet'), ['action' => 'delete', $wallet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wallet->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Wallets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Wallet'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="wallets view large-9 medium-8 columns content">
    <h3><?= h($wallet->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Points') ?></th>
            <td><?= h($wallet->points) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($wallet->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uid') ?></th>
            <td><?= $this->Number->format($wallet->uid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($wallet->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($wallet->modified) ?></td>
        </tr>
    </table>
</div>
