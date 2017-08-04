
<div class="payment_history">

<div class="paymentHistories index large-9 medium-8 columns content">

<div class="container">

    <h3><?= __('Payment Histories') ?></h3>
	<div class="table-responsive">
    <table class="table table-bordered pay_history" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cart_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('uid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('txn_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amt') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th> 
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($paymentHistories as $paymentHistory): ?>
            <tr>
                <td><?= $this->Number->format($paymentHistory->id) ?></td>
                <td><?= $paymentHistory->has('cart') ? $this->Html->link($paymentHistory->cart->name, ['controller' => 'Carts', 'action' => 'view', $paymentHistory->cart->id]) : '' ?></td>
                <td><?= $this->Number->format($paymentHistory->uid) ?></td>
                <td><?= h($paymentHistory->txn_id) ?></td>
                <td><?php echo ($paymentHistory->amt)/100; ?></td>
                <td><?php  if($paymentHistory->status) { echo "Success"; } else { echo "Fail"; } ?></td>
                <td><?= h($paymentHistory->created) ?></td>
                <td><?= h($paymentHistory->modified) ?></td>
                <!--<td class="actions">
                    <?php //$this->Html->link(__('View'), ['action' => 'view', $paymentHistory->id]) ?>
                    <?php //$this->Html->link(__('Edit'), ['action' => 'edit', $paymentHistory->id]) ?>
                    <?php //$this->Form->postLink(__('Delete'), ['action' => 'delete', $paymentHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paymentHistory->id)]) ?>
                </td>-->
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
</div>
</div>
</div>