<div id="address_sec">
  <div class="container">
    <div class="add_details change_details">
      <div class="col-md-12 col-lg-12">
        <h1>Address Details</h1>
         <?php foreach ($addresses as $address): ?>
        <div class="col-lg-6 col-md-6 col-lg-offset-3 voffset2">
          <div class="address_bg">
            <div class="col-md-6 col-md-6">
              <h2> <?= h($address->addresstype) ?> </h2>
            </div>
            <div class="col-md-6 col-md-6">
                <div class="edit_btn"> <span class="btn btn-default btn-md green_btn"> <?= $this->Html->link(__('Edit'), ['action' => 'edit', base64_encode($address->id)]) ?></span> </div>
<!--          <div class="edit_btn"> <span class="btn btn-default btn-md green_btn">  <?php //$this->Form->postLink(__('Delete'), ['action' => 'delete', $address->id], ['confirm' => __('Are you sure you want to delete # {0}?', $address->id)]) ?></span> </div>-->
            </div>
              
            <p> </br>
              First Name:-  <?= h($address->first_name) ?></br>
              Last Name:-  <?= h($address->last_name) ?></br>
               E-mail:-<?= h($address->email) ?></br>
               Address1:-<?= h($address->address1) ?></br>
              
               Phone:- <?= h($address->phone) ?></br>
               City:-<?= h($address->city) ?></br>
                State:-<?= h($address->state) ?></br>
                Zip:-<?= h($address->zip) ?></br>
                Country:-<?= h($address->country) ?></br></p>
          </div>
          <div class="clearfix"></div>
        </div>
        
           <?php endforeach; ?>        
      </div>
      <div class="col-lg-12 col-md-2 voffset3">
        <div class="col-lg-6 col-md-6 col-lg-offset-3"> <span class="btn btn-default btn-md green_btn"><?= $this->Html->link(__('Add New Address'), ['action' => 'add']) ?></span> </div>
      </div>
    </div>
  </div>
  <!--container--> 
</div>
   