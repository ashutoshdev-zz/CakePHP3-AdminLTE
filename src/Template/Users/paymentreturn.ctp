<div id="cnfrmation_sec">
    <div class="container">
        <div class="col-md-12 col-lg-12">
            <div class="cnfrmation_sec">
                <div class="circle_grn"><i class="fa fa-check" aria-hidden="true"></i>
                </div>
                <p class="tnks"><span>Thanks for Using</span> Plait</p>
                <p>Your Request for the Subscription Plan <br/>has been Succesfully Placed</p>
                <?php  if($uplans['d']==1) { ?>
                <p style="color: #9bca3b;"><b style="color: #000;">Message:</b> <?php  echo $uplans['msg']; ?></p>
                <p style="color: #9bca3b;"><b style="color: #000;">Transaction ID:</b> <?php  echo $uplans->txn_id; ?></p>
                <p style="color: #9bca3b;"><b style="color: #000;">Amount:</b> R<?php echo $uplans->amt / 100;?></p>
                <p style="color: #9bca3b;"><b style="color: #000;">Status:</b> <?php if($uplans->status==1){ echo "Success"; } else { echo "Fail"; }?></p>
                <?php } else { ?>
                <p style="color: #9bca3b;"><b style="color: #000;">Message:</b> <?php  echo $uplans['msg']; ?></p>
                <?php } ?>
            </div>

        </div>
    </div>
</div><!--container-->
</div><!--cart_sec-->



