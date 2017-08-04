<div class="order-history_sec">
    <div class="container">
        <div class="order-history_inner clearfix">
            <h1>Edit Profile</h1>
			<div class="edit_pro">
            <div class="row">
			<div class="col-sm-4 col-sm-offset-4">
			
                <div class="table_edit">
    <?= $this->Flash->render() ?>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <?php
            echo $this->Form->input('email',array('label'=>'Email'));
            echo $this->Form->input('fname',array('label'=>'First Name'));            
            echo $this->Form->input('lname',array('label'=>'Last Name'));
            echo $this->Form->input('phone',array('label'=>'Phone'));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
                </div>
				</div>
				</div>
            </div></div>
    </div>
