<?php
/*if (isset($_SERVER['HTTP_ORIGIN'])) {
header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400'); // cache for 1 day
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
exit(0);
}
$postdata = file_get_contents("php://input");
print_r($postdata); */ ?>
 
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<?php
error_reporting(0);
$servername = "localhost";
$username = "plaitco_plait";
$password = "Mydbisstrong4real";
// Create connection
$conn = mysql_connect($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
mysql_select_db('plaitco_plait');
/*
 * This is an example page of the form fields required for a PayGate PayHost Web Payment transaction.
 */
include_once('../lib/php/global.inc.php');

/*
 * Include the helper PayHost SOAP class to make building the SOAP message a little easier
 */
include_once('paygate.payhost_soap.php');

ini_set('display_errors', 1);
ini_set('default_socket_timeout', 300);

$result = '';
$err = '';

/*
 * Include Billing & Customer Address by default
 */
$incBilling = 'incBilling';
$incCustomer = 'incCustomer';

if (isset($_REQUEST['btnSubmit'])) {
    session_name('paygate_payhost_testing_sample');
    session_start();
    /*
     * Initiate the PAyHost SOAP helper class
     */
    $payHostSoap = new PayHostSOAP($_REQUEST);

    /*
     * Generate SOAP from the input vars
     */
    $xml = $payHostSoap->getSOAP();

    /*
     * Create variables based on key names in $_REQUEST
     */
    extract($_REQUEST, EXTR_OVERWRITE);

    /*
     * Set the session vars
     */
    $_SESSION['pgid'] = $pgid;
    $_SESSION['reference'] = $reference;
    $_SESSION['key'] = $encryptionKey;

    /**
     *  disabling WSDL cache
     */
    ini_set("soap.wsdl_cache_enabled", "0");

    /*
     * Using PHP SoapClient to handle the request
     */
    $soapClient = new SoapClient(PayHostSOAP::$process_url . "?wsdl", array('trace' => 1)); //point to WSDL and set trace value to debug

    try {
        /*
         * Send SOAP request
         */
        $result = $soapClient->__soapCall('SinglePayment', array(
            new SoapVar($xml, XSD_ANYXML)
        ));
    } catch (SoapFault $sf) {
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

$sql = "SELECT * FROM `carts` WHERE id='".$_REQUEST['cart_id']."'";
$retval = mysql_query($sql, $conn);
$ftchdata=mysql_fetch_array($retval);
 $amount=$ftchdata['subtotal'].'00';

if($_REQUEST['sendit']){
$_REQUEST['sendit']=0;
?>

<style>
    
.loader_boxed {
    width: 41%;
    height: 223px;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    margin: auto;
    text-align: center;
}
.loader_boxed {
    color: #ff0000;
}
</style>
<div class="loader_boxed">
<h4>You will be redirected to the payment gateway. Please do not click on the Refresh button of your
browser OR the F5 button on your keyboard. Doing so may result in transaction failure.</h4>
<div ><img width="50px" src="loading.gif"  /></div>
</div>

<form role="form" class="form-horizontal text-left" action="index.php" method="post" id="paymentfrom">
    <input  style="display: none;" class="form-control" type="text" name="pgid" id="pgid" value="<?php echo(isset($pgid) ? $pgid : PayHostSOAP::$DEFAULT_PGID); ?>" />
    <input style="display: none;" class="form-control" type="text" name="reference" id="reference" value="<?php echo(isset($reference) ? $reference : generateReference()); ?>"/>
    <input style="display: none;" class="form-control" type="text" name="amount" id="amount" value="<?php echo(isset($amount) ? $amount : PayHostSOAP::$DEFAULT_AMOUNT); ?>"/>
    <input style="display: none;" class="form-control" type="text" name="transDate" id="transDate" value="<?php echo(isset($transDate) ? $transDate : getDateTime('Y-m-d\TH:i:s')); ?>"/>
    <input style="display: none;" class="form-control" type="text" name="locale" id="locale" value="<?php echo(isset($locale) ? $locale : PayHostSOAP::$DEFAULT_LOCALE); ?>"/>
    <input style="display: none;" class="form-control" type="text" name="encryptionKey" id="encryptionKey" value="<?php echo(isset($encryptionKey) ? $encryptionKey : PayHostSOAP::$DEFAULT_ENCRYPTION_KEY); ?>" />
    <input style="display: none;" class="form-control" type="text" name="currency" id="currency" value="<?php echo(isset($currency) ? $currency : PayHostSOAP::$DEFAULT_CURRENCY); ?>"/>
    <input style="display: none;" class="form-control" type="text" name="email" id="email" value="<?php echo(isset($email) ? $email : PayHostSOAP::$DEFAULT_EMAIL); ?>" placeholder="optional" />
    <input style="display: none;" name="incCustomer" id="incCustomer" type="checkbox" value="incCustomer" <?php echo (isset($incCustomer) && $incCustomer == 'incCustomer' ? 'checked="checked"' : '' ); ?> /> 
    <input style="display: none;" class="form-control" type="text" name="uid"  value="<?php echo $ftchdata['uid']; ?>"  />
    <input style="display: none;" class="form-control" type="text" name="cart_id"  value="<?php echo $ftchdata['id']; ?>"  />
    <input style="display: none;" name="incBilling" id="incBilling" type="checkbox" value="incBilling" <?php echo (isset($incBilling) && $incBilling == 'incBilling' ? 'checked="checked"' : '' ); ?> /> 
    <input style="display: none;" name="incShipping" id="incShipping" type="checkbox" value="incShipping" <?php echo (isset($incShipping) && $incShipping == 'incShipping' ? 'checked="checked"' : '' ); ?> /> 
    <select name="country" id="country" class="form-control" style="display: none;">
        <?php echo generateCountrySelectOptions(isset($country) ? $country : PayHostSOAP::$DEFAULT_COUNTRY); ?>
    </select>
    <input style="display: none;" class="form-control" type="text" name="retUrl" id="retUrl" value="http://plait.co.za/plait/users/mobilereturn" />

    <input style="display: none;" class="form-control" type="text" name="notifyURL" id="notifyURL" value="http://plait.co.za/plait/users/notify" />

    <input style="display: none;" class="btn btn-success btn-block" id="doAuthBtn" type="submit" name="btnSubmit" value="Do Auth" />
</form>
<?php 
echo "<script>$('#doAuthBtn').trigger('click')</script>";
} if (isset($_REQUEST['btnSubmit'])) { ?>
    
    <?php
    if (!$err) {
        /*
         * SOAP request has gone through without errors
         */
        if (array_key_exists('Redirect', $result->WebPaymentResponse)) {
            /*
             * A redirect response was received from PayGate
             */       
                $crt_id=$_REQUEST['cart_id'];
                $amount=$_REQUEST['amount'];
                $uid=$_REQUEST['uid'];
                foreach ($result->WebPaymentResponse->Redirect->UrlParams as $url) { 
                   // print_r($url);
                 if($url->key=="PAY_REQUEST_ID"){  
                 $sqlinsrt = "INSERT INTO payment_histories (uid,txn_id,cart_id,amt) VALUES ($uid,'$url->value',$crt_id,'$amount')";  
                 mysql_query($sqlinsrt, $conn);  
                 }
                 }
                 ?>

<style>
    
.loader_boxed {
    width: 41%;
    height: 223px;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    margin: auto;
    text-align: center;
}
.loader_boxed {
    color: #ff0000;
}
</style>
<div class="loader_boxed">
<h4>You will be redirected to the payment gateway. Please do not click on the Refresh button of your
browser OR the F5 button on your keyboard. Doing so may result in transaction failure.</h4>
<div ><img width="50px" src="loading.gif"  /></div>
</div>

            <form role="form" class="form-horizontal text-left" action="<?php echo $result->WebPaymentResponse->Redirect->RedirectUrl; ?>" method="post" style="margin-top: 15px;">
                <?php
                foreach ($result->WebPaymentResponse->Redirect->UrlParams as $url) {
                    /*
                     * Generate hidden inputs from the WebPaymentResponse
                     * (Actual form to redirect with)
                     */
                    ?>
                    <input type="hidden" name="<?php echo $url->key; ?>" value="<?php echo $url->value; ?>" />
                <?php } ?>
                
               
                        
                    <input style="display: none" class="btn btn-success btn-block" type="submit" name="submitBtn" id="doSubmitBtn" value="Confirm Payment" />
            
            </form>
            <?php
        }
    }
    echo "<script>$('#doSubmitBtn').trigger('click')</script>";
}
?>