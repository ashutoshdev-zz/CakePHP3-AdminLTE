<?php
	/*
	 * This is an example page of the form fields required for a PayGate PayVault via PayHost transaction.
	 */
	include_once('../../../lib/php/global.inc.php');

	/*
	 * Include the helper PayHost SOAP class to make building the SOAP message a little easier
	 */
	include_once('../../paygate.payhost_soap.php');

	ini_set('display_errors',1);
	ini_set('default_socket_timeout', 300);

	$result     = '';
	$err        = '';

	if(isset($_POST['btnSubmit'])){

		/*
		 * Create variables based on key names in $_POST
		 */
		extract($_POST, EXTR_OVERWRITE);

		/*
		 * Grab our User Defined fields
		 */
		$i = 1;
		$userDefined = '';

		while($i >= 1){
			if(isset(${'userKey' . $i}) && ${'userKey' . $i} != '' && isset(${'userField' . $i}) && ${'userField' . $i} != ''){

				$userDefined
					.= <<<XML
<ns1:UserDefinedFields>
            <ns1:key>{${'userKey' . $i}}</ns1:key>
            <ns1:value>{${'userField' . $i}}</ns1:value>
        </ns1:UserDefinedFields>
XML;
				$i++;
			} else {
				break;
			}
		}

		/*
		 * Build SOAP to send to PayGate CardVault service
		 */
		$xml = <<<XML
<ns1:SingleVaultRequest>
    <ns1:CardVaultRequest>
        <ns1:Account>
            <ns1:PayGateId>{$payGateId}</ns1:PayGateId>
            <ns1:Password>{$encryptionKey}</ns1:Password>
        </ns1:Account>
        <ns1:CardNumber>{$cardNumber}</ns1:CardNumber>
        <ns1:CardExpiryDate>{$expiryDate}</ns1:CardExpiryDate>
        {$userDefined}
    </ns1:CardVaultRequest>
</ns1:SingleVaultRequest>

XML;

		/**
		 *  disabling WSDL cache
		 */
		ini_set("soap.wsdl_cache_enabled", "0");

		/*
		 * Using PHP SoapClient to handle the request
		 */
		$soapClient = new SoapClient(PayHostSOAP::$process_url."?wsdl", array('trace' => 1)); //point to WSDL and set trace value to debug

		try {
			/*
			 * Send SOAP request
			 */
			$result = $soapClient->__soapCall('SingleVault', array(
				new SoapVar($xml, XSD_ANYXML)
			));
		} catch(SoapFault $sf){
			/*
			 * handle errors
			 */
			$err = $sf->getMessage();
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>PayHost - Card Vault</title>
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
						<span style="color: #f4f4f4; font-size: 18px; line-height: 45px; margin-right: 10px;"><strong>PayHost Card Vault</strong></span>
					</div>
					<div class="collapse navbar-collapse" id="navbar-collapse">
						<ul class="nav navbar-nav">
							<li class="dropdown active">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Card Vault</a>
								<ul class="dropdown-menu" role="menu">
									<li>
										<a href="/<?php echo $root; ?>/PayHost/singleVault/cardVault/index.php">Card Vault</a>
									</li>
									<li>
										<a href="/<?php echo $root; ?>/PayHost/singleVault/cardVault/simple_cardVault.php">Simple Version</a>
									</li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Delete Vault</a>
								<ul class="dropdown-menu" role="menu">
									<li>
										<a href="/<?php echo $root; ?>/PayHost/singleVault/deleteVault/index.php">Delete Vault</a>
									</li>
									<li>
										<a href="/<?php echo $root; ?>/PayHost/singleVault/deleteVault/simple_deleteVault.php">Simple Version</a>
									</li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Lookup Vault</a>
								<ul class="dropdown-menu" role="menu">
									<li>
										<a href="/<?php echo $root; ?>/PayHost/singleVault/lookupVault/index.php">Lookup Vault</a>
									</li>
									<li>
										<a href="/<?php echo $root; ?>/PayHost/singleVault/lookupVault/simple_lookupVault.php">Simple Version</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<div style="background-color:#80b946; text-align: center; margin-top: 51px; margin-bottom: 15px; padding: 4px;"><strong>Card Vault</strong></div>
			<div class="container">
				<form role="form" class="form-horizontal text-left" action="index.php" method="post">
					<div class="form-group">
						<label for="payGateId" class="col-sm-3 control-label">PayGate ID</label>
						<div class="col-sm-5">
							<input class="form-control" type="text" name="payGateId" id="payGateId" value="<?php echo(isset($payGateId) ? $payGateId : '10011072130'); ?>" />
						</div>
					</div>
					<div class="form-group">
						<label for="encryptionKey" class="col-sm-3 control-label">Encryption Key</label>
						<div class="col-sm-5">
							<input class="form-control" type="text" name="encryptionKey" id="encryptionKey" value="<?php echo(isset($encryptionKey) ? $encryptionKey : 'test'); ?>" />
						</div>
					</div>
					<div class="form-group">
						<label for="cardNumber" class="col-sm-3 control-label">Card Number</label>
						<div class="col-sm-5">
							<input class="form-control" type="text" name="cardNumber" id="cardNumber" value="<?php echo(isset($cardNumber) ? $cardNumber : ''); ?>" />
						</div>
					</div>
					<div class="form-group">
						<label for="expiryDate" class="col-sm-3 control-label">Card Expiry Date</label>
						<div class="col-sm-5">
							<input class="form-control" type="text" name="expiryDate" id="expiryDate" value="<?php echo(isset($expiryDate) ? $expiryDate : ''); ?>" placeholder="mmYYYY"/>
						</div>
					</div>
					<?php
						$j = 1;
						while($j >= 1){

							if(isset(${'userKey' . $j})){
								$key   = ${'userKey' . $j};
								$value = ${'userField' . $j};
							} else {
								$key   = '';
								$value = '';
							}

							echo <<<HTML
					<div class="form-group userDefined">
						<label for="userFields" class="col-sm-3 control-label">User Defined</label>
						<div class="col-sm-4">
							<input class="form-control userKey" type="text" name="userKey{$j}" id="userKey{$j}" value="{$key}" placeholder="Key" />
						</div>
						<div class="col-sm-4">
							<input class="form-control userField" type="text" name="userField{$j}" id="userField{$j}" value="{$value}" placeholder="Value" />
						</div>
					</div>
HTML;

							if(isset(${'userKey' . $j}) && ${'userKey' . $j} != '' && isset(${'userField' . $j}) && ${'userField' . $j} != ''){
								$j++;
							} else {
								break;
							}

						} ?>
					<span id="fieldHolder"></span>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-4">
							<button class="btn btn-primary" id="addUserFieldBtn" type="button"><i class="glyphicon glyphicon-plus"></i> Add User Defined Fields</button>
						</div>
					</div>
					<br>
					<div class="form-group">
						<div class=" col-sm-offset-4 col-sm-4">
							<img src="/<?php echo $root; ?>/lib/images/loader.gif" alt="Processing" class="initialHide" id="vaultLoader">
							<input class="btn btn-success btn-block" id="doVaultBtn" type="submit" name="btnSubmit" value="Do Card Vault" />
						</div>
					</div>
					<br>
				</form>
				<?php
					if (isset($_POST['btnSubmit'])) {
						if (!$result) {
							// show exception
							echo <<<HTML
				<div class="row" style="margin-bottom: 15px;">
					<div class="col-sm-offset-2 col-sm-8 alert alert-danger">
						<strong>ERROR: </strong>{$err}
					</div>
				</div>
HTML;
						}
						?>
						<div class="row" style="margin-bottom: 15px;">
							<div class="col-sm-offset-4 col-sm-4">
								<button id="showRequestBtn" class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#requestDiv" aria-expanded="false" aria-controls="requestDiv">
									Request
								</button>
							</div>
						</div>
						<div id="requestDiv" class="row collapse well well-sm">
							<?php
								//Show raw XML request DATA (only shows if 'trace' => 1)
								echo <<<HTML
						<textarea rows="20" cols="100" id="request" class="form-control">{$soapClient->__getLastRequest()}</textarea>
HTML;
							?>
						</div>
						<div class="row" style="margin-bottom: 15px;">
							<div class="col-sm-offset-4 col-sm-4">
								<button id="showResponseBtn" class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#responseDiv" aria-expanded="false" aria-controls="responseDiv">
									Response
								</button>
							</div>
						</div>
						<div id="responseDiv" class="row collapse in well well-sm" >
							<?php  echo <<<HTML
				<textarea rows="20" cols="100" id="response" class="form-control">{$soapClient->__getLastResponse()}</textarea>
HTML;
							?>
						</div>
						<?php
					}
				?>
			</div>
		</div>
		<script type="text/javascript" src="/<?php echo $root; ?>/lib/js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="/<?php echo $root; ?>/lib/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#doAuthBtn').on('click', function(){
					$(this).hide();
					$('#authLoader').show();
				});

				$('#doSubmitBtn').on('click', function(){
					$(this).hide();
					$('#submitLoader').show();
				});

				$('#addUserFieldBtn').on('click', function(){

					var lastUserFieldDiv = $('#fieldHolder').prev('.userDefined');

					var key   = lastUserFieldDiv.find('.userKey');

					var i = parseInt(key.attr('id').replace('userKey', ''));
					i++;

					var newUserFieldsDiv = '<div class="form-group userDefined">' +
						'    <label for="reference" class="col-sm-3 control-label">User Defined</label>' +
						'    <div class="col-sm-4">' +
						'        <input class="form-control userKey" type="text" name="userKey' + i + '" id="userKey' + i + '" value="" placeholder="Key" />' +
						'    </div>' +
						'    <div class="col-sm-4">' +
						'        <input class="form-control userField" type="text" name="userField' + i + '" id="userField' + i + '" value="" placeholder="Value" />' +
						'    </div>' +
						'</div>';

					$('#fieldHolder').before(newUserFieldsDiv);
				});
			});
		</script>
	</body>
</html>