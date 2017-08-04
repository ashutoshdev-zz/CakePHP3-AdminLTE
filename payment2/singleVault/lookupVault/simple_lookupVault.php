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
		 * Build SOAP to send to PayGate LookupVault service
		 */
		$xml = <<<XML
<ns1:SingleVaultRequest>
    <ns1:LookUpVaultRequest>
        <ns1:Account>
            <ns1:PayGateId>{$payGateId}</ns1:PayGateId>
            <ns1:Password>{$encryptionKey}</ns1:Password>
        </ns1:Account>
        <ns1:VaultId>{$vaultId}</ns1:VaultId>
        {$userDefined}
    </ns1:LookUpVaultRequest>
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
<html>
	<head>
		<title>PayHost - Lookup Vault</title>
		<style type="text/css">
			label {
				margin-top: 5px;
				display: inline-block;
				width: 150px;
			}
		</style>
	</head>
	<body>
		<a href="/<?php echo $root; ?>/PayHost/singleVault/deleteVault/index.php">Back to Lookup Vault</a>
		<br>
		<form role="form" class="form-horizontal text-left" action="simple_lookupVault.php" method="post">
			<label for="payGateId">PayGate ID</label>
			<input type="text" name="payGateId" id="payGateId" value="<?php echo(isset($payGateId) ? $payGateId : '10011072130'); ?>" />
			<br>
			<label for="encryptionKey" class="col-sm-3 control-label">Encryption Key</label>
			<input class="form-control" type="text" name="encryptionKey" id="encryptionKey" value="<?php echo(isset($encryptionKey) ? $encryptionKey : 'test'); ?>" />
			<br>
			<label for="vaultId" class="col-sm-3 control-label">Vault ID</label>
			<input class="form-control" type="text" name="vaultId" id="vaultId" value="<?php echo(isset($vaultId) ? $vaultId : ''); ?>" />
			<br>
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
			<div class="userDefined">
				<label for="userFields">User Defined</label>
				<input type="text" name="userKey{$j}" id="userKey{$j}" class="userKey" value="{$key}" placeholder="Key" />
				<input type="text" name="userField{$j}" id="userField{$j}" class="userField" value="{$value}" placeholder="Value" />
			</div>

HTML;
					if(isset(${'userKey' . $j}) && ${'userKey' . $j} != '' && isset(${'userField' . $j}) && ${'userField' . $j} != ''){
						$j++;
					} else {
						break;
					}

				} ?>
			<span id="fieldHolder"></span>
			<br>
			<button id="addUserFieldBtn" type="button">Add User Defined Fields</button>
			<br>
			<br>
			<input id="doVaultBtn" type="submit" name="btnSubmit" value="Do Lookup Vault" />
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
		<script type="text/javascript" src="/<?php echo $root; ?>/lib/js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#addUserFieldBtn').on('click', function(){

					var fieldHolder = $('#fieldHolder'),
					    lastUserFieldDiv = fieldHolder.prev('.userDefined'),
					    key = lastUserFieldDiv.find('.userKey'),
					    i = parseInt(key.attr('id').replace('userKey', ''));

					i++;

					var newUserFieldsDiv = '<div class="userDefined">' +
						'    <label for="reference">User Defined</label>' +
						'    <input class="userKey" type="text" name="userKey' + i + '" id="userKey' + i + '" value="" placeholder="Key" />' +
						'    <input class="userField" type="text" name="userField' + i + '" id="userField' + i + '" value="" placeholder="Value" />' +
						'</div>';

					fieldHolder.before(newUserFieldsDiv);
				});
			});
		</script>
	</body>
</html>