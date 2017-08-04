<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Asso Product'), ['action' => 'edit', $assoProduct->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Asso Product'), ['action' => 'delete', $assoProduct->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assoProduct->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Asso Products'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asso Product'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assoProducts view large-9 medium-8 columns content">
    <h3><?= h($assoProduct->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($assoProduct->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($assoProduct->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><img src="<?php echo $this->request->webroot?>assoproduct/<?php echo $assoProduct->image; ?>" style="width: 100px;"></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assoProduct->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Asso Category Id') ?></th>
            <td><?= $this->Number->format($assoProduct->asso_category_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($assoProduct->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($assoProduct->modified) ?></td>
        </tr>
    </table>
</div>
