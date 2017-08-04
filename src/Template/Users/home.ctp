<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({cache: true});
        $.getScript('//connect.facebook.net/en_US/sdk.js', function () {
            FB.init({
                appId: '1910287989203056',
                version: 'v2.7' // or v2.1, v2.2, v2.3, ...
            });
            $('#loginbutton,#feedbutton').removeAttr('disabled');

        });

       var zcode = localStorage.getItem('zip');
        $('#zipautofil').val(zcode);
        $('#zppop').html(zcode);
        var venid = localStorage.getItem('venid');
        $.post('<?php echo $base_url; ?>/users/zipsession.json', {'vid': venid}, function (d) {
            //alert(d.response.d);
           if(d.response.d==null){
            location.reload();
        }
        });
    });
    function statusChangeCallback(response) {
        console.log(response);
        //location.reload();
        if (response.status === 'connected') {
            testAPI();
        }
    }
    function testAPI() {
        FB.api('/me?fields=id,email,name', function (response) {
            var fname = response.name;
            var id = response.id;
            var uname = response.email;
            $.post('<?php echo $base_url; ?>/users/fblogin.json', {'email': uname, 'name': fname, 'fb_id': id}, function (d) {
                location.reload();
            });

        });
    }
    function myFacebookLogin() {
        FB.login(function () {
            FB.getLoginStatus(function (response) {
                FB.getLoginStatus(function (response) {
                    statusChangeCallback(response);
                });
            });
        }, {scope: 'publish_actions'});
    }


<!------------window open popup get started ---------------->
    var zip = localStorage.getItem('zip');
    $('#zipautofil').val(zip);
    $(window).load(function () {
        if (zip) {

        } else
        {
            $('#onload').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });

        }
    });


</script>




<!-------------------Popup on page load----------------------->

<div class="modal fade bs-example-modal-lg zindex_new" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true"  id="onload">

    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body clearfix">
                <div class="started">
                    <h1 class="modal-title">Get Started</h1>
                    <p>Enjoy fresh chef-crafted meals and cooking kits </br>delivered to your door.</p>
                    <h5 id="ziperror">Enter your Address:</h5>
                    <div class="outer_started">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input name="zipcodeval" value="" type="text" id="autocomplete" placeholder="Select Address">
                            <input name="" type="submit" value="Submit" id="zipcode">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-------------------Popup on page load----------------------->

<div id="menu_sec">
    <div class="container">
        <div class="row">
            <div class="main_menu">
                <div class="col-xs-12 col-sm-3">
                    <div class="zip_code"> 
                        <i><img src="<?php echo $this->request->webroot ?>frontend/images/marker.png" alt="" ></i>
                        <input type="text" id="zipautofil" value="" />
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="prem_menu">                          
                        <select class="selectpicker" id="pselect">
                            <?php foreach ($allplans as $plan) {
                                if ($plan['id'] == $srchplan) {
                                    ?>
                                    <option value="<?php echo $plan['id']; ?>" selected><?php echo $plan['name']; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $plan['id']; ?>"><?php echo $plan['name']; ?></option>
    <?php }
} ?>
                        </select>

                    </div>
                </div>
                <div class="col-xs-12 col-sm-3">


                    <!--            <div class="prem_menu2">  
                                 <img src="<?php echo $this->request->webroot ?>frontend/images/filter_icn.png" alt="" >         
                           <select class="selectpicker">
                              <optgroup label="Allergens">
                                <option>Allergens</option>
                                <option>Classic</option>
                                <option>Private</option>
                              </optgroup> 
                            </select> 
                            </div>-->

                </div>
            </div>
            <!--myaccnt--> 
        </div>
        <!--col-lg-12 col-md-12--> 
    </div>
    <!--container--> 

</div>
<!--menu_sec-->
<div id="banner_sec">
    <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1300px; height: 352px; overflow: hidden; visibility: hidden;"> 
        <!-- Loading Screen -->
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('<?php echo $this->request->webroot ?>img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1300px; height: 352px; overflow: hidden;">
            <div data-p="225.00"> <img data-u="image" src="<?php echo $this->request->webroot ?>frontend/images/banner2.jpg" />
<!--                <div style="position:absolute;top:80px;left:130px;width:480px;height:120px;z-index:0;font-size:80px;color:#ffffff;line-height:60px;">Eat Clean</div>
                <div style="position:absolute;top:180px;left:200px;width:480px;height:120px;z-index:0;font-size:70px;color:#ffffff;line-height:38px;">Be Happy</div>-->
            </div>
            <div data-p="225.00" style="display: none;"> <img data-u="image" src="<?php echo $this->request->webroot ?>frontend/images/banner1.jpg" /> </div>
            <div data-p="225.00" data-po="80% 55%" style="display: none;"> <img data-u="image" src="<?php echo $this->request->webroot ?>frontend/images/banner1.jpg" /> </div>
             <div data-p="225.00" data-po="80% 55%" style="display: none;"> <img data-u="image" src="<?php echo $this->request->webroot ?>frontend/images/banner3.jpg" /> </div>


            <!-- Bullet Navigator -->
            <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1"> 
                <!-- bullet navigator item prototype -->
                <div data-u="prototype" style="width:16px;height:16px;"></div>
            </div>
            <!-- Arrow Navigator --> 
            <span data-u="arrowleft" class="jssora22l" style="top:0px;left:8px;width:40px;height:58px;" data-autocenter="2"></span> <span data-u="arrowright" class="jssora22r" style="top:0px;right:8px;width:40px;height:58px;" data-autocenter="2"></span> </div>
    </div>
</div>
<!--banner_sec-->



 <?php 
 foreach ($days as $d) {      ?>
                            <div class="table_sec">
                            
                            <div class="globel_headding">
                            <div class="container">
                                <div class="table_head">
                                    <h1><?php echo $d['name']; ?></h1>
                                    <b></b>
                                </div>
                            </div>
                            </div>
                            
                            <div class="product_carousel">
                                <div class="container">
                                   
                                        
                                        <?php if ($srchplan == 1) { ?>
                                            <div class="col-sm-12">
                                                <div class="table_subhead">
                                                    <h1>Dinner</h1>
                                                    <b></b>
                                                </div>
                                                <section class="regular slider">
                                                    <?php foreach ($d['products'] as $product) { ?> 
                                                        <div class="table_item">
                                                            <img src="<?php echo $this->request->webroot ?>product/<?php echo $product['image']; ?>" alt="Image" style="height:200px;">
                                                            <div class="thumb_chk">
                                                                  <span class="label label-success" id="alergy-<?php echo $product['id']; ?>">Check Allergens</span> 
                                                                    <input type="checkbox" style="display:none" name="alergy-dinner-<?php echo $d['name']; ?>" value="" id="alergyinput-<?php echo $product['id']; ?>"/>
                                                                    <div class="radio_outer">
                                                               
                                                                </div>
                                                            </div>
                                                            <div class="thumb_sec">
                                                                <div class="thumb-left"><?php echo $product['name']; ?></div>
                                                                <div class="thumb-right"><?php echo $product['calorie']; ?> Calories</div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </section>
                                            </div>
                                        <?php } ?>
                                        <?php if ($srchplan == 2 || $srchplan == 3) { ?>
                                            <div class="col-sm-12">
                                                <div class="table_subhead">
                                                    <h1>Lunch</h1>
                                                    <b></b>
                                                </div>


                                                <section class="regular slider">
                                                    <?php
                                                    foreach ($d['products'] as $product) {
                                                        if ($product['category_id'] == 8) {
                                                            ?> 
                                                            <div class="table_item">
                                                                <img src="<?php echo $this->request->webroot ?>product/<?php echo $product['image']; ?>" alt="Image" style="height:200px;">
                                                                <div class="thumb_chk">
                                                                     
                                                                    <input style="display:none" type="checkbox" name="alergy-lunch-<?php echo $d['name']; ?>" value="" id="alergyinput-<?php echo $product['id']; ?>"/>
                                                                    <div class="radio_outer">
                                                                    
                                                                    </div>
                                                                    <span class="label label-success" id="alergy-<?php echo $product['id']; ?>">Check Allergens</span> 
                                                                    <?php if ($srchplan == 3) { ?>
                                                                        <input type="checkbox" style="display:none" name="cfood[lunch-<?php echo $d['name']; ?>]" value="" id="cfood-<?php echo $product['id']; ?>"/>
                                                                        
                                                                        <span class="cfood" id="cfood-<?php echo $product['id']; ?>">Customize Food</span> 
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="thumb_sec">
                                                                    <div class="thumb-left"><?php echo $product['name']; ?></div>
                                                                    <div class="thumb-right"><?php echo $product['calorie']; ?> Calories</div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </section>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="table_subhead">
                                                    <h1>Dinner</h1>
                                                    <b></b>
                                                </div>
                                                <section class="regular slider">
                                                    <?php
                                                    foreach ($d['products'] as $product) {
                                                        if ($product['category_id'] == 9) {
                                                            ?> 
                                                            <div class="table_item">
                                                                <img src="<?php echo $this->request->webroot ?>product/<?php echo $product['image']; ?>" alt="Image" style="height:200px;">
                                                                <div class="thumb_chk">
                                                                      
                                                                    <input type="checkbox" style="display:none" name="alergy-dinner-<?php echo $d['name']; ?>" value="" id="alergyinput-<?php echo $product['id']; ?>"/>
                                                                    <div class="radio_outer">
                                                                   
                                                                    </div>
                                                                    <span class="label label-success" id="alergy-<?php echo $product['id']; ?>">Check Allergens</span>
                                                                    <?php if ($srchplan == 3) { ?>
                                                                     <input type="checkbox" style="display:none" name="cfood[dinner-<?php echo $d['name']; ?>]" value="" id="cfood-<?php echo $product['id']; ?>"/>

                                                                     
                                                                        <span class="cfood" id="cfood-<?php echo $product['id']; ?>">Customize Food</span> 
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="thumb_sec">
                                                                    <div class="thumb-left"><?php echo $product['name']; ?></div>
                                                                    <div class="thumb-right"><?php echo $product['calorie']; ?> Calories</div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </section>                   
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                            </div> 
                        <?php } ?>

<div id="calorie_calc_sec">
    <div class="container">
        <div class="calorie_calc">
            <div class="col-lg-12 col-md-12">
                <a class="btn btn-danger calc_btn" href="<?php echo $this->request->webroot ?>users/calculator">Calories Calculator</a>
                               <p><img src="<?php echo $this->request->webroot ?>frontend/images/logo.png" ></p>
                <p class="calc_txt">We want you to be completely satisfied to you for order. If you are not, please reach out to our <a href="<?php echo $this->request->webroot ?>pages/contact">Customer Care Team</a> and they can
                    help you right away.</p>
            </div>
        </div>
        <!--calorie_calc--> 
    </div>
    <!--container--> 
</div>

<!--calorie_calc_sec-->
<!--login-->
<div class="modal fade login" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-mg login_model">
        <div class="modal-content login_box">
            <div class="modal-header" style="border:none;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> ×</button>

            </div>
            <div class="modal-body">
                <h1 class="login_title" id="myModalLabel">Log in to your Account</h1>
                <div class="row">
                    <div class="col-md-5">
                        <div class="row text-center sign-with">
                            <div class="col-md-12">
                                <div class="btn-group btn-group-justified"> 
                                    <a class="btn btn-block btn-social btn-facebook" onclick="myFacebookLogin()" > <i class="fa fa-facebook"></i> Facebook Log In</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="or_sec">
                            <div id="OR" class="hidden-xs voffset6"> OR</div>
                            <b></b> </div>
                    </div>
                    <div class="col-md-5"> 
                        <!-- Nav tabs --> 

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="Login">
                                <div class="alert alert-danger" style="display:none"></div>
                                <form role="form" class="form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="email" class="form-control" id="loginuname" placeholder="Your Email" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="password" class="form-control" id="loginpass" placeholder="Your Password" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 voffset2">
                                            <button type="button" class="btn btn-primary btn-sm myacc_btn" id="userlogin">Log in</button>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="voffset4">
                                                <p class="forgt_btn">  <a href="#forgetpwd" data-dismiss="modal" aria-hidden="true" role="button" data-toggle="modal" data-target="#forgetpwd"> Forgot your password?</a> </p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p class="dnt_sec">Don't have account? <a href="#signup" data-dismiss="modal" aria-hidden="true" role="button" data-toggle="modal" data-target="#signup">Signup here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade login" id="signup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> ×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="col-md-6 col-md-offset-3">
                        <form action="r" method="post" accept-charset="utf-8" class="form" role="form">
                            <div class="col-lg-6 col-lg-offset-3">
                                <legend>
                                    <div class="btn-group btn-group-justified"> <a class="btn btn-block btn-social btn-facebook" onclick="myFacebookLogin()" > <i class="fa fa-facebook"></i> Facebook Sign Up </a> </div>
                                </legend>
                            </div>
                            <h4>No auto posting ever.</h4>
                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="or_sec">
                                        <div id="OR" class="hidden-xs"> OR</div>
                                        <b></b>  </div>
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


                            <div class="row">
                                <div class="col-xs-6 col-md-6">
                                    <input type="text" name="phone" value="" id="signupphone" class="form-control input-md" placeholder="Phone"  /> 
                                </div>

                                <div class="col-xs-6 col-md-6">
                                    <input type="text" name="zip" value="" id="signuppzip" class="form-control input-md" placeholder="Enter your address"  /> 
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-4">
                                    <button class="btn btn-md btn-primary btn-block signup-btn" type="button" id="usersignup"> Sign up</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade login" id="forgetpwd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> ×</button>
            </div>
            <div class="modal-body">
                 <h1 class="login_title" id="myModalLabel">Forgot Password</h1>
                <div class="row">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="col-md-6 col-md-offset-3">
                        <form  method="post" accept-charset="utf-8" class="form" role="form">
                            <input type="email" name="email" value="" id="forgetpassemail" class="form-control input-md" placeholder="Enter your Email" required />
                             <div class="row">
                                        <div class="col-sm-12 voffset2">
                                            <button type="button" class="btn btn-primary btn-sm myacc_btn" id="forgetpass">Submit</button>
                                        </div>                           
                                    </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<?php if (empty($loggeduser)) { ?>
    <div id="myModal33" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                </div>
                <div class="modal-body">
                    <div class="subscipion_inners">
                        <div class="col-md-12 col-lg-12">
                            <div class="col-lg-6 col-md-6">
                                <h1>Choose your Subscription Plan</h1>
                            </div>
                            <div class="col-lg-6 col-md-6">
<!--                                <div class="location">
                                    <i class="fa fa-map-marker" aria-hidden="true"> <span id="zppop">Zip Code</span></i>
                                </div>-->
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
    <?php foreach ($allplans as $plan) {
        ?>
                                <div class="col-xs-12 col-md-4">


                                    <div class="panel">
                                        <div class="subc_head">&nbsp;</div>
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
        <?php echo $plan['name']; ?></h3>
                                        </div>
                                        <div class="the-price">
                                            <h2>
        <?php echo $plan['price']; ?> <br/><small> <?php echo $plan['description_short']; ?> </small></h2>
                                            <div class="arrow-up"></div>
                                        </div>
                                        <div class="panel-body">

                                            <table class="table subsc_tbl">
                                                <tr>
                                                    <td>
                                                        Classic Meal
                                                    </td>
                                                </tr>
                                                <tr class="active">
                                                    <td>
                                                        Only Dinner
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Choose Different Meals
                                                    </td>
                                                </tr>
                                                <tr class="active">
                                                    <td>
                                                        Weekly Subscription
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="panel-footer">
                                            <form action="<?php echo $this->request->webroot ?>users/signup" method="post">  
                                                <input type="hidden" name="subscription_plan_id" value="<?php echo $plan['id']; ?>">
                                                <input type="submit" name="submit" class="btn btn-default btn-md green_btn pull-left" value="Add to cart">
                                            </form>
                                            <form method="post">  
                                                <input type="hidden" name="id" value="<?php echo $plan['id']; ?>">
                                                <input type="button" name="submit" class="btn btn-default btn-md green_btn pull-right pselect" value="View Menu">
                                            </form>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
    <?php } ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div id="myModal333" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="poup_title">Alergy list</h3>
            </div>
            <div class="modal-body">
                <div class="subscipion_inners">
                    <div class="col-md-12 col-lg-12">
                       
                           
                                           
                    </div>
                    <div class="col-md-12 col-lg-12" id="333">

                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<div id="myModal222" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content clearfix">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="poup_title">Select Associated Product</h3>
            </div>
            <div class="modal-body">
                <div class="subscipion_inners">
                    <div class="col-md-12 col-lg-12">
                        
                            
                                            
                    </div>
                    <div class="col-md-12 col-lg-12" id="222"> <div class="associate_model">
                    
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
<script type="text/javascript">
    $('#userlogin').on("click", function () {
        var uname = $('#loginuname').val();
        var pass = $('#loginpass').val();
        $.post('<?php echo $base_url; ?>/users/login.json', {'username': uname, 'password': pass}, function (d) {
            if (d.response.isSucess == 'false') {
                $('.alert-danger').html(d.response.msg);
                $('.alert-danger').show();
            } else {
                location.reload();
            }
        });
    });

   $('#forgetpass').on("click", function () {
        var email = $('#forgetpassemail').val();
        $.post('<?php echo $base_url; ?>/users/forgetpassword.json', {'email': email}, function (d) {
                $('.alert-danger').html(d.response.msg);
                $('.alert-danger').show();
        });
    });
    $('#usersignup').on("click", function () {
        var fname = $('#signupfname').val();
        var lname = $('#signuplname').val();
        var uname = $('#signupuname').val();
        var pass = $('#signuppass').val();
        var cpass = $('#signupcpass').val();
        var phone = $('#signupphone').val();
        var zip = $('#signuppzip').val();
        $.post('<?php echo $base_url; ?>/users/add.json', {'email': uname, 'password': pass, 'cpassword': cpass, 'fname': fname, 'lname': lname, 'phone': phone, 'zip': zip}, function (d) {
            console.log(d);
            if (d.response.isSucess == 'false') {
                $('.alert-danger').html(d.response.msg);
                $('.alert-danger').show();
            } else {
                $('.alert-danger').html(d.response.msg);
                $('.alert-danger').show();
                window.setTimeout(function () {
                    window.location.href = '<?php echo $base_url; ?>/users/plans';
                }, 2000);
            }
        });
    });
    $('#pselect').on('change', function () {
        var val = this.value;
        $.post('<?php echo $base_url; ?>/users/home.json', {'srch_id': val}, function (d) {
            location.reload();
        });
    });
    
     $('.pselect').on('click', function () {
        var val = $(this).prev().val()
        $.post('<?php echo $base_url; ?>/users/home.json', {'srch_id': val}, function (d) {
            location.reload();
        });
    });
    
    $('#zipcode').on('click', function () {
        var val = $('#autocomplete').val();
        //alert(val);
        if (val) {
            $.post('<?php echo $base_url; ?>/users/zipcode.json', {'zipcode': val}, function (d) {
                //console.log(d);
                if (d.data.status == 1) {
                    localStorage.setItem('zip', d.data.pincode);
                    localStorage.setItem('venid', d.data.venid);
                    location.reload();
                } else {
                    $('#ziperror').html("There is no any vendor availabe in your location");
                }
            });
        } else {
            $('#ziperror').html("Please enter your zipcode");
        }
    });
    $(document).ready(function () {
        // waitingDialog.show();
        $('.regular').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyA1XYGRnhJ1qKJM0Wnngkkq02hUqhIiQI8&sensor=false&libraries=places" type="text/javascript"></script>
<script type="text/javascript">
    $("#autocomplete").on('focus', function () {
        geolocate();
    });
     $("#zipautofil").on('focus', function () {
        geolocate();
        
    });
     $("#signuppzip").on('focus', function () {
        geolocate();
        
    });
    var placeSearch, autocomplete,zipautofil,signuppzip
    
    ;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };
    function initialize() {
        $location_input = $("#zipautofil");
        $location_input_a = $("#signuppzip");
        var options = {
            types: ['geocode'],
            componentRestrictions: {country: "ZA"}
        };
        // Create the autocomplete object, restricting the search
        // to geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */ (document.getElementById('autocomplete')), options);
         signuppzip = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */ (document.getElementById('signuppzip')), options);
       zipautofil = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */ (document.getElementById('zipautofil')), options);


   google.maps.places.Autocomplete($location_input.get(0), options);  
   google.maps.places.Autocomplete($location_input_a.get(0), options);    
    google.maps.event.addListener(zipautofil, 'place_changed', function() {
        var data = $("#zipautofil").val();
                $.post('<?php echo $base_url; ?>/users/zipcode.json', {'zipcode': data}, function (d) {
                //console.log(d);
                if (d.data.status == 1) {
                    localStorage.setItem('zip', d.data.pincode);
                    localStorage.setItem('venid', d.data.venid);
                    location.reload();
                } else {
                   alert("There is no any vendor availabe in your location");
                    localStorage.removeItem('zip');
                    location.reload();
                    
                }
            });
    });
        google.maps.event.addListener(signuppzip, 'place_changed', function() {
        var data = $("#signuppzip").val();
                $.post('<?php echo $base_url; ?>/users/zipcode.json', {'zipcode': data}, function (d) {
                //console.log(d);
                if (d.data.status == 1) {
                    $('.alert-danger').html('Vendors are available now');
                    $('#usersignup').show();
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
     $('.label-success').on('click', function () {
        var val = $(this).attr("id");
        $.post('<?php echo $base_url; ?>/products/showalergy.json', {'id': val}, function (d) {
            if (d.data.isdata == 1) {
               //var localdata= localStorage.getItem(val);               
                var html = '<div>';
                for (i in d.data.data) {
               
                    //html += '<p><input type="checkbox"  value="' + d.data.data[i].id + '" name='+val+'></p>';
                   
                    html += '<p>' + d.data.data[i].name + '</p>';
                    html += '<p>' + d.data.data[i].about + '</p>';
                }
                html += '</div>';                
                // $("#radio"+val.split('-')[1]).attr("checked", "checked");             
//                            /console.log(html);
                $("#myModal333").modal('show');
                $("#333").html(html);

            }
        });
    });
   

    $('.cfood').on('click', function () {
        var val = $(this).attr("id");
        $.post('<?php echo $base_url; ?>/products/showalergy.json', {'id': val}, function (d) {
            console.log(d);
            if (d.data.isdata == 1) {
               //var localdata= localStorage.getItem(val);               
                var html = '<div class="associate_model">';
                for (i in d.data.data) {
                html +='<div class="modal-head"><h1 style="text-align:center; margin-bottom:15px; font-weight:700;">'+ d.data.data[i].name +'</h1></div>'; 
                for(j in d.data.data[i].asso_products) {
                html +='<div class="col-md-4 col-sm-4 asso_list">';                   
                html += '<div class="asso_pro"><img src=<?php echo $base_url; ?>/assoproduct/' + d.data.data[i].asso_products[j].image + ' style="width:100px"></div>';
                   html += '<h4>' + d.data.data[i].asso_products[j].name + '</h4>';
                   html += '<p>' + d.data.data[i].asso_products[j].description + '</p>';
		   html += '</div>'; 
                }
                }
                html += '</div>';               
                 $("#radio"+val.split('-')[1]).attr("checked", "checked");              
                $("#myModal222").modal('show'); 
                $("#222").html(html);

            }
        });
    });
    

	
</script>

<style type="text/css">
    
    .pac-container {
    width: auto !important;
    z-index: 9999999999!important;
}
</style>

