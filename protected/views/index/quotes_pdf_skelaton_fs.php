<html>
<head></head>
<body>
<style>.veranda, .freedom, .activeyards {display:none;}</style>
<table style="width:100%; border-bottom:1px solid #efefef; padding-bottom:10px; margin-bottom:13px;">
	<tr>
		<td><img src="<?php echo Yii::app()->basePath.'/../images/logos/'.$storeData['store_id'].'.png'; ?>" /></td>
	<tr>
</table>
<table style="background:#efefef; width:100%; padding:10px;">
	<tr>
		<td style="height:16px;"><span style="font-size:12px;">DEALER INFORMATION:</span></td>
		<td style="height:16px;"><span style="font-size:12px;">CUSTOMER INFORMATION:</span></td>
	</tr>
	<tr>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $storeData['site_name']//.' - '.ucwords(str_replace('_', ' ', $storeData['network_type']));?></span></td>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $userData['full_name'];?></span></td>
	</tr>
	<tr>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $storeData['location'].', '.$storeData['city'].', '.$storeData['state'];?> <?php echo $storeData['zip_code'];?></span></td>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $userData['address'];?></span></td>
	</tr>
	<tr>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $storeData['phone'];?></span></td>
		<td style="height:16px;"><span style="font-size:12px;"><?php echo $userData['user_email'];?></span></td>
	</tr>
</table>
<?php echo $materialCalc;?>
<!--<table style="width:100%; margin-top:10px;">
	<tr>
		<td style="text-align:center;"><span style="font-size:12px; color:#999;"><i>* This is just an estimate, additional items or costs may be required for your fence project such as, but not limited to; additional material, landscaping, hand tools, and the removal of existing fence.  Please consult with the contracted installer for details.</i></span></td>
	</tr>
</table>-->
<table style="width:100%; margin-top:10px; border-bottom:1px solid #efefef; margin-bottom:10px; padding-bottom:10px;">
	<tr>
		<td style="text-align:center;"><span style="font-size:12px;"><a style="text-decoration:none; color:#4D8929;" href="<?php echo Yii::app()->request->getBaseUrl(true).'/index.php?r=payments/payment&quotes_id='.$quotes_id; ?>">- ORDER YOUR FENCE ONLINE -</a></span></td>
	</tr>
</table>

<div style="font-size:10px; color:#666; padding:10px 0; text-align:center;">
    <?php echo $quotesInfo['notes'];?>
</div>
<div style="font-size:10px; color:#666; padding:10px 0; text-align:center;">
    
    <?php echo $storeData['terms_condition'];?>
</div>
        


<table style="width:100%; border-top:1px solid #efefef; padding-top:13px; margin-top:10px;">
	<tr>
		<td style="text-align:center;"><span style="font-size:12px; color:#666;">&copy; 2014 <?php echo $storeData['site_name'];?>. All rights reserved. | Powered by: FenceSoft &reg;</span></td>
	</tr>
</table>
</body>
</html>