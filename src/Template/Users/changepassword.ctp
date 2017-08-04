<div class="order-history_sec">
    <div class="container">
        <div class="order-history_inner clearfix">
            <h1>Change Password</h1>
			<div class="edit_pro">
            <div class="row">
			<div class="col-sm-4 col-sm-offset-4">
			
                <div class="table_edit">
         <?= $this->Flash->render() ?>
           <?= $this->Form->create() ?>
                    <label>Old password</label>
                    <input type="password" name="old_password" value="" type="text" required=""/><br/>

                    <label>New Password</label>
                    <input type="password" name="new_password" id="pass1" value="" type="text" required=""/><br/>
                    <label>Confirm Password</label>
                    <input type="password" name="cpassword" value="" type="text" required=""/><br/>
                </div>
                <?= $this->Form->button(__('Submit')) ?>
            </div>
        </div>
         <?= $this->Form->end() ?>
</div>
                </div>
				</div>
				</div>
            </div></div>
    </div>
          