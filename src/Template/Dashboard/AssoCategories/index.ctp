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
    <h3><?= __('Associated Categories') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assoCategories as $assoCategory): ?>
            <tr>
                <td><?= $this->Number->format($assoCategory->id) ?></td>
                <td><?= h($assoCategory->name) ?></td>
                <td><?= h($assoCategory->created) ?></td>
                <td><?= h($assoCategory->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assoCategory->id],array('class'=>'btn btn-primary')) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assoCategory->id],array('class'=>'btn btn-success')) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assoCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assoCategory->id),'class'=>'btn btn-danger']) ?>
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
