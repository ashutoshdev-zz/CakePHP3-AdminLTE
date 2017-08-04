<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Associated Categories</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <h3><?= h($assoCategory->name) ?></h3>
    <table class="table table-bordered table-hover dataTable">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($assoCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assoCategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($assoCategory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($assoCategory->modified) ?></td>
        </tr>
    </table>

 </div>
 </div>
</div>
</div>
</section>