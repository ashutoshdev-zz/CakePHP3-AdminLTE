<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Payment History'), ['action' => 'edit', $paymentHistory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Payment History'), ['action' => 'delete', $paymentHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paymentHistory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Payment Histories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Payment History'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Carts'), ['controller' => 'Carts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cart'), ['controller' => 'Carts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="paymentHistories view large-9 medium-8 columns content">
    <h3><?= h($paymentHistory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Cart') ?></th>
            <td><?= $paymentHistory->has('cart') ? $this->Html->link($paymentHistory->cart->name, ['controller' => 'Carts', 'action' => 'view', $paymentHistory->cart->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Txn Id') ?></th>
            <td><?= h($paymentHistory->txn_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amt') ?></th>
            <td><?= h($paymentHistory->amt) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($paymentHistory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uid') ?></th>
            <td><?= $this->Number->format($paymentHistory->uid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($paymentHistory->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($paymentHistory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($paymentHistory->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Checksum Id') ?></h4>
        <?= $this->Text->autoParagraph(h($paymentHistory->checksum_id)); ?>
    </div>
</div>
