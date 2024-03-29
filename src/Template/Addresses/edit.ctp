<div id="enterdetls_sec">
<div class="container">
<div class="col-sm-6 col-sm-offset-3">
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>

        <li><?= $this->Html->link(__('List Addresses'), ['action' => 'index']) ?></li>
        
    </ul>
</nav>
</div>
</div>


<div class="container">
<div class="enterdtls_inners">
<div class="col-sm-6 col-sm-offset-3">
<div class="addresses form large-9 medium-8 columns content">
    <?= $this->Form->create($address) ?>
    <fieldset>
        <legend><?= __('Edit Address') ?></legend>
        
      <div class="row">
        
            <div class="col-sm-6"><?php echo $this->Form->input('addresstype',array('label'=>'Address Type')); ?></div>
            <div class="col-sm-6"><?php echo $this->Form->input('first_name'); ?></div>
            <div class="col-sm-6"><?php echo $this->Form->input('last_name'); ?></div>
            <div class="col-sm-6"><?php echo $this->Form->input('email'); ?></div>
            <div class="col-sm-6"><?php echo $this->Form->input('phone'); ?></div>
            <div class="col-sm-12"><?php echo $this->Form->input('address1'); ?></div>
            <div class="col-sm-6"><?php echo $this->Form->input('city'); ?></div>
            <div class="col-sm-6"><?php echo $this->Form->input('state'); ?></div>
            <div class="col-sm-6"><?php echo $this->Form->input('zip'); ?></div>
            <div class="col-sm-6"><?php echo $this->Form->input('country'); ?></div>
    </fieldset>
    <?= $this->Form->button(__('Submit'),['class'=>['action_btn edit_frm']]) ?>
    <?= $this->Form->end() ?>
</div>
</div>
</div>
</div>
</div>