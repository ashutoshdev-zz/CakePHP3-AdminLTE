<div id="cnfrmation_sec">
    <div class="container">
        <div class="col-md-12 col-lg-12">
            <div class="cnfrmation_sec">

                <div class="alert alert-danger" style="display:none"></div>
                <div class="col-md-6 col-md-offset-3">
                    <form action="r" method="post" accept-charset="utf-8" class="form" role="form">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">            
                                <div class="clearfix"></div>
                            </div><!--col-xs-6 col-md-6-->
                        </div><!--row-->

                        <div class="row voffset5">
                            <div class="col-xs-6 col-md-6 ">
                                <input type="text" name="firstname" value="" id="signupfname" class="form-control input-md" placeholder="First Name"  />
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <input type="text" name="lastname" value=""  id="signuplname" class="form-control input-md" placeholder="Last Name"  />
                            </div>
                        </div>
                        <input type="email" name="email" value="" id="signupuname" class="form-control input-md" placeholder="Email"  />
                        <input type="password" name="password" value="" id="signuppass" class="form-control input-md" placeholder="Password minimum character 8"  />
                        <input type="password" name="cpassword" value="" id="signupcpass" class="form-control input-md" placeholder="Password minimum character 8"  /> 
                        <input type="text" name="phone" value="" id="signupphone" class="form-control input-md" placeholder="Phone"  /> 
                        <input type="text" name="zip" value="" id="signuppzip" class="form-control input-md" placeholder="Enter your food location"  /> 
<!--                     <div class="col-xs-6 col-md-6">
                            <p class="code_btn"><a href="#">Have an invite code?</a></p>
                        </div>-->

                        <div class="row">
                            <center><div class="col-xs-12 col-md-12 col-xs-12">
                                <button class="btn btn-md btn-primary btn-block signup-btn" type="button" id="usersignup"> Sign up</button>
                            </div>
                        </div>
                    </form></center>
                </div>

<!--                <div class="col-md-12">
                    <p class="dnt_sec">By Signing Up By signing up. you agree to the <a href="#"> Privacy Policy & Terms of Service</a></p>
                </div>-->
            </div>
        </div>
        <script type="text/javascript">
            $('#usersignup').on("click", function () {
                var fname = $('#signupfname').val();
                var lname = $('#signuplname').val();
                var uname = $('#signupuname').val();
                var pass = $('#signuppass').val();
                var cpass = $('#signupcpass').val();
                var phone = $('#signupphone').val();
                var zip = $('#signuppzip').val();
                $.post('<?php echo $base_url; ?>/users/signupadd.json', {'email': uname, 'password': pass, 'cpassword': cpass, 'fname': fname, 'lname': lname, 'phone': phone,'zip': zip}, function (d) {
                    console.log(d);
                    if (d.response.isSucess == 'false') {
                        $('.alert-danger').html(d.response.msg);
                        $('.alert-danger').show();
                    } else {
                        $('.alert-danger').html(d.response.msg);
                        $('.alert-danger').show();
                        window.setTimeout(function () {
                            window.location.href = '<?php echo $base_url; ?>/users/cart';
                        }, 2000);
                    }
                });
            });
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script type="text/javascript">
   
     $("#signuppzip").on('focus', function () {
        geolocate();
        
    });
    var placeSearch, autocomplete,zipautofil,signuppzip;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };
    function initialize() {
        $location_input = $("#signuppzip");
        var options = {
            types: ['(cities)'],
            componentRestrictions: {country: "ZA"}
        };
        // Create the autocomplete object, restricting the search
        // to geographical location types.
       
         signuppzip = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */ (document.getElementById('signuppzip')), options);
      


   google.maps.places.Autocomplete($location_input.get(0), options);    
    google.maps.event.addListener(signuppzip, 'place_changed', function() {
        var data = $("#signuppzip").val();
                $.post('<?php echo $base_url; ?>/users/zipcode.json', {'zipcode': data}, function (d) {
                //console.log(d);
                if (d.data.status == 1) {
                    localStorage.setItem('zip', d.data.pincode);
                    $('.alert-danger').html('Vendors are available now');
                    $('#usersignup').show();
                    //localStorage.setItem('venid', d.data.venid);
                } else {
                     $('.alert-danger').show();
                    $('.alert-danger').html("There is no any vendor availabe in your location");
                    $('#usersignup').hide();
                   
                                                   
                }
            });
    });


    }
    
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {

                var geolocation = new google.maps.LatLng(
                        position.coords.latitude, position.coords.longitude);


                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                document.getElementById("latitude").value = latitude;
                document.getElementById("longitude").value = longitude;
                autocomplete.setBounds(new google.maps.LatLngBounds(geolocation, geolocation));
                zipautofil.setBounds(new google.maps.LatLngBounds(geolocation, geolocation));
            });
        }
    }
    initialize();
</script>

<style type="text/css">
    
    .pac-container {
    width: auto !important;
    z-index: 9999999999!important;
}
</style>
