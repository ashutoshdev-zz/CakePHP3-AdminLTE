<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                
<div class="orders index large-9 medium-8 columns content">
    <h3><?= __('Associated Products') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('asso_category_id') ?></th>
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
                <td><?= $this->Number->format($assoProduct->asso_category_id) ?></td>
                <td><?= h($assoProduct->created) ?></td>
                <td><?= h($assoProduct->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assoProduct->id],array('class'=>'btn btn-primary')) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assoProduct->id],array('class'=>'btn btn-success')) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assoProduct->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assoProduct->id),'class'=>'btn btn-danger']) ?>
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
</div>    </div>
</div>    </div>
</section>
