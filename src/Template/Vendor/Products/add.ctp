 <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Product</h3>
            </div>
    <?= $this->Form->create($product,['type' => 'file']) ?>
    <div class="box-body"> 
        <?php
            echo $this->Form->input('name',array('class'=>'form-control'));
            echo $this->Form->input('description',array('class'=>'form-control')); ?>
        <input type="file" name="image" class='form-control' required=""/><br/>
         <?php   // echo $this->Form->input('image',array('class'=>'form-control'));
            echo $this->Form->input('available_quantity',array('class'=>'form-control'));
            echo $this->Form->input('subscription_plan_id', ['options' => $subscriptionPlans,'class'=>'form-control']);
            echo $this->Form->input('user_id', ['options' => $users,'class'=>'form-control','label'=>'Vendor name']);
            echo $this->Form->input('alergy_id[]', ['options' => $alergies,'class'=>'form-control','multiple','label'=>'Add Alergy']);
             echo $this->Form->input('assopro_id[]', ['options' => $assoproducts,'class'=>'form-control','multiple','label'=>'Associate Product']);
            echo $this->Form->input('day_id', ['options' => $days,'class'=>'form-control']);
            echo $this->Form->input('category_id', ['options' => $categories,'class'=>'form-control']);
            //echo $this->Form->input('subcategory_id', ['options' => $subcategories,'class'=>'form-control']);
            echo $this->Form->input('calorie',array('class'=>'form-control'));
        ?>
  <div class="box-footer">
    <?= $this->Form->button(__('Submit'),array('class'=>'btn btn-success')) ?>
</div>
</div>
    <?= $this->Form->end() ?>

</div></div></div>
</section>