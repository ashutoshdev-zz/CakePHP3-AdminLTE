<?php
	/*
	 * This is an example page of the form fields required for a PayGate PayHost transaction.
	 */
	include_once('../lib/php/global.inc.php');

	/*
	 * Include the helper PayHost SOAP class to make building the SOAP message a little easier
	 */
	include_once('paygate.payhost_soap.php');

	ini_set('display_errors',1);
	ini_set('default_socket_timeout', 300);

	$result    = '';
	$err       = '';

	/*
	 * Include Billing & Customer Address by default
	 */
	$incBilling  = 'incBilling';
	$incCustomer = 'incCustomer';

	if(isset($_POST['btnSubmit'])){

		session_name('paygate_payhost_testing_sample');
		session_start();

		/*
	     * Initiate the PAyHost SOAP helper class
	     */
		$payHostSoap = new PayHostSOAP($_POST);

		/*
		 * Generate SOAP from the input vars
		 */
		$xml = $payHostSoap->getSOAP();

		/*
		 * Create variables based on key names in $_POST
		 */
		extract($_POST,EXTR_OVERWRITE);

		/*
	     * Set the session vars
	     */
		$_SESSION['pgid']      = $pgid;
		$_SESSION['reference'] = $reference;
		$_SESSION['key']       = $encryptionKey;

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
			$result = $soapClient->__soapCall('SinglePayment', array(
				new SoapVar($xml, XSD_ANYXML)
			));
		} catch (SoapFault $sf){
			/*
			 * handle errors
			 */
			$err = $sf->getMessage();
		}
	} else {
		session_name('paygate_payhost_testing_sample');
		session_start();
		session_destroy();
	}
?>
<html>
	<head>
		<title>PayHost - Initiate</title>
		<style type="text/css">
			label {
				margin-top: 5px;
				display: inline-block;
				width: 150px;
			}
		</style>
	</head>
	<body>
	<a href="/<?php echo $root; ?>/PayHost/singlePayment/webPayment/index.php">back to Initiate</a><br>
		<form action="simple_initiate.php" method="post">
			<label for="pgid">PayGate ID</label>
			<input type="text" name="pgid" id="pgid" value="<?php echo(isset($pgid) ? $pgid : PayHostSOAP::$DEFAULT_PGID); ?>" />
			<br>
			<label for="reference">Reference</label>
			<input type="text" name="reference" id="reference" value="<?php echo(isset($reference) ? $reference : generateReference()); ?>"/>
			<br>
			<label for="amount">Amount</label>
			<input type="text" name="amount" id="amount" value="<?php echo(isset($amount) ? $amount : PayHostSOAP::$DEFAULT_AMOUNT); ?>"/>
			<br>
			<label for="currency">Currency</label>
			<input type="text" name="currency" id="currency" value="<?php echo(isset($currency) ? $currency : PayHostSOAP::$DEFAULT_CURRENCY); ?>"/>
			<br>
			<label for="transDate">Transaction Date</label>
			<input type="text" name="transDate" id="transDate" value="<?php echo(isset($transDate) ? $transDate : getDateTime('Y-m-d\TH:i:s')); ?>"/>
			<br>
			<label for="locale">Locale</label>
			<input type="text" name="locale" id="locale" value="<?php echo(isset($locale) ? $locale : PayHostSOAP::$DEFAULT_LOCALE); ?>"/>
			<br>
			<label for="encryptionKey">Encryption Key</label>
			<input type="text" name="encryptionKey" id="encryptionKey" value="<?php echo(isset($encryptionKey) ? $encryptionKey : PayHostSOAP::$DEFAULT_ENCRYPTION_KEY); ?>" />
			<br>
			<h3>Paymethod and User Fields</h3>
			<label for="payMethod">Pay Method</label>
			<input type="text" name="payMethod" id="payMethod" value="<?php echo(isset($payMethod) ? $payMethod : ''); ?>" placeholder="optional" />
			<br>
			<label for="payMethodDetail">Pay Method Detail</label>
			<input type="text" name="payMethodDetail" id="payMethodDetail" value="<?php echo(isset($payMethodDetail) ? $payMethodDetail : ''); ?>" placeholder="optional" />
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
			<h3>Customer Details</h3>
			<label for="customerTitle">Title</label>
			<input type="text" name="customerTitle" id="customerTitle" value="<?php echo(isset($customerTitle) ? $customerTitle : PayHostSOAP::$DEFAULT_TITLE); ?>" placeholder="optional" />
			<br>
			<label for="firstName">First Name</label>
			<input type="text" name="firstName" id="firstName" value="<?php echo(isset($firstName) ? $firstName : PayHostSOAP::$DEFAULT_FIRST_NAME); ?>" placeholder="optional" />
			<br>
			<label for="middleName">Middle Name</label>
			<input type="text" name="middleName" id="middleName" value="<?php echo(isset($middleName) ? $middleName : ''); ?>" placeholder="optional" />
			<br>
			<label for="lastName">Last Name</label>
			<input type="text" name="lastName" id="lastName" value="<?php echo(isset($lastName) ? $lastName : PayHostSOAP::$DEFAULT_LAST_NAME); ?>" placeholder="optional" />
			<br>
			<label for="telephone">Telephone</label>
			<input type="text" name="telephone" id="telephone" value="<?php echo(isset($telephone) ? $telephone : ''); ?>" placeholder="optional" />
			<br>
			<label for="mobile">Mobile</label>
			<input type="text" name="mobile" id="mobile" value="<?php echo(isset($mobile) ? $mobile : ''); ?>" placeholder="optional" />
			<br>
			<label for="fax">Fax</label>
			<input type="text" name="fax" id="fax" value="<?php echo(isset($fax) ? $fax : ''); ?>" placeholder="optional" />
			<br>
			<label for="email">Email</label>
			<input type="text" name="email" id="email" value="<?php echo(isset($email) ? $email : PayHostSOAP::$DEFAULT_EMAIL); ?>" placeholder="optional" />
			<br>
			<label for="dateOfBirth">Date Of Birth</label>
			<input name="dateOfBirth" id="dateOfBirth" value="<?php echo(isset($dateOfBirth) ? $dateOfBirth : ''); ?>" placeholder="optional" />
			<br>
			<label for="socialSecurity">Social Security</label>
			<input name="socialSecurity" id="socialSecurity" value="<?php echo(isset($socialSecurity) ? $socialSecurity : ''); ?>" placeholder="optional" />
			<br>
			<h3>Risk Fields</h3>
			<label for="riskAccNum">Account Number</label>
			<input type="text" name="riskAccNum" id="riskAccNum" value="<?php echo(isset($riskAccNum) ? $riskAccNum : ''); ?>" placeholder="optional" />
			<br>
			<label for="riskIpAddr">Ip Address</label>
			<input type="text" name="riskIpAddr" id="riskIpAddr" value="<?php echo(isset($riskIpAddr) ? $riskIpAddr : ''); ?>" placeholder="optional" />
			<br>
			<h3>Shipping Fields</h3>
			<label for="deliveryDate">Delivery Date</label>
			<input type="text" name="deliveryDate" id="deliveryDate" value="<?php echo(isset($deliveryDate) ? $deliveryDate : ''); ?>" placeholder="optional" />
			<br>
			<label for="deliveryMethod">Delivery Method</label>
			<input type="text" name="deliveryMethod" id="deliveryMethod" value="<?php echo(isset($deliveryMethod) ? $deliveryMethod : ''); ?>" placeholder="optional" />
			<br>
			<label for="installRequired">Installation Required</label>
			<input type="checkbox" name="installRequired" id="installRequired" value="true" <?php echo (isset($installRequired) && $installRequired == 'true'? 'checked="checked"': ''); ?> />
			<br>
			<h3>Address Fields</h3>
			<label for="incCustomer">Customer</label>
			<input name="incCustomer" id="incCustomer" type="checkbox" value="incCustomer" <?php echo (isset($incCustomer) && $incCustomer == 'incCustomer'?'checked="checked"':'' ); ?> />
			<br>
			<label for="incBilling">Billing</label>
			<input name="incBilling" id="incBilling" type="checkbox" value="incBilling" <?php echo (isset($incBilling) && $incBilling == 'incBilling'?'checked="checked"':'' ); ?> />
			<br>
			<label for="incShipping">Shipping</label>
			<input name="incShipping" id="incShipping" type="checkbox" value="incShipping" <?php echo (isset($incShipping) && $incShipping == 'incShipping'?'checked="checked"':'' ); ?> />
			<br>
			<label for="addressLine1">Address Line 1</label>
			<input type="text" name="addressLine1" id="addressLine1" value="<?php echo(isset($addressLine1) ? $addressLine1 : ''); ?>" placeholder="optional" />
			<br>
			<label for="addressLine2">Address Line 2</label>
			<input type="text" name="addressLine2" id="addressLine2" value="<?php echo(isset($addressLine2) ? $addressLine2 : ''); ?>" placeholder="optional" />
			<br>
			<label for="addressLine3">Address Line 3</label>
			<input type="text" name="addressLine3" id="addressLine3" value="<?php echo(isset($addressLine3) ? $addressLine3 : ''); ?>" placeholder="optional" />
			<br>
			<label for="zip">Zip</label>
			<input type="text" name="zip" id="zip" value="<?php echo(isset($zip) ? $zip : ''); ?>" placeholder="optional" />
			<br>
			<label for="city">City</label>
			<input type="text" name="city" id="city" value="<?php echo(isset($city) ? $city : ''); ?>" placeholder="optional" />
			<br>
			<label for="state">State</label>
			<input type="text" name="state" id="state" value="<?php echo(isset($state) ? $state : ''); ?>" placeholder="optional" />
			<br>
			<label for="country">Country</label>
			<select name="country" id="country">
				<?php echo generateCountrySelectOptions(isset($country) ? $country : PayHostSOAP::$DEFAULT_COUNTRY); ?>
			</select>
			<br>
			<h3>Redirect Fields</h3>
			<label for="retUrl">Return URL</label>
			<input type="text" name="retUrl" id="retUrl" value="<?php echo(isset($retUrl) ? $retUrl : $fullPath['protocol'] . $fullPath['host'] . '/' . $root . '/PayHost/result.php'); ?>" />
			<br>
			<label for="notifyURL">Notify URL</label>
			<input type="text" name="notifyURL" id="notifyURL" value="<?php echo(isset($notifyURL) ? $notifyURL :''); ?>" />
			<br>
			<label for="target">Target</label>
			<input type="text" name="target" id="target" value="<?php echo(isset($target) ? $target : ''); ?>" />
			<br>
			<h3>Airline Fields</h3>
			<label for="ticketNumber">Ticket Number</label>
			<input type="text" name="ticketNumber" id="ticketNumber" value="<?php echo(isset($ticketNumber) ? $ticketNumber : ''); ?>" />
			<br>
			<label for="PNR">PNR</label>
			<input type="text" name="PNR" id="PNR" value="<?php echo(isset($PNR) ? $PNR : ''); ?>" />
			<br>
			<h4>Passenger</h4>
			<label for="travellerType">Traveller Type</label>
			<select name="travellerType" id="travellerType">
				<option value="A" <?php echo(isset($travellerType) && $travellerType == 'A' ? 'selected' : ''); ?>>Adult</option>
				<option value="C" <?php echo(isset($travellerType) && $travellerType == 'C' ? 'selected' : ''); ?>>Child</option>
				<option value="T" <?php echo(isset($travellerType) && $travellerType == 'T' ? 'selected' : ''); ?>>Teenager</option>
				<option value="I" <?php echo(isset($travellerType) && $travellerType == 'I' ? 'selected' : ''); ?>>Infant</option>
			</select>
			<br>
			<h4>Flight Details</h4>
			<label for="departureAirport">Departure Airport</label>
			<input type="text" name="departureAirport" id="departureAirport" value="<?php echo(isset($departureAirport) ? $departureAirport : ''); ?>" placeholder="eg:ABC" />
			<br>
			<label for="departureCountry">Departure Country</label>
			<input type="text" name="departureCountry" id="departureCountry" value="<?php echo(isset($departureCountry) ? $departureCountry : ''); ?>" placeholder="eg:ABC" />
			<br>
			<label for="departureCity">Departure City</label>
			<input type="text" name="departureCity" id="departureCity" value="<?php echo(isset($departureCity) ? $departureCity : ''); ?>" placeholder="eg:ABC" />
			<br>
			<label for="departureDateTime">Departure Date & Time</label>
			<input type="text" name="departureDateTime" id="departureDateTime" value="<?php echo(isset($departureDateTime) ? $departureDateTime : ''); ?>"  placeholder="eg:2015-01-01T12:00:00" />
			<br>
			<label for="arrivalAirport">Arrival Airport</label>
			<input type="text" name="arrivalAirport" id="arrivalAirport" value="<?php echo(isset($arrivalAirport) ? $arrivalAirport : ''); ?>" placeholder="eg:ABC" />
			<br>
			<label for="arrivalCountry">Arrival Country</label>
			<input type="text" name="arrivalCountry" id="arrivalCountry" value="<?php echo(isset($arrivalCountry) ? $arrivalCountry : ''); ?>" placeholder="eg:ABC" />
			<br>
			<label for="arrivalCity">Arrival City</label>
			<input type="text" name="arrivalCity" id="arrivalCity" value="<?php echo(isset($arrivalCity) ? $arrivalCity : ''); ?>" placeholder="eg:ABC" />
			<br>
			<label for="arrivalDateTime">Arrival Date & Time</label>
			<input type="text" name="arrivalDateTime" id="arrivalDateTime" value="<?php echo(isset($arrivalDateTime) ? $arrivalDateTime : ''); ?>" placeholder="eg:2015-01-01T12:00:00" />
			<br>
			<label for="marketingCarrierCode">Marketing Carrier Code</label>
			<input type="text" name="marketingCarrierCode" id="marketingCarrierCode" value="<?php echo(isset($marketingCarrierCode) ? $marketingCarrierCode : ''); ?>" />
			<br>
			<label for="marketingCarrierName">Marketing Carrier Name</label>
			<input type="text" name="marketingCarrierName" id="marketingCarrierName" value="<?php echo(isset($marketingCarrierName) ? $marketingCarrierName : ''); ?>" />
			<br>
			<label for="issuingCarrierCode">Issuing Carrier Code</label>
			<input type="text" name="issuingCarrierCode" id="issuingCarrierCode" value="<?php echo(isset($issuingCarrierCode) ? $issuingCarrierCode : ''); ?>" />
			<br>
			<label for="issuingCarrierName">Issuing Carrier Name</label>
			<input type="text" name="issuingCarrierName" id="issuingCarrierName" value="<?php echo(isset($issuingCarrierName) ? $issuingCarrierName : ''); ?>" />
			<br>
			<label for="flightNumber">Flight Number</label>
			<input type="text" name="flightNumber" id="flightNumber" value="<?php echo(isset($flightNumber) ? $flightNumber : ''); ?>" />
			<br>
			<input id="doAuthBtn" type="submit" name="btnSubmit" value="Do Auth" />
			<br>
		</form>
	<?php
		if (isset($_POST['btnSubmit'])) {

			//Show raw XML request DATA (only shows if 'trace' => 1)
			echo <<<HTML
		<label for="request" style="vertical-align: top;">REQUEST:</label>
		<textarea rows="20" cols="100" id="request">{$soapClient->__getLastRequest()}</textarea>
		<br>
HTML;
			echo <<<HTML
		<label for="response" style="vertical-align: top;">RESPONSE:</label>
		<textarea rows="20" cols="100" id="response">{$soapClient->__getLastResponse()}</textarea>
		<br>
HTML;

			if (!$err){
				/*
				 * SOAP request has gone through without errors
				 */
				if (array_key_exists('Redirect', $result->WebPaymentResponse)){
					/*
					 * A redirect response was received from PayGate
					 */

					echo <<<HTML
		<label style="vertical-align: top;" for="redirect">REDIRECT:</label>
		<textarea rows="20" cols="100" id="redirect">
<!-- form action passed back from WS -->
<form action="{$result->WebPaymentResponse->Redirect->RedirectUrl}" method="post">

HTML;
					foreach($result->WebPaymentResponse->Redirect->UrlParams as $url){
						/*
						 * Generate hidden inputs from the WebPaymentResponse
						 * (TextArea for display example purposes only)
						 */
						echo <<<HTML
    <input type="hidden" name="{$url->key}" value="{$url->value}" />

HTML;
					}

					echo <<<HTML
    <input type="submit" name="submitBtn" value="submit" />
</form>
        </textarea>
        <br>
HTML;
					?>
		<form action="<?php echo $result->WebPaymentResponse->Redirect->RedirectUrl; ?>" method="post">
			<?php foreach ( $result->WebPaymentResponse->Redirect->UrlParams as $url) {
				/*
				 * Generate hidden inputs from the WebPaymentResponse
				 * (Actual form to redirect with)
				 */

				echo <<<HTML
			<input type="hidden" name="{$url->key}" value="{$url->value}" />
HTML;
			} ?>
			<br>
			<input type="submit" name="submitBtn" id="doSubmitBtn" value="submit" />
			<br>
		</form>
		<?php
				}
			}
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