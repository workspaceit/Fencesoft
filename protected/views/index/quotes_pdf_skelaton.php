<html>
<head></head>

<body>

<table>
	<tr>
		<td><img src="<?php echo Yii::app()->basePath.'/../images/Veranda.png'; ?>" /></td>
		<td><span style="font-size:18px;">FENCE ESTIMATE</span></td>
	<tr>
</table>

<table style="background:#efefef; width:100%;">
	<tr>
		<td height="16px"><span style="font-size:12px;">STORE INFORMATION:</span></td>
		<td height="16px"><span style="font-size:12px;">CUSTOMER INFORMATION:</span></td>
	</tr>
	<tr>
		<td height="16px"><span style="font-size:12px;"><?php echo ucwords(str_replace('_', ' ', $storeData['network_type']));?> - Store # <?php echo $storeData['store_id'];?></span></td>
		<td height="16px"><span style="font-size:12px;"><?php echo $userData['full_name'];?></span></td>
	</tr>
	<tr>
		<td height="16px"><span style="font-size:12px;"><?php echo $storeData['location'].', '.$storeData['city']; ?> <?php echo $storeData['zip_code'];?></span></td>
		<td height="16px"><span style="font-size:12px;"><?php echo $userData['address'];?></span></td>
	</tr>
	<tr>
		<td height="16px"><span style="font-size:12px;">(219) 531-6687</span></td>
		<td height="16px"><span style="font-size:12px;"><?php echo $userData['user_email'];?></span></td>
	</tr>
</table>

<?php echo $materialCalc;?>

<table style="width:100%;">
	<tr>
		<td colspan="3" height="16px"><span style="font-size:10px;"><i>* This is just an estimate, additional items or costs may be required for your fence project such as, but not limited to; concrete, pea gravel, hand tools, and local sales tax.  Please see local store representative for details.</i></span></td>
	</tr>
	<tr>
		<td height="16px"><img src="<?php echo Yii::app()->basePath.'/../images/Home-Depot.png'; ?>" /></td>
		<td height="16px"><img src="<?php echo Yii::app()->basePath.'/../images/Barrette.png'; ?>" /></td>
		<td height="16px" width="50%"><span style="font-size:10px;">&copy; 2013 Barrette Outdoor Living. All rights	reserved. | Powered by: FenceSoft &reg;</span></td>
	</tr>
</table>
</body>
</html>