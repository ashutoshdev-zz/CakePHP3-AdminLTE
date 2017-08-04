<div class="login-box">
    <div class="login-logo">
        <img src="<?php echo $this->request->webroot?>img/imgpsh_fullsize.png" style="width:140px">
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <?= $this->Flash->render('auth') ?>
        <?= $this->Form->create() ?>
        <div class="form-group has-feedback">
            <?= $this->Form->input('username', array('class' => 'form-control','label'=>false)) ?>          
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <?= $this->Form->input('password', array('class' => 'form-control','label'=>false)) ?>            
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox"> Remember Me
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <?= $this->Form->button(('Login'),array('class' => 'btn btn-primary btn-block btn-flat')); ?>
            </div>
            <!-- /.col -->
        </div>

        <?= $this->Form->end() ?>


        <!-- /.social-auth-links -->

        <a href="#forgetpwd" data-dismiss="modal" aria-hidden="true" role="button" data-toggle="modal" data-target="#forgetpwd">I forgot my password</a><br>
    </div>
    <!-- /.login-box-body -->
</div>
<div class="modal fade login" id="forgetpwd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> ×</button>
            </div>
            <div class="modal-body">
                 <h1 class="login_title" id="myModalLabel">Forgot Password</h1>
                <div class="row">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="col-md-6 col-md-offset-3">
                        <form  method="post" accept-charset="utf-8" class="form" role="form">
                            <input type="email" name="email" value="" id="forgetpassemail" class="form-control input-md" placeholder="Enter your Email" required />
                             <div class="row">
                                        <div class="col-sm-12 voffset2">
                                            <button type="button" class="btn btn-primary btn-sm myacc_btn" id="forgetpass">Submit</button>
                                        </div>                           
                                    </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
