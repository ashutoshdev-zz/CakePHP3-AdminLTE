<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Subscription Types</li>
    </ol>
</section>
<section class="content">
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Users</h3>
            </div>
            <div class="box-body">
                <table cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subscriptionTypes as $subscriptionType): ?>
                            <tr>
                                <td><?= $this->Number->format($subscriptionType->id) ?></td>
                                <td><?= h($subscriptionType->name) ?></td>
                                <td><?= $this->Number->format($subscriptionType->status) ?></td>
                                <td><?= h($subscriptionType->created) ?></td>
                                <td><?= h($subscriptionType->modified) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['action' => 'view', $subscriptionType->id],array('class'=>'btn btn-primary')) ?>
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $subscriptionType->id],array('class'=>'btn btn-success')) ?>
                                    <?php // $this->Form->postLink(__('Delete'), ['action' => 'delete', $subscriptionType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscriptionType->id),'class'=>'btn btn-danger']) ?>
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
        </div></div></div>
</section>
