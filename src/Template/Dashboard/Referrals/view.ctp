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
              <h3 class="box-title">Referrals </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
     <table class="table table-bordered table-hover dataTable"> 
        <tr>
            <th scope="row"><?= __('Refferby') ?></th>
            <td><?= h($referral->refferby) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Refferto') ?></th>
            <td><?= h($referral->refferto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($referral->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($referral->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($referral->modified) ?></td>
        </tr>
    </table>
</div>
</div>
 </div>
</div>
</section>
