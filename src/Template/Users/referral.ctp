<div id="cnfrmation_sec">
    <div class="container">
        <div class="col-md-12 col-lg-12">
            <div class="cnfrmation_sec">
                
                <div class="alert alert-danger"> <?= $this->Flash->render() ?><br/></div>
                <div class="col-md-6 col-md-offset-3">
                    <form action="<?php echo $this->request->webroot ?>Users/referral" method="post" accept-charset="utf-8" class="form" role="form">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">            
                                <div class="clearfix"></div>
                            </div><!--col-xs-6 col-md-6-->
                        </div><!--row-->
                        <input type="text" name="refferal" value=""  class="form-control input-md" placeholder="Enter Referral code"  /> 
                        <br/>
                        <div class="row">
                            <div class="col-xs-6 col-md-6 col-xs-push-4">
                                <button class="btn btn-md btn-primary btn-block signup-btn" type="submit" > Apply Code</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>      