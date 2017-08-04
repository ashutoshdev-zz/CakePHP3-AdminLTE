    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">User Registration</h3>
            </div>
 
    <?= $this->Form->create($user,array('role'=>'form')) ?>
     <div class="box-body">  
        <?php
            echo $this->Form->input('username',array('class'=>'form-control'));
            echo $this->Form->input('email',array('class'=>'form-control'));
            echo $this->Form->input('fname',array('class'=>'form-control','label'=>'First Name'));
            echo $this->Form->input('lname',array('class'=>'form-control','label'=>'Last Name'));
            echo $this->Form->input('zip',array('class'=>'form-control','label'=>'Address(for vendor)','id'=>'searchTextField'));
            echo $this->Form->input('radius',array('class'=>'form-control','label'=>'Delivery Range(In miles)(for vendor)'));
            echo $this->Form->select('role',['admin' => 'Admin','vendor' => 'Vendor','user' => 'User'],array('class'=>'form-control'));
           echo $this->Form->select('email_status',['0' => 'Unverified','1' => 'Verified'],array('class'=>'form-control','label'=>'Email Status'));
            echo $this->Form->select('status',['0' => 'DeActivate','1' => 'Activate'],array('class'=>'form-control','label'=>'Status'));     
        ?>
    <div class="box-footer">
    <?= $this->Form->button(__('Submit'),array('class'=>'btn btn-success')) ?>
</div>
</div>
    <?= $this->Form->end() ?>

</div></div>
</section>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyA1XYGRnhJ1qKJM0Wnngkkq02hUqhIiQI8&sensor=false&libraries=places" type="text/javascript"></script>
<script type="text/javascript">
  function initialize() {

 var options = {
  types: ['geocode'],
  componentRestrictions: {country: "ZA"}
 };

 var input = document.getElementById('searchTextField');
 var autocomplete = new google.maps.places.Autocomplete(input, options);
}
   google.maps.event.addDomListener(window, 'load', initialize);
</script>