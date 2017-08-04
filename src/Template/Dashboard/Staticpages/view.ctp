
    <h3><?= h($staticpage->title) ?></h3>
    <table class="table table-bordered table-hover dataTable">
<!--        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $staticpage->has('user') ? $this->Html->link($staticpage->user->id, ['controller' => 'Users', 'action' => 'view', $staticpage->user->id]) : '' ?></td>
        </tr>-->
        <tr>
            <th scope="row"><?= __('Position') ?></th>
            <td><?= h($staticpage->position) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($staticpage->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($staticpage->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($staticpage->id) ?></td>
        </tr>
<!--        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($staticpage->status) ?></td>
        </tr>-->
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($staticpage->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($staticpage->modified) ?></td>
        </tr>
 <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= $this->Text->autoParagraph(h($staticpage->description)); ?></td>
        </tr>
    </table>
   
 </div>
</div>
</div>
</section>
