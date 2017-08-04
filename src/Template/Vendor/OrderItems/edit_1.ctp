<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Order Item</h3>
            </div>
    <?= $this->Form->create($orderItem) ?>
   <div class="box-body"> 
        <?php
            echo $this->Form->input('order_id', ['options' => $orders, 'empty' => true],array('class'=>'form-control'));
            echo $this->Form->input('product_id', ['options' => $products, 'empty' => true],array('class'=>'form-control'));
            echo $this->Form->input('name',array('class'=>'form-control'));
            echo $this->Form->input('image',array('class'=>'form-control'));
            echo $this->Form->input('quantity',array('class'=>'form-control'));
        ?>
  <div class="box-footer">
    <?= $this->Form->button(__('Submit'),array('class'=>'btn btn-success')) ?>
</div>
</div>
    <?= $this->Form->end() ?>

</div></div></div>
</section> 