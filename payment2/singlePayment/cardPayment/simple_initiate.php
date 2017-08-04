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
<html>
	<head>
		<title>PayHost - CardPayment</title>
		<style type="text/css">
			label {
				margin-top: 5px;
				display: inline-block;
				width: 150px;
			}
		</style>
	</head>
	<body>
		<a href="/<?php echo $root; ?>/PayHost/singlePayment/cardPayment/index.php">back to Initiate</a>
		<form action="simple_initiate.php" method="post">
			<label style="vertical-align: top;" for="request">Request</label>
			<textarea name="request" cols="130" rows="45" id="request">
<?php echo $request; ?>
			</textarea>
			<br>
			<input id="doAuthBtn" type="submit" name="btnSubmit" value="Do Auth" />
			<br>
			<?php if(isset($_POST['btnSubmit'])){ ?>
			<label style="vertical-align: top;" for="response">Response</label>
			<?php
				/*
				 * Show raw XML response DATA (only shows if 'trace' => 1)
				 */
				echo <<<HTML
			<textarea rows="20" cols="100" id="response">{$soapClient->__getLastResponse()}</textarea>
HTML;
			} ?>
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

						echo <<<HTML
		<form role="form" action="{$result->CardPaymentResponse->Redirect->RedirectUrl}" method="post" target="iframetest">
HTML;
						foreach($result->CardPaymentResponse->Redirect->UrlParams as $url){
							echo <<<HTML
			<input type="hidden" name="{$url->key}" value="{$url->value}"/>
HTML;
						}

						echo <<<HTML
			<br>
			<input type="submit" name="submitBtn" id="doSubmitBtn" value="Do Redirect" />
			<br>
		</form>

		<iframe name="iframetest" id="iframetest" src="{$result->CardPaymentResponse->Redirect->RedirectUrl}" height="550" width="100%" frameborder="0" scrolling="auto"></iframe>
HTML;
					}
				}
			}
		?>
	</body>
</html>