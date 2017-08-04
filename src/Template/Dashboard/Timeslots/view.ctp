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
              <h3 class="box-title">Timeslots</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
     <table class="table table-bordered table-hover dataTable">           
        <tr>
            <th scope="row"><?= __('Timeslot') ?></th>
            <td><?= h($timeslot->timeslot) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $timeslot->has('category') ? $this->Html->link($timeslot->category->name, ['controller' => 'Categories', 'action' => 'view', $timeslot->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($timeslot->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($timeslot->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($timeslot->modified) ?></td>
        </tr>
    </table>
</div>
</div>
 </div>
</div>
</section>