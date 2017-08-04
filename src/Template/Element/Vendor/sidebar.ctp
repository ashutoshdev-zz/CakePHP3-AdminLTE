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
                    <li class="active"><a href="<?php echo $this->request->webroot ?>vendor/users/dashboard"><i class="fa fa-circle-o"></i> Dashboard</a></li>          
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
<!--                    <li class="active"><a href="<?php //echo $this->request->webroot ?>vendor/orders"><i class="fa fa-circle-o"></i>Order</a></li>     -->
                    <li class="active"><a href="<?php echo $this->request->webroot ?>vendor/orderItems"><i class="fa fa-circle-o"></i>Order Item</a></li>
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
                    <li class="active"><a href="<?php echo $this->request->webroot ?>vendor/products"><i class="fa fa-circle-o"></i>Product</a></li>     
                    <li class="active"><a href="<?php echo $this->request->webroot ?>vendor/products/add"><i class="fa fa-circle-o"></i>Add Product</a></li>
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
                    <li class="active"><a href="<?php echo $this->request->webroot ?>vendor/alergies"><i class="fa fa-circle-o"></i>Alergy</a></li>     
                    <li class="active"><a href="<?php echo $this->request->webroot ?>vendor/alergies/add"><i class="fa fa-circle-o"></i>Add Alergy</a></li>
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
                    <li class="active"><a href="<?php echo $this->request->webroot ?>vendor/AssoCategories"><i class="fa fa-circle-o"></i>AssoProductCat</a></li>     
                    <li class="active"><a href="<?php echo $this->request->webroot ?>vendor/AssoCategories/add"><i class="fa fa-circle-o"></i>Add AssoProductCat</a></li>
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
                    <li class="active"><a href="<?php echo $this->request->webroot ?>vendor/AssoProducts"><i class="fa fa-circle-o"></i>AssoProduct</a></li>     
                    <li class="active"><a href="<?php echo $this->request->webroot ?>vendor/AssoProducts/add"><i class="fa fa-circle-o"></i>Add AssoProduct</a></li>
                </ul>
            </li>
           
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>