
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">User Registration</h3>
            </div>
 
    <?= $this->Form->create($user,array('role'=>'form')) ?>
   <div class="box-body">              



<?php 
            echo $this->Form->input('username',array('class'=>'form-control')); 
            echo $this->Form->input('password',array('class'=>'form-control'));
            echo $this->Form->input('email',array('class'=>'form-control'));
            echo $this->Form->input('fname',array('class'=>'form-control','label'=>'First Name'));
            echo $this->Form->input('lname',array('class'=>'form-control','label'=>'Last Name'));
            echo $this->Form->input('zip',array('class'=>'form-control','label'=>'Zip Code(for vendor)'));
            echo $this->Form->input('radius',array('class'=>'form-control','label'=>'Delivery Range(In miles)(for vendor)'));
            echo $this->Form->select('role',['admin' => 'Admin','vendor' => 'Vendor','user' => 'User'],array('class'=>'form-control'));
            echo $this->Form->select('email_status',['0' => 'Unverified','1' => 'Verified'],array('class'=>'form-control','label'=>'Email Status'));
            echo $this->Form->select('status',['0' => 'DeActivate','1' => 'Activate'],array('class'=>'form-control','label'=>'Status'));     
        
            ?>
  <div class="box-footer">
    <?= $this->Form->button(__('Submit'),array('class'=>'btn btn-success')) ?>
</div>
</div>
    <?= $this->Form->end() ?>

</div></div></div>
</section>
