<div class="order-history_sec">
    <div class="container">
        <div class="order-history_inner clearfix">
            <h1>Edit Profile</h1>
			<div class="edit_pro">
            <div class="row">
			<div class="col-sm-4 col-sm-offset-4">
			
                <div class="table_edit">
         <?= $this->Flash->render() ?>
           <?= $this->Form->create('Users', ['type' => 'file']) ?>
                   <td><img src="<?php echo $this->request->webroot ?>user/<?php echo $user->image; ?>" class="img-responsive" alt="" ></td>
                    <label>Upload Image</label>
                    <input type="file" name="image"  required=""/><br/>
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
          