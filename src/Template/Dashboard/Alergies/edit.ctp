 <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Alergy</h3>
            </div>
    <?= $this->Form->create($alergy) ?>
   <div class="box-body">
        <?php
            echo $this->Form->input('name',array('class'=>'form-control'));
            echo $this->Form->input('about',array('class'=>'form-control'));
        ?>
  <div class="box-footer">
    <?= $this->Form->button(__('Submit'),array('class'=>'btn btn-success')) ?>
</div>
</div>
    <?= $this->Form->end() ?>

</div></div></div>
</section>