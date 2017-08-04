<div id="subscipion_sec">
    <div class="container">
        <div class="subscipion_inners">
            <div class="col-md-12 col-lg-12">    
                <?php foreach ($allplans as $plan) {
                    ?>
                    <div class="col-xs-12 col-md-4">
                        <div class="panel">
                            <div class="subc_head">&nbsp;</div>
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <?php echo $plan['name']; ?></h3>
                            </div>
                            <div class="the-price">
                                <h2>
                                   R <?php echo $plan['price']; ?> <br/><small> <?php echo $plan['description_short']; ?> </small></h2>
                                <div class="arrow-up"></div>
                            </div>
                            <div class="panel-body">

                                <table class="table subsc_tbl">
                                    <tr>
                                        <td>
                                            Classic Meal
                                        </td>
                                    </tr>
                                    <tr class="active">
                                        <td>
                                            Only Dinner
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Choose Different Meals
                                        </td>
                                    </tr>
                                    <tr class="active">
                                        <td>
                                            Weekly Subscription
                                        </td>
                                    </tr>


                                </table>
                            </div>
                            <div class="panel-footer">
                              
                                <form action="<?php echo $this->request->webroot ?>users/plans" method="post">  
                                         <input type="hidden" name="subscription_plan_id" value="<?php echo $plan['id']; ?>">
                                         <input type="submit" name="submit" class="btn btn-default btn-md green_btn pull-left" value="Add to cart">
                                    </form>
                              
<!--                                <form action="<?php //echo $this->request->webroot ?>users/home" method="post">  
                                         <input type="hidden" name="id" value="<?php //echo $plan['id']; ?>">
                                        <input type="submit" name="submit" class="btn btn-default btn-md green_btn pull-right" value="View Menu">
                                    </form>-->
                              
                                <div class="clearfix"></div>

                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>