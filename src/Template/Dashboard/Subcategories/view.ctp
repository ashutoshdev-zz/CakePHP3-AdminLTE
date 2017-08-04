<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Sub category</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <h3><?= h($subcategory->name) ?></h3>
    <table class="table table-bordered table-hover dataTable">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($subcategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $subcategory->has('category') ? $this->Html->link($subcategory->category->name, ['controller' => 'Categories', 'action' => 'view', $subcategory->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($subcategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($subcategory->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Main') ?></th>
            <td><?= $this->Number->format($subcategory->is_main) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($subcategory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($subcategory->modified) ?></td>
        </tr>
    </table>
</div>
 </div>
</div>
</div>
</section>