<div id="header_sec">
    <div class="container">
        <div class="col-lg-12 col-md-12">
            <div class="logo"><a href="<?php echo $this->request->webroot ?>"> <img src="<?php echo $this->request->webroot ?>frontend/images/logo.png" class="img-responsive center-block" alt="" > </a></div>
            <!--logo--> 
        </div>
        <!--col-lg-12 col-md-12--> 
    </div>
    <!--container-->

    <div class="container">
        <div class="col-lg-12 col-md-12">
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
                                            
                                        </ul>
                                    </div> 
                                </div>

                            </div>                    
                            <!--myaccnt--> 
                        </li>
                        
                        <li><a href="<?php echo $this->request->webroot ?>users/logout" role="button" >Log Out</a></li>
                    <?php } ?>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo $this->request->webroot ?>pages/about">About Us</a></li>
								<li><a href="<?php echo $this->request->webroot ?>pages/subscriptionplan">Subscription Plans</a></li>
								<li><a href="<?php echo $this->request->webroot ?>pages/howitwork">How It Works</a></li>
								<li><a href="<?php echo $this->request->webroot ?>pages/didyouknow">Did You Know</a></li>
						</ul>
					</li>
                </ul>
            </div>
            <!--log_sec--> 

        </div>
        <!--col-lg-12 col-md-12--> 
    </div>
    <!--container--> 

</div>
<!--header_sec-->