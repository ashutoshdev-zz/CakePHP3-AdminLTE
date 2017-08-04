<?php
	/*
	 * This is an example page of the process required for a PayGate PayHost Card Payment transaction.
	 */
	include_once('../../../lib/php/global.inc.php');

	ini_set('display_errors', 1);
	ini_set('default_socket_timeout', 300);
	$result   = '';
	$err      = '';

	session_name('paygate_payhost_testing_sample');
	session_start();

	if(isset($_POST['btnSubmit'])){

		/*
		 * Create variables based on key names in $_POST
		 */
		extract($_POST,EXTR_OVERWRITE);

		/**
		 *  disabling WSDL cache
		 */
		ini_set("soap.wsdl_cache_enabled", "0");

		/*
		 * Using PHP SoapClient to handle the request
		 */
		$soapClient = new SoapClient('https://secure.paygate.co.za/PayHost/process.trans?wsdl', array('trace' => 1)); //point to WSDL and set trace value to debug

		try{
			/*
			 * Send SOAP request
			 */
			$result = $soapClient->__soapCall('SinglePayment', array(
				new SoapVar($request, XSD_ANYXML)
			));
		} catch(SoapFault $sf){
			/*
			 * handle errors
			 */
			$err = $sf->getMessage();
		}
	} else {

		/*
		 * Change $payGateId and $encryptionKey when needed
		 */
		$payGateId     = '10011072130';
		$encryptionKey = 'test';
		$reference     = generateReference();

		/*
	     * Set the session vars
	     */
		$_SESSION['pgid']      = $payGateId;
		$_SESSION['reference'] = $reference;
		$_SESSION['key']       = $encryptionKey;

		$request = <<<XML
<ns1:SinglePaymentRequest>
	<ns1:CardPaymentRequest>
		<ns1:Account>
			<ns1:PayGateId>{$payGateId}</ns1:PayGateId>
			<ns1:Password>{$encryptionKey}</ns1:Password>
		</ns1:Account>
		<ns1:Customer>
			<!-- Optional: -->
			<ns1:Title>Mr</ns1:Title>
			<ns1:FirstName>PayGate</ns1:FirstName>
			<!-- Optional: -->
			<!-- <ns1:MiddleName>?</ns1:MiddleName> -->
			<ns1:LastName>Test</ns1:LastName>
			<!-- Zero or more repetitions: -->
			<ns1:Telephone>0861234567</ns1:Telephone>
			<!-- Zero or more repetitions: -->
			<ns1:Mobile>0842573344</ns1:Mobile>
			<!-- Zero or more repetitions: -->
			<ns1:Fax>086009991111</ns1:Fax>
			<!-- 1 or more repetitions: -->
			<ns1:Email>itsupport@paygate.co.za</ns1:Email>
		</ns1:Customer>
		<ns1:CardNumber>4000000000000002</ns1:CardNumber>
		<ns1:CardExpiryDate>122016</ns1:CardExpiryDate>
		<!-- 0 or more repetitions: -->
		<!-- <ns1:CardIssueDate>?</ns1:CardIssueDate>  -->
		<ns1:CVV>987</ns1:CVV>
		<ns1:BudgetPeriod>0</ns1:BudgetPeriod>
		<!-- 3D secure redirect object -->
		<ns1:Redirect>
			<ns1:NotifyUrl>{$fullPath['protocol']}{$fullPath['host']}/{$root}/PayHost/notify.php</ns1:NotifyUrl>
			<ns1:ReturnUrl>{$fullPath['protocol']}{$fullPath['host']}/{$root}/PayHost/result.php</ns1:ReturnUrl>
			<!--  <ns1:Target>_self | _parent</ns1:Target>  -->
		</ns1:Redirect>
		<ns1:Order>
			<ns1:MerchantOrderId>{$reference}</ns1:MerchantOrderId>
			<ns1:Currency>ZAR</ns1:Currency>
			<ns1:Amount>12311</ns1:Amount>
			<ns1:OrderItems>
				<ns1:ProductCode>ABC123</ns1:ProductCode>
				<ns1:ProductDescription>Misc Product</ns1:ProductDescription>
				<ns1:ProductCategory>misc</ns1:ProductCategory>
				<ns1:ProductRisk>XX</ns1:ProductRisk>
				<ns1:OrderQuantity>1</ns1:OrderQuantity>
				<ns1:UnitPrice>123.11</ns1:UnitPrice>
				<ns1:Currency>ZAR</ns1:Currency>
			</ns1:OrderItems>
		</ns1:Order>
	</ns1:CardPaymentRequest>
</ns1:SinglePaymentRequest>
XML;

	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>PayHost - CardPayment</title>
		<link rel="stylesheet" href="/<?php echo $root; ?>/lib/css/bootstrap.min.css">
		<link rel="stylesheet" href="/<?php echo $root; ?>/lib/css/core.css">
	</head>
	<body>
		<div class="container-fluid" style="min-width: 320px;">
			<nav class="navbar navbar-inverse navbar-fixed-top">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="">
							<img alt="PayGate" src="/<?php echo $root; ?>/lib/images/paygate_logo_mini.png" />
						</a>
						<span style="color: #f4f4f4; font-size: 18px; line-height: 45px; margin-right: 10px;"><strong>PayHost Card Payment</strong></span>
					</div>
					<div class="collapse navbar-collapse" id="navbar-collapse">
						<ul class="nav navbar-nav">
							<li class="active">
								<a href="/<?php echo $root; ?>/PayHost/singlePayment/cardPayment/index.php">Initiate</a>
							</li>
							<li>
								<a href="/<?php echo $root; ?>/PayHost/singleFollowUp/query.php">Query</a>
							</li>
							<li>
								<a href="/<?php echo $root; ?>/PayHost/singlePayment/cardPayment/simple_initiate.php">Simple initiate</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<div style="background-color:#80b946; text-align: center; margin-top: 51px; margin-bottom: 15px; padding: 4px;"><strong>Initiate CardPayment</strong></div>
			<div class="container">
				<form role="form" class="form-horizontal text-left" action="index.php" method="post">
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-4">
							<button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#requestDiv" aria-expanded="false" aria-controls="requestDiv">
								Request
							</button>
						</div>
					</div>
					<div id="requestDiv" class="collapse well well-sm">
						<div class="form-group">
							<div class="col-sm-12">
								<label for="request" class="col-sm-2 sr-only">Request</label>
								<textarea name="request" cols="130" rows="45" id="request" class="form-control">
<?php echo $request; ?>
								</textarea>
							</div>
						</div>
					</div>
					<br>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-4">
							<img src="/<?php echo $root; ?>/lib/images/loader.gif" alt="Processing" class="initialHide" id="authLoader">
							<input class="btn btn-success btn-block" id="doAuthBtn" type="submit" name="btnSubmit" value="Do Auth" />
						</div>
					</div>
					<br>
					<?php if(isset($_POST['btnSubmit'])){ ?>
						<div class="form-group">
							<div class="col-sm-offset-4 col-sm-4">
								<button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#responseDiv" aria-expanded="false" aria-controls="responseDiv">
									Response
								</button>
							</div>
						</div>
						<div id="responseDiv" class="collapse in well well-sm">
							<div class="form-group">
								<div class="col-sm-12">
									<label for="response" class="col-sm-3 sr-only">Response</label>
									<?php
										/*
										 * Show raw XML response DATA (only shows if 'trace' => 1)
										 */
										echo <<<HTML
									<textarea class="form-control" rows="20" cols="100" id="response">{$soapClient->__getLastResponse()}</textarea>
HTML;
									?>
								</div>
							</div>
						</div>
					<?php } ?>
				</form>
<?php
	if(isset($_POST['btnSubmit'])){
		if(!$err){
			/*
			 * SOAP request has gone through without errors
			 */
			if(array_key_exists('Redirect', $result->CardPaymentResponse)){
				/*
				 * A redirect response was received from PayGate
				 * so create form from returned data for redirect
				 *
				 * In the case of this sample, an iframe is used and then
				 * targeted by the created form, but a standard redirect can also be done.
				 */
				?>
				<div class="row">
					<div class="col-sm-offset-4 col-sm-4">
						<button id="showRedirectBtn" class="btn btn-warning btn-block" type="button" data-toggle="collapse" data-target="#redirectDiv" aria-expanded="false" aria-controls="redirectDiv">
							Redirect Required
						</button>
					</div>
				</div>
				<br>
				<div id="redirectDiv" class="collapse well well-sm">
					<div class="row ">
						<div class="col-sm-12">
							<label for="response" class="col-sm-3 sr-only">Redirect</label>
							<?php echo <<<HTML
							<textarea class="form-control" rows="20" cols="100" id="redirect">
<!-- form action passed back from WS -->
<form action="{$result->CardPaymentResponse->Redirect->RedirectUrl}" method="post">

HTML;
								foreach($result->CardPaymentResponse->Redirect->UrlParams as $url){
									echo <<<HTML
	<input type="hidden" name="{$url->key}" value="{$url->value}" />

HTML;
								}

								echo <<<HTML
	<input type="submit" name="submitBtn" value="Do Redirect" />
</form>
							</textarea>
HTML;
							?>
						</div>
					</div>
				</div>
				<form role="form" class="form-horizontal text-left" action="<?php echo $result->CardPaymentResponse->Redirect->RedirectUrl; ?>" method="post" target="iframetest">
					<?php foreach($result->CardPaymentResponse->Redirect->UrlParams as $url){ ?>
						<input type="hidden" name="<?php echo $url->key; ?>" value="<?php echo $url->value; ?>"/>
					<?php } ?>
					<br>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-4">
							<img src="/<?php echo $root; ?>/lib/images/loader.gif" alt="Processing" class="initialHide" id="submitLoader">
							<input class="btn btn-success btn-block" type="submit" name="submitBtn" id="doSubmitBtn" value="submit" data-toggle="modal" data-target="#authModal" />
						</div>
					</div>
					<br>
				</form>

				<!-- Modal to house the iframe we use for 3D Secure authentication if returned from PayHost -->
				<div class="modal fade" id="authModal" tabindex="-1" role="dialog" aria-labelledby="3DAuthModal" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">3D Authentication</h4>
							</div>
							<div class="modal-body">
								<iframe name="iframetest" id="iframetest" src="<?php echo $result->CardPaymentResponse->Redirect->RedirectUrl; ?>" height="550" width="100%" frameborder="0" scrolling="auto"></iframe>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
		}
	}?>
			</div>
		</div>
		<script type="text/javascript" src="/<?php echo $root; ?>/lib/js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="/<?php echo $root; ?>/lib/js/bootstrap.min.js"></script>
	</body>
</html>