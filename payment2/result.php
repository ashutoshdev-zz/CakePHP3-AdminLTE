<?php
	/*
	 * Sessions used here only because we can't get the PayGate ID, Transaction reference and secret key on the result page.
	 */
	session_name('paygate_payhost_testing_sample');
	session_start();

	include_once('../lib/php/global.inc.php');

	ini_set('display_errors','0');

	$PAY_REQUEST_ID     = $_POST['PAY_REQUEST_ID'];
	$TRANSACTION_STATUS = $_POST['TRANSACTION_STATUS'];
	$CHECKSUM           = $_POST['CHECKSUM'];

	/*
	 * Generate checksum to compare with the checksum returned by PayGate
	 */
	$checksumSource = $_SESSION['pgid'] . $PAY_REQUEST_ID . $TRANSACTION_STATUS . $_SESSION['reference'] . $_SESSION['key'];

	$checksum = md5($checksumSource);

	echo $checksumSource . PHP_EOL;

	echo $checksum;

	session_destroy();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
	    <meta http-equiv="content-type" content="text/html; charset=utf-8">
	    <title>PayHost - Result</title>
	    <link rel="stylesheet" href="../lib/css/bootstrap.min.css">
	    <link rel="stylesheet" href="../lib/css/core.css">
	</head>
	<body>
		<div class="container-fluid" style="min-width: 320px;">
			<nav class="navbar navbar-inverse navbar-fixed-top">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<a class="navbar-brand" href="">
							<img alt="PayGate" src="../lib/images/paygate_logo_mini.png" />
						</a>
						<span style="color: #f4f4f4; font-size: 18px; line-height: 45px; margin-right: 10px;"><strong>PayHost Result</strong></span>
					</div>
				</div>
			</nav>
			<div style="background-color:#80b946; text-align: center; margin-top: 51px; margin-bottom: 15px; padding: 4px;"><strong>Result</strong></div>
	        <div class="container-center">
		        <?php
			        if($checksum != $CHECKSUM){
						$checksumMsg = 'The checksums do not match <i class="glyphicon glyphicon-remove text-danger"></i>';
			        } else {
				        $checksumMsg = 'Checksums match OK <i class="glyphicon glyphicon-ok text-success"></i>';
			        }

			        echo <<<HTML
				<div class="row">
	                <div class="col-xs-12 text-center">
	                    <p>{$checksumMsg}</p>
	                </div>
	            </div>
HTML;
		        ?>
	            <div class="row">
	                <label class="col-sm-3 text-right">Pay Request ID</label>
	                <div class="col-sm-9">
	                    <p><?php echo $PAY_REQUEST_ID; ?></p>
	                </div>
	            </div>
	            <div class="row">
	                <label class="col-sm-3 text-right">Transaction Status</label>
	                <div class="col-sm-9">
	                    <p><?php echo $TRANSACTION_STATUS; ?></p>
	                </div>
	            </div>
	            <div class="row">
	                <label class="col-sm-3 text-right">Checksum</label>
	                <div class="col-sm-9">
	                    <p><?php echo $CHECKSUM; ?></p>
	                </div>
	            </div>
	        </div>
	    </div>
		<script type="text/javascript" src="../lib/js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="../lib/js/bootstrap.min.js"></script>
	</body>
</html>