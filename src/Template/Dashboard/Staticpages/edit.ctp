<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Static Pages</h3>
            </div>
    <?= $this->Form->create($staticpage) ?>
   <div class="box-body">
        <?php
            //echo $this->Form->input('user_id', ['options' => $users,'class'=>'form-control']);
            echo $this->Form->input('position',array('class'=>'form-control'));
            echo $this->Form->input('title',array('class'=>'form-control'));
            echo $this->Form->input('image',array('class'=>'form-control'));
            echo $this->Form->input('description',array('class'=>'form-control'));
           // echo $this->Form->input('status',array('class'=>'form-control'));
        ?>
 
<div class="box-footer">
    <?= $this->Form->button(__('Submit'),array('class'=>'btn btn-success')) ?>
</div>
</div>
    <?= $this->Form->end() ?>

</div></div></div>
</section>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>