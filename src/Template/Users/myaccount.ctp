<div class="myaccunt_sec">
    <div class="container">
        <div lang="row">
            <div class="col-lg-9 col-md-offset-2">
                <div class="table-inside">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="myacount_tbl">
                        <tr>
                            <th colspan="2">My Profile </th>  
                             <?= $this->Flash->render() ?><br/>
                        </tr>
                        <tr>
                            <td><img src="<?php echo $this->request->webroot ?>user/<?php echo $user->image; ?>" class="img-responsive" alt="" ></td>
                            <td>
                                <table class="profile_tab" width="100%" border="0">
<tbody>
                                    <tr>
                                        <td><strong>Name</strong></td>
                                        <td data-lable colspan="2">:<?= h($user->fname . " " . $user->lname) ?></td>    
                                    </tr>
                                    <tr>
                                        <td><strong>E-mail</strong></td>
                                        <td><span>:<?= h($user->email) ?></span> </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phone</strong></td>
                                        <td><span>:<?= h($user->phone) ?></span> </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Username</strong></td>
                                        <td><span>: <?= h($user->username) ?></span> </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Subscription Plan</strong></td>
                                        <td><span>: <?= h($user->subscription_plan->name) ?></span> </td>
                                    </tr> 
                                      <tr>
                                        <td><strong>My Referral Code</strong></td>
                                        <td><span>: <?= h($user->my_r_code) ?></span> </td>
                                    </tr> 
                                    <tr>
                                        <td><strong>Referral Points</strong></td>
                                        <td><span>: <?php if($user->wallets[0]->points) { echo $user->wallets[0]->points; }else { echo "0"; }?></span> </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td><span>: <?php if ($user->is_activeplan == 1) {
    echo "Active";
} else {
    echo "Deactive";
} ?></span> </td>
                                    </tr>
</tbody>
                                </table>


                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="btn-group btn_grs">
                                    <?= $this->Html->link(__('Edit Profile'), ['action' => 'edit'], ['class' => 'class="btn btn-success green_btn']) ?> 
                                </div>
                                <div class="btn-group btn_grs">
<?= $this->Html->link(__('Change Password'), ['action' => 'changepassword'], ['class' => 'class="btn btn-success green_btn']) ?> 
                                </div>
                                <div class="btn-group btn_grs">
<?= $this->Html->link(__('Change Profile Picture'), ['action' => 'updateimage'], ['class' => 'class="btn btn-success green_btn']) ?> 
                                </div>
                                 <div class="btn-group btn_grs">
<?= $this->Html->link(__('Change Your Location'), ['action' => 'addressupdate'], ['class' => 'class="btn btn-success green_btn']) ?> 
                                </div>
<!--                                 <div class="btn-group btn_grs">
<?php // $this->Html->link(__('Use Referral Code '), ['action' => 'referral'], ['class' => 'class="btn btn-success green_btn']) ?> 
                                </div>-->
                            </td>
                        </tr>
                        <div class="clearfix"></div>
                    </table>
                </div>
            </div>
        </div>
    </div><!--container-->
</div><!--cart_sec-->