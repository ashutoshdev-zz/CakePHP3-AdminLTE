<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Category</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <h3><?= h($category->name) ?></h3>
    <table class="table table-bordered table-hover dataTable">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($category->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($category->id) ?></td>
        </tr>
<!--        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($category->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Main') ?></th>
            <td><?= $this->Number->format($category->is_main) ?></td>
        </tr>-->
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($category->created) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($category->modified) ?></td>
        </tr>
    </table>

 </div>
</div>
</div>
</section>