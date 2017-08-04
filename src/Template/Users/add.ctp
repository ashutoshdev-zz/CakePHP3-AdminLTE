<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Staticpages'), ['controller' => 'Staticpages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Staticpage'), ['controller' => 'Staticpages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('password');
            echo $this->Form->input('email');
            echo $this->Form->input('fname');
            echo $this->Form->input('lname');
            echo $this->Form->input('role', [
            'options' => ['admin' => 'Admin','vendor' => 'Vendor','member' => 'Member']
        ]);
            echo $this->Form->input('status');
            
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
