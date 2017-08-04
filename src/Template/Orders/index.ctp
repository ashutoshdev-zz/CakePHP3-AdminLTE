<?php 
use Cake\Utility\Security;
$key = 'absbsbsbs123585s55s85s852s202s55s8';
?>
<div class="order-history_sec">
    <div class="container">
        <div class="order-history_inner clearfix">
            <h1>My Order</h1>
            <div class="row">
                 <?= $this->Flash->render() ?><br/>
                <div class="table-responsive">
                    <table class="table table-bordered ordr-h_tbl">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>                             
<!--                                <th scope="col"><?= $this->Paginator->sort('ip_address') ?></th>                                -->
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('delivery_status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Order Schedule') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= $this->Number->format($order->id) ?></td>
<!--                                    <td><?= h($order->ip_address) ?></td>                                     -->
                                    <td><?= h($order->created) ?></td>
                                    <td><?php if($order->delivery_status==0){ 
                                        echo "Pending";
                                        }elseif ($order->delivery_status==1) {
                                echo "Confirm";
                            }else {
                                echo "delivered";
                            }
                            ?></td>
                                     <td><?php if($order->next_order==0){ 
                                        echo "This is a regular week order";
                                        }else {
                                       echo "This is for  the next week Schedule";
                            }
                            ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['action' => 'view', base64_encode($order->id)]) ?>                                       
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
            </div>
        </div>
    </div><!--container-->
</div><!--cart_sec-->
