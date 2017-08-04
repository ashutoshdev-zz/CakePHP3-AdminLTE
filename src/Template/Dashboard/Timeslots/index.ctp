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
                    <h3 class="box-title">Timeslots</h3>
                </div>
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('timeslot') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($timeslots as $timeslot): ?>
            <tr>
                <td><?= $this->Number->format($timeslot->id) ?></td>
                <td><?= h($timeslot->timeslot) ?></td>
                <td><?= $timeslot->has('category') ? $this->Html->link($timeslot->category->name, ['controller' => 'Categories', 'action' => 'view', $timeslot->category->id]) : '' ?></td>
                <td><?= h($timeslot->created) ?></td>
                <td><?= h($timeslot->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $timeslot->id],array('class'=>'btn btn-primary')) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $timeslot->id],array('class'=>'btn btn-success')) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $timeslot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $timeslot->id),'class'=>'btn btn-danger']) ?>
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