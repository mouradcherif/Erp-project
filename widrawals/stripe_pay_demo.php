<?php

require 'stripe/Stripe.php';

$params = array(
	"testmode"   => "on",
	"private_live_key" => "sk_live_xxxxxxxxxxxxxxxxxxxxx",
	"public_live_key"  => "pk_live_xxxxxxxxxxxxxxxxxxxxx",
	"private_test_key" => "sk_test_kBfsPumDxY36aK8wDCheJkjQ",
	"public_test_key"  => "pk_test_YghoPrYnIpXGfz2T5oczHE5j"
);

if ($params['testmode'] == "on") {
	Stripe::setApiKey($params['private_test_key']);
	$pubkey = $params['public_test_key'];
} else {
	Stripe::setApiKey($params['private_live_key']);
	$pubkey = $params['public_live_key'];
}

if(isset($_POST['stripeToken']))
{
	
        $amount_cents1 = $_POST['amount1'];
        $amount_cents2 = $_POST['amount2'];
        $amount_cents = $amount_cents1 .$amount_cents2;
	$invoiceid = "14526321";                      // Invoice ID
	$description = "Invoice #" . $invoiceid . " - " . $invoiceid;
	
	try {

		$charge = Stripe_Charge::create(array(		 
			  "amount" => $amount_cents,
			  "currency" => "usd",
			  "source" => $_POST['stripeToken'],
			  "description" => $description)			  
		);

		if ($charge->card->address_zip_check == "fail") {
			throw new Exception("zip_check_invalid");
		} else if ($charge->card->address_line1_check == "fail") {
			throw new Exception("address_check_invalid");
		} else if ($charge->card->cvc_check == "fail") {
			throw new Exception("cvc_check_invalid");
		}
					

		$result = "success";

	} catch(Stripe_CardError $e) {			

	$error = $e->getMessage();
		$result = "declined";

	} catch (Stripe_InvalidRequestError $e) {
		$result = "declined";		  
	} catch (Stripe_AuthenticationError $e) {
		$result = "declined";
	} catch (Stripe_ApiConnectionError $e) {
		$result = "declined";
	} catch (Stripe_Error $e) {
		$result = "declined";
	} catch (Exception $e) {

		if ($e->getMessage() == "zip_check_invalid") {
			$result = "declined";
		} else if ($e->getMessage() == "address_check_invalid") {
			$result = "declined";
		} else if ($e->getMessage() == "cvc_check_invalid") {
			$result = "declined";
		} else {
			$result = "declined";
		}		  
	}
	
	echo "<BR>Stripe Payment Status : ".$result;
	
	echo "<BR>Stripe Response : ";
	
	print_r($charge); exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Stripe Pay Custom Integration Demo</title>
</head>
<body>
<link href="style.css" type="text/css" rel="stylesheet" />
<h1 class="bt_title">Stripe Pay Demo</h1>
<div class="dropin-page">
  <form action="" method="POST" id="payment-form">
  <span class="payment-errors"></span>

   <div class="form-row">
    <label>
      <span>Amount</span>
      <input type="text" size="20" data-stripe="number" name="amount">
    </label>
  </div>

  <div class="form-row">
    <label>
      <span>Card Number</span>
      <input type="text" size="20" data-stripe="number">
    </label>
  </div>

  <div class="form-row">
    <label>
      <span>Expiration (MM/YY)</span>
      <input type="text" size="2" data-stripe="exp_month">
    </label>
    <span> / </span>
    <input type="text" size="2" data-stripe="exp_year">
  </div>

  <div class="form-row">
    <label>
      <span>CVC</span>
      <input type="text" size="4" data-stripe="cvc">
    </label>
  </div>
  <input type="submit" class="submit" value="Submit Payment">
</form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
	Stripe.setPublishableKey('<?php echo $params['public_test_key']; ?>');
  
	$(function() {
	  var $form = $('#payment-form');
	  $form.submit(function(event) {
		
		$form.find('.submit').prop('disabled', true);
	
		
		Stripe.card.createToken($form, stripeResponseHandler);
	
		
		return false;
	  });
	});

	function stripeResponseHandler(status, response) {
	 
	  var $form = $('#payment-form');
	
	  if (response.error) {
	
		
		$form.find('.payment-errors').text(response.error.message);
		$form.find('.submit').prop('disabled', false); 
	
	  } else { 
	
	
		var token = response.id;

		
		$form.append($('<input type="hidden" name="stripeToken">').val(token));
	
		
		$form.get(0).submit();
	  }
	};
</script>
</body>
</html>
