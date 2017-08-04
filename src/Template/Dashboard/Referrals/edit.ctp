    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Referral</h3>
            </div>
 
    <?= $this->Form->create($referral,array('role'=>'form')) ?>
   <div class="box-body">

        <?php
            echo $this->Form->input('refferby',array('class'=>'form-control'));
            echo $this->Form->input('refferto',array('class'=>'form-control'));
        ?>
    <div class="box-footer">
    <?= $this->Form->button(__('Submit'),array('class'=>'btn btn-success')) ?>
</div>
</div>
    <?= $this->Form->end() ?>

</div></div></div>
</section> 
