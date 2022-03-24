<div class="cc-info product-wrapper">    				
  	<strong>PAYMENT INFORMATION</strong><br />
    <em>Enter your credit card details</em><br /><br />
  	
  	<p>
  		Name on Card:<br />
  		<input type="text" name="cc_name" />
  	</p>
  	<p>
  		Card Number:<br />
  		<input type="text" name="cc_number" />
  	</p>
  	<p>
  		Exp Date:<br />
  		<input type="text" name="cc_exp_month" maxlength="2" size="3" /> / 
  		<input type="text" name="cc_exp_year" maxlength="4" size="5" /> ( MM / YYYY)
  	</p>
  	<p>
  		CVV2:<br />
  		<input type="text" name="cc_cvv2" />
  	</p>
  	<div>
  		<input type="checkbox" name="save_cc" value="1" /> Save Credit Card <br /><br />
  		<input type="hidden" name="amount" id="amount" />
  		<input type="hidden" name="action" value="go_order" />
  		<input type="hidden" name="transaction_id" id="transaction_id" />
      <button id="go_order" class="btn btn-primary">Submit</button>
    </div>
</div>