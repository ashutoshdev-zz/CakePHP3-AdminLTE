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
                <div class="box-header">
                    <h3 class="box-title">Promocodes</h3>
                </div>
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('pcode') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('peruser') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('totalusage') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('percent') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
            <?php foreach ($promocodes as $promocode): ?>
                            <tr>
                                <td><?= $this->Number->format($promocode->id) ?></td>
                                <td><?= h($promocode->pcode) ?></td>
                                <td><?= h($promocode->peruser) ?></td>
                                <td><?= h($promocode->totalusage) ?></td>
                                <td><?= $this->Number->format($promocode->percent) ?></td>
                                <td><?= $this->Number->format($promocode->status) ?></td>
                                <td><?= h($promocode->created) ?></td>
                                <td><?= h($promocode->modified) ?></td>
                                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $promocode->id],array('class'=>'btn btn-primary')) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $promocode->id],array('class'=>'btn btn-success')) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $promocode->id], ['confirm' => __('Are you sure you want to delete # {0}?', $promocode->id),'class'=>'btn btn-danger']) ?>
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