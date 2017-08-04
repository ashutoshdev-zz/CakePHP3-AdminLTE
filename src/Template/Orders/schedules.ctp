<?php 
use Cake\Utility\Security;
$key = 'absbsbsbs123585s55s85s852s202s55s8';
//echo $secret = Security::cipher('hello world', 'my_key');
//
//// Later decrypt your text
//echo $nosecret = Security::cipher($secret, 'my_key');
//exit;
?>
<div class="order-history_sec">
    <div class="container">
        <div class="order-history_inner clearfix">
            <h1>Weekly Schedule</h1>
             <?= $this->Flash->render() ?><br/>
            <div class="row">
                <div class="table-inside">
        <?php   if (!empty($order)): ?>
      <table class="ordr-h_tbl">
<thead>
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Day') ?></th>
                <th scope="col"><?= __('Food Time') ?></th>
                
                <th scope="col"><?= __('Order') ?></th>     
                <th scope="col"><?= __('Time Slot') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
</thead>
            <?php foreach ($order as $order): ?>
       <tbody>     
<tr>    
                <td data-label="ID"><?= h($order->id) ?></td>
                <td data-label="DAY"><b style="font-size: 15px; color: #9bca3b;"><?php echo strtoupper($order->dayname); ?></b></td>
                <td data-label="FOOD TIME"><?php echo strtoupper($order->foodtime); ?></td>
                <td data-label="ORDER"><?php if($order->quantity==1){ echo "Yes";} else {echo "No";}  ?></td>
                <td data-label="TIME SLOT">
                    
                    <?php
                    if($order->quantity==1){
                    if($order->foodtime=='lunch'){
                    echo "<select class='pselect'>"; 
                    echo "<option>Lunch Time</opton>";
                    foreach($timeslot as $tslt){                   
                     if($tslt->category_id==8){
                         if($order->timeslot==$tslt->timeslot){
                         echo "<option selected value=$order->id>$tslt->timeslot</opton>"; 
                         }else {
                             echo "<option value=$order->id>$tslt->timeslot</opton>"; 
                         }
                     }
                }
                 echo "</select>";
                    }else {
                   echo "<select class='pselect'>"; 
                    echo "<option>Dinner Time</opton>";
                    foreach($timeslot as $tslt){                   
                     if($tslt->category_id==9){   
                         if($order->timeslot==$tslt->timeslot){
                         echo "<option selected value=$order->id>$tslt->timeslot</opton>";    
                         }else {
                             echo "<option value=$order->id>$tslt->timeslot</opton>";    
                         }
                     }
                }
                 echo "</select>";
                    }
                    }?></td>                                 
                <td data-label="ACTIONS" class="actions">                    
                    <?php if($order->quantity==1){ echo  $this->Html->link(__('View'), ['controller' => 'WeeklyShedules', 'action' => 'view', base64_encode($order->id)],['class'=>['action_btn view_color']]); } ?> 
                    <?php if(strtoupper($order->dayname)!=strtoupper(date("l"))) { echo $this->Html->link(__('Add/Change'), ['controller' => 'Users', 'action' => 'changefood', base64_encode($order->dayname)],['class'=>['action_btn change_color']]);   
                    if($order->dl_status==0 && $order->quantity==1) {  echo $this->Html->link(__('Not want food'), ['controller' => 'WeeklyShedules', 'action' => 'nowantfood', base64_encode($order->id)],['class'=>['action_btn not_want']]);} 
                    
                    else if($order->dl_status==1 && $order->quantity==1) {
                        echo $this->Html->link(__('Want Food'), ['controller' => 'WeeklyShedules', 'action' => 'wantfood', base64_encode($order->id)],['class'=>['action_btn not_want']]);
                    }
                    
                    } ?>
                </td>
            </tr>
</tbody>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
            </div></div>
</div>
<script type="text/javascript">
    $('.pselect').on('change', function () {
        var val = this.value;
        var text=$(this).find("option:selected").text();
        $.post('<?php echo $base_url; ?>/orders/timeslot.json', {'timeslt': val,'text':text}, function (d) {
         alert("You have been changed the time slot");  
        });
    });
</script>