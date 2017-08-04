    <div class="order-history_sec">
    <div class="container">
        <div class="order-history_inner clearfix">
            <h1>Product Details</h1>
            <div class="row">
                <div class="table-responsive">
   
</div>
                </div>
</div>



<div class="row">
	<div class="col-sm-5">
		<div class="spro_img">
			<img src="<?php echo $this->request->webroot ?>product/<?php echo $orderItem->product->image; ?>"/>
		</div>
	</div> 
	<div class="col-sm-7">
	<div class="pro_details">
       <div class="prosec"><strong><?= __('Product Name') ?></strong> <p><?php echo $orderItem->product->name; ?></p></div>
	  
	   <div class="prosec"><strong><?= __('Description') ?></strong><p><?= h($orderItem->product->description) ?></p></h5>
	</div>
	</div>
</div>


        </div></div>
            <div class="container">
        <div class="order-history_inner clearfix">
            <h1>Associate Product</h1>
            <div class="row">
                <div class="table-responsive">
   
</div>
                </div>
</div>


<?php foreach($assoorders as $assoorders) {?>
<div class="row">
 
	<div class="col-sm-7">
	<div class="pro_details">
       <div class="prosec"><strong><?= __('Product Name') ?></strong> <p><?php echo $assoorders->name; ?></p></div>
	  
	   <div class="prosec"><strong><?= __('Description') ?></strong><p><?= h($assoorders->description) ?></p></h5>
	</div>
	</div>
</div>


        </div>
<?php }?>
            </div>

