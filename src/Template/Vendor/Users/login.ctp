<div class="login-box">
    <div class="login-logo">
        <img src="<?php echo $this->request->webroot?>/img/imgpsh_fullsize.png" style="width:140px">
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

        <a href="#">I forgot my password</a><br>
    </div>
    <!-- /.login-box-body -->
</div>