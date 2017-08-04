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
                        <input type="text" name="zip" value="" id="signuppzip" class="form-control input-md" placeholder="Enter your food location"  /> 
                    
                        <br/>
                        <div class="row">
                            <div class="col-xs-6 col-md-6 col-xs-push-4">
                                <button class="btn btn-md btn-primary btn-block signup-btn" type="button" id="usersignup" style="display: none"> Add Address</button>
                            </div>
                        </div>
                    </form>
                </div>

             
            </div>
        </div>
        <script type="text/javascript">
            $('#usersignup').on("click", function () {
                var zip = $('#signuppzip').val();
                $.post('<?php echo $base_url; ?>/users/addressupdate.json', {'zip': zip}, function (d) {
                    console.log(d);
                    if (d.response.isSucess == '0') {
                        $('.alert-danger').html(d.response.msg);
                        $('.alert-danger').show();
                    } else {
                        $('.alert-danger').html(d.response.msg);
                        $('.alert-danger').show();
                        window.setTimeout(function () {
                            window.location.href = '<?php echo $base_url; ?>/users/myaccount';
                        }, 2000);
                    }
                });
            });
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyA1XYGRnhJ1qKJM0Wnngkkq02hUqhIiQI8&sensor=false&libraries=places" type="text/javascript"></script>
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

       zipautofil = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */ (document.getElementById('signuppzip')), options);


   google.maps.places.Autocomplete($location_input.get(0), options);    
    google.maps.event.addListener(zipautofil, 'place_changed', function() {
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
