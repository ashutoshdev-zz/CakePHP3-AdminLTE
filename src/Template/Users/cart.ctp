<div id="cart_sec">
    <div class="container">
    
    <div class="col-sm-10 col-sm-offset-1">
    
       <div class="cart_table">
    
    <div id="cart-table-inner">
  <table class="col-md-12 table-bordered table-striped table-condensed cf table" style="margin-bottom:0px;">
    <thead class="cf"> 
      <tr> 
        <th>Item</th>
        <th>qty</th>
        <th>price</th>
        <th style="white-space: nowrap">delivery details</th>
      </tr>
    </thead> 
    <tbody>
      <tr> 
        <td data-title="Item">
        	<div class="crt_item">
            	<h1>Today, <?php echo $date; ?></h1>
                <h5><?php echo $data['name'];  ?></h5>
            	<div class="cart_itmdetails">
                	<div class="cart_imgitem">
                    	<img src="<?php echo $this->request->webroot ?>plan/<?php echo $data['image']; ?>" alt="..." class="img-responsive"/>
                    </div>
                    <p><?php echo $data['description_long']; ?></p>
                </div>
            </div>
        </td>
        <td data-title="qty"><input type="text"  readonly class="form-control text-center qty" value="1"></td>
        <td data-title="price"><strong class="qty_p">R<?php echo $data['price']; ?></strong></td>
        <td data-title="delivery details"><span class="green_txt">Free</span></td>

      </tr>
      
      
      <tr>
      	<td colspan="4">
        	<span class="total_price">
            	<strong>Total :</strong>R <?php echo $data['price']; ?>
            </span>
            <div class="sub_total">
            	<div id="subtotal" style="display: none"> </div>
            </div>
        </td>
      </tr>
      
      <tr style="background:#f2f2f2;">
      	<td colspan="2">
        	<div class="promo_code">
            	<input type="text" class="form-control" name="validate-text" id="pcodeval" placeholder="Enter your promo code">
                <input type="submit" id="pcode" value="Apply" />
                 <p id="msg" style="display: none"></p>
            </div>
        </td>
        
        <?php if($uplanp=='false') {  ?>
        <td colspan="2">
        	<div class="promo_code">
            	<input type="text" class="form-control" name="validate-text" id="referral" placeholder="Enter Referral code">
                <input type="submit" id="referralcode" value="Apply" />
                
                <p id="rmsg" style="display: none"></p>
                <p id="mmsg" style="display: none"></p>
            </div>
            
        </td>
        <?php } ?>
        
      </tr>
         
      
      <tr>
      
      <form action="<?php echo $this->request->webroot; ?>payment/index.php" method="post">
      	<td colspan="3">
        	<div class="debit_cart">
<!--                <input  type="checkbox" value="debitcard/creditcard" name="payment" required>-->
                <label for="check7">
                    Pay with Debit/Credit Card <i class="fa fa-credit-card" aria-hidden="true"></i>
                </label>
            </div>
            
        
        </td>
        <td>
        	  <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">                                       
            
                <div class="">
                     <input type="submit" name="crtsubmit" value="Make Payment" class="btn btn-success btn-block sve_btn green_btn">                    				
                </div>										
            
           
        </td>
         </form>
      </tr>
      
      

    </tbody>
  </table>
</div>
    
</div>

    
</div>
</div>
</div>

<script type="text/javascript">
   $('#pcode').on("click", function () {
        var uid = '<?php echo $uid; ?>';
        var pcodeval = $('#pcodeval').val();
        $.post('<?php echo $base_url; ?>/dashboard/promocodes/applypcode.json', {'uid': uid,  'pcode': pcodeval}, function (d) {
            
//              / console.log(d.data);
               $('#msg').show();
               $('#msg').html(d.data.msg);
               if(d.data.subtotal){
                   $('#subtotal').show();
                   $('#subtotal').html("<strong>Sub total:</strong>R"+d.data.subtotal.subtotal);
               }else {
                   $('#subtotal').html("");
                   $('#subtotal').hide();
               }
//            if (d.response.isSucess == 'false') {
//                $('.alert-danger').html(d.response.msg);
//                $('.alert-danger').show();
//            }
        });
    });
       $('#referralcode').on("click", function () {
        var uid = '<?php echo $uid; ?>';
        var pcodeval = $('#referral').val();
        $.post('<?php echo $base_url; ?>/users/referral.json', {'uid': uid,  'pcode': pcodeval}, function (d) {
            console.log(d);
               $('#rmsg').show();
               $('#rmsg').html(d.data.msg);
               $('#mmsg').hide();
               if(d.data.points){
               $('#mmsg').show();
               $('#mmsg').html("You have earned "+d.data.points);
           }
               
        });
    });
    </script>