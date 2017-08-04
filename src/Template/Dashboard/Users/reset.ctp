<div class="con_main">
    <div class="container">
        <div class="page_inn"><!--page inn start-->
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="login_box_m">
                    <?= $this->Flash->render() ?>
                    <div class="login_b"><h1>Forget password</h1></div>
                    <div class="loign_form">
                        <?php echo $this->Form->create('User'); ?>
                        <p><label>  password  <i>*</i></label><span> <input type="password"  name="password" required ></span></p>
                        <p><label>  Confirm Password <i>*</i></label><span><input type="password"  name="password_confirm" required></span></p>
                    </div>     
                    <div class="login_buttonn "><input type="submit" name="submit" value="Submit"></div>
                    <?php $this->Form->end(); ?>
                </div>
            </div>            
        </div>
    </div>
</div><!--page inn end-->
