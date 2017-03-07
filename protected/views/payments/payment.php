<div class="row widget-box">
	<div class="two columns"></div>
	<div id="payment-form" class="eight columns widget form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'admin-users-form',
			'enableAjaxValidation'=>false,
		)); ?>
		<h3>Purchase Your Fence Online <span class="gateway-method">(<?php echo $method; ?>)</span></h3>
		<h5>Your fence project total is estimated at: <strong>$<?php echo number_format($model->full_payment, 2, '.', ','); ?></strong></h5>
		<p class="payment-details">To proceed with your purchase, a minimum down-payment is required and shown below.<br />Once your payment has been received, a representative will contact you.</p>
		<?php
		$this->widget('ext.BraintreeApi.widgets.CCForm', array(
			'form' => $form,
			'form_id' => 'payment-form', //Now optional as can be retrieved in widget from $form
			'model' => $payment,
			'values' => $payment->attributes,  //Now optional as can be retrieved in widget from $payment
			//'type' => 'creditcard', //can use this instead of fields array below, options are 'customer', 'creditcard', 'charge_min', 'address'
			'fields' => array(
				'amount',
				'orderId',
				'customer' => array('firstName','lastName','email','phone'),
				'creditCard' => array('number','cvv','month','year','name'),
				'merchantAccountId',
				//'billing' => array('firstName','lastName','company','streetAddress','locality','region','postalCode'),
			),
		));
		?>
		<div class="form-actions btn primary widget-btn payment-btn" style="clear:both;"><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Submit',array('class'=>'btn btn-lg btn-info pull-right')); ?></div>
		<?php $this->endWidget(); ?>
	</div>
	<div class="two columns"></div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#payment-form").validate();
	})
</script>