<div id="header_sec">
    <div class="container">
        <div class="row">
        <div class="header_top">
            <div class="logo"> 
            <a href="<?php echo $this->request->webroot ?>"><img src="<?php echo $this->request->webroot ?>frontend/images/logo.png" class="img-responsive center-block" alt="" ></a> 
            </div>
            <!--logo--> 
            
            
            <div class="log_sec">
                <ul class="list-inline">
                    <?php if (!empty($loggeduser)) { ?>
                        <li>                        
                            <div class="myaccnt">
                                <div class="checkbox checkbox-circle">
                                    <div class="dropdown">
                                        <a id="dLabel" role="button" data-toggle="dropdown" class="" data-target="#">
                                            My Account  <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                             <li><a href="<?php echo $this->request->webroot ?>users/myaccount">My Profile</a></li>
                                             <li><a target="_blank" href="<?php echo $this->request->webroot ?>addresses">Add Address</a></li> 
                                             <li><a target="_blank" href="<?php echo $this->request->webroot ?>orders/schedules">Weekly Schedule</a></li>
                                             <li><a href="<?php echo $this->request->webroot ?>users/mysubscription">My Subscription</a></li>
                                             <li><a href="<?php echo $this->request->webroot ?>orders">My Order</a></li>                                           
                                              <li><a href="<?php echo $this->request->webroot ?>PaymentHistories">Payment History</a></li>
                                               <li><a href="<?php echo $this->request->webroot ?>users/calculatorin">Calories Calculator</a></li>
                                             <li><a href="<?php echo $this->request->webroot ?>users/rank">Plaiter Campaign</a></li>
                                        </ul>
                                    </div> 
                                </div>
                            </div>                    
                            <!--myaccnt--> 
                        </li>
                        
                        <li><a href="<?php echo $this->request->webroot ?>users/product" role="button">Order Meal</a></li>
                        <li><a href="<?php echo $this->request->webroot ?>users/logout" role="button" >Log Out</a></li>
                    <?php } else { ?>
                        <li><a href="#" role="button" data-toggle="modal" data-target="#myModal">Log In</a></li>
                        <li><a href="#"  role="button" data-toggle="modal" data-target="#signup">Sign Up</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo $this->request->webroot ?>pages/about">About Us</a></li>
								<li><a href="<?php echo $this->request->webroot ?>pages/subscriptionplan">Subscription Plans</a></li>
								<li><a href="<?php echo $this->request->webroot ?>pages/howitwork">How It Works</a></li>
								<li><a href="<?php echo $this->request->webroot ?>pages/didyouknow">Did You Know</a></li>
							</ul>
						</li>
                    <?php } ?>
                </ul>
                 <?php if (empty($loggeduser)) { ?>
				<p>Already a member <a href="#" role="button" data-toggle="modal" data-target="#myModal">Sign In</a></p>
                 <?php }?>
            </div>
            <!--log_sec--> 

        </div>
        </div>
        <!--col-lg-12 col-md-12--> 
    </div>

</div>
<!--header_sec-->