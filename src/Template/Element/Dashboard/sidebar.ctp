<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $this->request->webroot ?>user/<?php echo $userdata['image']; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $userdata['fname'] . ' ' . $userdata['lname']; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">      
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/users/dashboard"><i class="fa fa-circle-o"></i> Dashboard</a></li>          
                </ul>
            </li>   
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/users"><i class="fa fa-circle-o"></i>User List</a></li> 
                     <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/users/vendorlist"><i class="fa fa-circle-o"></i>Vendor List</a></li> 
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/users/add"><i class="fa fa-circle-o"></i>Add User&Vendor</a></li>   
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-secret"></i> <span>Subscription Type</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/subscriptionTypes"><i class="fa fa-circle-o"></i>Subscription Type</a></li>     
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/subscriptionTypes/add"><i class="fa fa-circle-o"></i>Add Subscription Type</a></li>
                </ul>
            </li>   
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-secret"></i> <span>Subscription Plan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/subscriptionPlans"><i class="fa fa-circle-o"></i>Subscription Plan</a></li>     
<!--                    <li class="active"><a href="<?php //echo $this->request->webroot ?>dashboard/subscriptionPlans/add"><i class="fa fa-circle-o"></i>Add Subscription Plan</a></li>-->
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-object-group"></i> <span>Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/categories"><i class="fa fa-circle-o"></i>Category</a></li>     
<!--                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/categories/add"><i class="fa fa-circle-o"></i>Add Category</a></li>-->
                </ul>
            </li> 
            
<!--            <li class="treeview">
                <a href="#">
                    <i class="fa fa-object-group"></i> <span>Sub Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/subcategories"><i class="fa fa-circle-o"></i>SubCategory</a></li>     
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/subcategories/add"><i class="fa fa-circle-o"></i>Add SubCategory</a></li>
                </ul>
            </li> -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-sun-o"></i> <span>Day</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/days"><i class="fa fa-circle-o"></i>Day</a></li>     
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/days/add"><i class="fa fa-circle-o"></i>Add Day</a></li>
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-inbox"></i> <span>Order</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/orders"><i class="fa fa-circle-o"></i>Order</a></li>     
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/orderItems"><i class="fa fa-circle-o"></i>Order Item</a></li>
                </ul>
            </li> 
              <li class="treeview">
                <a href="#">
                    <i class="fa fa-barcode"></i> <span>Product</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/products"><i class="fa fa-circle-o"></i>Product</a></li>     
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/products/add"><i class="fa fa-circle-o"></i>Add Product</a></li>
                </ul>
            </li> 
                  <li class="treeview">
                <a href="#">
                    <i class="fa fa-exclamation-circle"></i> <span>Alergy</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/alergies"><i class="fa fa-circle-o"></i>Alergy</a></li>     
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/alergies/add"><i class="fa fa-circle-o"></i>Add Alergy</a></li>
                </ul>
            </li> 
                  <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-o"></i> <span>Page</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/staticpages"><i class="fa fa-circle-o"></i>Page</a></li>     
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/staticpages/add"><i class="fa fa-circle-o"></i>Add Page</a></li>
                </ul>
            </li> 
              <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-o"></i> <span>Associate Product Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/AssoCategories"><i class="fa fa-circle-o"></i>AssoProductCat</a></li>     
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/AssoCategories/add"><i class="fa fa-circle-o"></i>Add AssoProductCat</a></li>
                </ul>
            </li>
                 <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-o"></i> <span>Associate Product</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/AssoProducts"><i class="fa fa-circle-o"></i>AssoProduct</a></li>     
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/AssoProducts/add"><i class="fa fa-circle-o"></i>Add AssoProduct</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-o"></i> <span>Promocode</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/promocodes"><i class="fa fa-circle-o"></i>Promocode</a></li>     
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/promocodes/add"><i class="fa fa-circle-o"></i>Add Promocode</a></li>
                </ul>
            </li>
                     <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-o"></i> <span>Timeslot</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/timeslots"><i class="fa fa-circle-o"></i>Timeslot</a></li>     
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/timeslots/add"><i class="fa fa-circle-o"></i>Add Timeslot</a></li>
                </ul>
            </li>
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-o"></i> <span>Referral</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/referrals"><i class="fa fa-circle-o"></i>Referral</a></li>     
<!--                    <li class="active"><a href="<?php echo $this->request->webroot ?>dashboard/referrals/add"><i class="fa fa-circle-o"></i>Add Referral</a></li>-->
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>