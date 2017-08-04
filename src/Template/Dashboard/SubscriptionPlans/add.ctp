    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Subscription Plan</h3>
            </div>
    <?= $this->Form->create($subscriptionPlan) ?>

        <?php
            echo $this->Form->input('name',array('class'=>'form-control'));
            echo $this->Form->input('description',array('class'=>'form-control'));
            echo $this->Form->input('price',array('class'=>'form-control'));
            echo $this->Form->input('day',array('class'=>'form-control'));
            echo $this->Form->input('meals',array('class'=>'form-control'));
            echo $this->Form->input('subscription_type_id', ['options' => $subscriptionTypes,'class'=>'form-control']);
            echo $this->Form->input('status',array('class'=>'form-control'));
        ?>
   <div class="box-footer">
    <?= $this->Form->button(__('Submit'),array('class'=>'btn btn-success')) ?>
</div>
</div>
    <?= $this->Form->end() ?>

</div></div></div>
</section>