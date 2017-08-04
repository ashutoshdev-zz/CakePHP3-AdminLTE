<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Order</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <?= $this->Form->create($order) ?>
  <div class="box-body">
        <?php
            echo $this->Form->input('uid',array('class'=>'form-control'));
            echo $this->Form->input('order_item_count',array('class'=>'form-control'));
            echo $this->Form->input('subscription_plan_type',array('class'=>'form-control'));
            echo $this->Form->input('status',array('class'=>'form-control'));
            echo $this->Form->input('ip_address',array('class'=>'form-control'));
            echo $this->Form->input('notes',array('class'=>'form-control'));
            echo $this->Form->input('delivery_status',array('class'=>'form-control'));
        ?>

 <div class="box-footer">
    <?= $this->Form->button(__('Submit'),array('class'=>'btn btn-success')) ?>
</div>
</div>
    <?= $this->Form->end() ?>

</div></div></div>
</section>