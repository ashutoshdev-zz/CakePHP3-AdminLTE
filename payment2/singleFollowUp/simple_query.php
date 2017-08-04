<?php
	/*
	 * This is an example page of the form fields required for a PayGate PayWeb 3 transaction.
	 */
	include_once('../../lib/php/global.inc.php');

	/*
	 * Include the helper PayHost SOAP class to make building the SOAP message a little easier
	 */
	include_once('../paygate.payhost_soap.php');

	ini_set('display_errors',1);
	ini_set('default_socket_timeout', 300);

	$result     = '';
	$err        = '';
	$identifier = 'payrequestid';

	if(isset($_POST['btnSubmit'])){

		/*
		 * Create variables based on key names in $_POST
		 */
		extract($_POST, EXTR_OVERWRITE);


		/*
		 * Build SOAP to send to PayGate Query service
		 */

		if ($identifier == 'payrequestid'){
			//If Pay Request ID is used
			$xmlQuery = '<ns1:PayRequestId>'.$payRequestId.'</ns1:PayRequestId>';
		} else if ($identifier == 'transid'){
			//If Transaction ID is used
			$xmlQuery = '<ns1:TransactionId>'.$transId.'</ns1:TransactionId>';
		} else if ($identifier == 'reference'){
			//If Transaction ID is used
			$xmlQuery = '<ns1:MerchantOrderId>'.$reference.'</ns1:MerchantOrderId>';
		}

		$xml = <<<XML
<ns1:SingleFollowUpRequest>
	<ns1:QueryRequest>
		<ns1:Account>
			<ns1:PayGateId>{$payGateId}</ns1:PayGateId>
			<ns1:Password>{$encryptionKey}</ns1:Password>
		</ns1:Account>
		{$xmlQuery}
	</ns1:QueryRequest>
</ns1:SingleFollowUpRequest>

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
			$result = $soapClient->__soapCall('SingleFollowUp', array(
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
<html>
	<head>
		<title>PayHost - Query</title>
		<style type="text/css">
			label {
				margin-top: 5px;
				display: inline-block;
				width: 150px;
			}
		</style>
	</head>
	<body>
		<a href="/<?php echo $root; ?>/PayHost/singleFollowUp/query.php">Back to Query</a>
		<br>
		<form role="form" class="form-horizontal text-left" action="simple_query.php" method="post">
			<label for="payGateId">PayGate ID</label>
			<input type="text" name="payGateId" id="payGateId" value="<?php echo(isset($payGateId) ? $payGateId : '10011072130'); ?>" />
			<br>
			<label for="encryptionKey" class="col-sm-3 control-label">Encryption Key</label>
			<input class="form-control" type="text" name="encryptionKey" id="encryptionKey" value="<?php echo(isset($encryptionKey) ? $encryptionKey : 'test'); ?>" />
			<br>
			<label for="payrequestidChk" class="sr-only">Use Pay Request ID</label>
			<input name="identifier" id="payrequestidChk" value="payrequestid" type="radio" aria-label="Pay Request ID Checkbox" <?php echo(isset($identifier) && $identifier == 'payrequestid' ? 'checked="checked"' : ''); ?>>
			<br>
			<label for="transidChk" class="sr-only">Use Transaction ID</label>
			<input name="identifier" id="transidChk" value="transid" type="radio" aria-label="Transaction ID Checkbox" <?php echo(isset($identifier) && $identifier == 'transid' ? 'checked="checked"' : ''); ?>>
			<br>
			<label for="referenceChk" class="sr-only">Use Reference</label>
			<input name="identifier" id="referenceChk" value="reference" type="radio" aria-label="Reference Checkbox" <?php echo((isset($identifier) && $identifier == 'reference') || !isset($identifier) ? 'checked="checked"' : ''); ?> />
			<br>
			<label for="payRequestId" class="col-sm-3 control-label">Pay Request ID</label>
			<input type="text" name="payRequestId" id="payRequestId" class="form-control" aria-label="Pay Request ID Input" value="<?php echo(isset($payRequestId ) ? $payRequestId  : ''); ?>" />
			<br>
			<label for="transId" class="col-sm-3 control-label">Transaction ID</label>
			<input type="text" name="transId" id="transId" class="form-control" aria-label="Transaction ID Input" value="<?php echo(isset($transId) ? $transId : ''); ?>" />
			<br>
			<label for="reference" class="col-sm-3 control-label">Reference</label>
			<input type="text" name="reference" id="reference" class="form-control" aria-label="Reference Input" value="<?php echo(isset($reference) ? $reference : ''); ?>">
			<br>
			<input id="doQueryBtn" type="submit" name="btnSubmit" value="Do Query" />
		</form>
		<?php
			if (isset($_POST['btnSubmit'])){
				if(!$result){
					// show exception
					echo <<<HTML
		<strong>ERROR: </strong>{$err}<br>
HTML;
				}
			            //Show raw XML request DATA (only shows if 'trace' => 1)
	            echo <<<HTML
        <label style="vertical-align: top;" for="request">REQUEST:</label>
		<textarea rows="20" cols="100" id="request">{$soapClient->__getLastRequest()}</textarea><br>
HTML;

				echo <<<HTML
		<label style="vertical-align: top;" for="response">RESPONSE:</label>
		<textarea rows="20" cols="100" id="response" >{$soapClient->__getLastResponse()}</textarea>
HTML;

			}
		?>
	</body>
</html>