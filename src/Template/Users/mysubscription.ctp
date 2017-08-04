<?php

use Cake\Utility\Security;

$key = 'absbsbsbs123585s55s85s852s202s55s8';
?>
<div class="myaccunt_sec">
    <div class="container">
        <div lang="row">
            <div class="table-responsive">

                <div class="col-lg-6 col-md-offset-3">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="myacount_tbl">
                        <tr>
                            <th colspan="2">My Subscription Plan</th>  
                        </tr>
                        <tr>

                            <td>
                                <table width="100%" border="0">
                                    <tr>
                                        <td><strong>Name</strong></td>
                                        <td colspan="2">:<?= h($user->fname . " " . $user->lname) ?></td>    
                                    </tr>
                                    <tr>
                                        <td><strong>E-mail</strong></td>
                                        <td><span>: <?= h($user->email) ?></span> </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Subscription Plan Name</strong></td>
                                        <td><span>: <?= h($user->subscription_plan->name) ?></span> </td>
                                    </tr> 
                                    <tr>
                                        <td><strong>Total meals</strong></td>
                                        <td><span>: <?= h($user->subscription_plan->meals) ?></span> </td>
                                    </tr>
                                     <tr>
                                        <td><strong>Used meals</strong></td>
                                        <td><span>: <?= h($uplan->used_meal) ?></span> </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Subscription Plan Time(day)</strong></td>
                                        <td><span>: <?= h($user->subscription_plan->day) ?></span> </td>
                                    </tr>
                                      <tr>
                                        <td><strong>Subscription Plan Expire</strong></td>
                                        <td><span>: <?= h($uplan->expireon) ?></span> </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Description</strong></td>
                                        <td><span>: <?= h($user->subscription_plan->description_long) ?></span> </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Subscription Plan Price</strong></td>
                                        <td><span>: <?= h($user->subscription_plan->price) ?></span> </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Subscription Created Time</strong></td>
                                        <td><span>: <?= h($uplan->created) ?></span> </td>
                                    </tr>
                                    
                                      <tr>
                                        <td><strong>Image</strong></td>
                                        <td><span>:<img src="<?php echo $this->request->webroot ?>plan/<?php echo $user->subscription_plan->image; ?>" style="width: 100px; height: 100px"/></span> </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td><span>: <?php
                                                if ($user->is_activeplan == 1) {
                                                    echo "Active";
                                                } else {
                                                    echo "Deactive";
                                                }
                                                ?></span> </td>
                                    </tr>
                                </table>


                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="btn-group">
<?= $this->Html->link(__('Upgrade Plan'), ['action' => 'plans'], ['class' => 'class="btn btn-success green_btn']) ?> 
                                </div>
                            </td>

                        </tr>
                        <div class="clearfix"></div>
                    </table>
                </div>

            </div>
        </div>
    </div><!--container-->
</div><!--cart_sec-->