
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">List Promocodes</h3>
            </div>
 
    <?= $this->Form->create($promocode,array('role'=>'form')) ?>
   <div class="box-body">  
       

        <?php
            echo $this->Form->input('pcode',array('class'=>'form-control'));
            echo $this->Form->input('peruser',array('class'=>'form-control'));
            echo $this->Form->input('totalusage',array('class'=>'form-control'));
            echo $this->Form->input('percent',array('class'=>'form-control'));
            echo $this->Form->select('status',['0' => 'DeActivate','1' => 'Activate'],array('class'=>'form-control','label'=>'Status'));
        ?>
     <div class="box-footer">
    <?= $this->Form->button(__('Submit'),array('class'=>'btn btn-success')) ?>
</div>
</div>
    <?= $this->Form->end() ?>

</div></div></div>
</section>