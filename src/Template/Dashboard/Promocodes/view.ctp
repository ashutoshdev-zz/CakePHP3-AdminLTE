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
              <h3 class="box-title">Promo code</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <table class="table table-bordered table-hover dataTable">
        <tr>
            <th scope="row"><?= __('Pcode') ?></th>
            <td><?= h($promocode->pcode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Peruser') ?></th>
            <td><?= h($promocode->peruser) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Totalusage') ?></th>
            <td><?= h($promocode->totalusage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($promocode->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Percent') ?></th>
            <td><?= $this->Number->format($promocode->percent) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($promocode->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($promocode->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($promocode->modified) ?></td>
        </tr>
    </table>
   
   
</div>
 </div>
</div>
 </div>

</section>

<div class="promocodes view large-9 medium-8 columns content">
    <h3><?= h($promocode->id) ?></h3>
    
</div>
