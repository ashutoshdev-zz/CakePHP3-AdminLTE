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
                <div class="box-header">
                    <h3 class="box-title">Users</h3>
                </div>
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Email(username)') ?></th>                                
                                <th scope="col"><?= $this->Paginator->sort('First Name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Last Name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $this->Number->format($user->id) ?></td>
                                    <td><?= h($user->username) ?></td>                                   
                                    <td><?= h($user->fname) ?></td>
                                    <td><?= h($user->lname) ?></td>
                                    <td><?= ($this->Number->format($user->status))==1 ? "Active" : "Deactive"; ?></td>
                                    <td><?= h($user->created) ?></td>
                        
                                    <td class="actions">
                                        
                                        <?= $this->Html->link(__('View'), ['action' => 'view', $user->id],array('class'=>'btn btn-primary')) ?>
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id],array('class'=>'btn btn-success')) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id),'class'=>'btn btn-danger']) ?>
                                 
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