<div class="container">

<div class="col-md-3"></div>

<div class="col-md-6">
     <?= $this->Flash->render() ?>
    <div class="form-area">  
        <form role="form" name="frm" method="post" action="<?php echo $this->request->webroot ?>pages/contact">
        <br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center;">Contact Us</h3>
    				<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
					</div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" type="textarea" id="message" placeholder="Message" maxlength="140" rows="7" required></textarea>                    
                    </div>
            
                    <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right">Submit Form</button>
        </form>
    </div>
</div>
<div class="col-md-3"></div>
</div>