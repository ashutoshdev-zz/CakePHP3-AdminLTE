<section class="content">
      <div class="row">
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Associated Categories</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
   <?= $this->Form->create($assoCategory) ?>
   <div class="box-body">
        <?php
            echo $this->Form->input('name',array('class'=>'form-control'));
        ?>
 <div class="box-footer">
    <?= $this->Form->button(__('Submit'),array('class'=>'btn btn-success')) ?>
</div>
</div>
    <?= $this->Form->end() ?>

</div></div></div>
</section>  