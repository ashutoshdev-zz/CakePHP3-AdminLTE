<section class="content">
      <div class="row">
        <div class="col-xs-8">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Associated Product</h3>
            </div>
            <div class="box-body">
    <?= $this->Form->create($assoProduct,['type' => 'file']) ?>
       <div class="box-body">
        <?php
            echo $this->Form->input('name',array('class'=>'form-control'));
            echo $this->Form->input('description',array('class'=>'form-control')); ?>
            <img src="<?php echo $this->request->webroot?>assoproduct/<?php echo $assoProduct->image; ?>" style="width: 100px;">
       <input type="file" name="image" class='form-control'/><br/>
          <?php //  echo $this->Form->input('image',array('class'=>'form-control'));
            echo $this->Form->input('asso_category_id',array('class'=>'form-control'));
        ?>
  <div class="box-footer">
    <?= $this->Form->button(__('Submit'),array('class'=>'btn btn-success')) ?>
</div>
</div>
    <?= $this->Form->end() ?>

</div></div></div>
</section>