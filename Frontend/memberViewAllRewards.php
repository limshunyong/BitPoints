<!DOCTYPE html>
<html>
<body>

<style>
table, th, td {
   border: 1px solid black;
}
</style>

<?php
session_start();



$ch = curl_init('http://localhost:3000/api/org.acme.BitPoint.Reward?');


curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Accept: application/json'
    )); 

//return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

$result = curl_exec($ch);

$reward = json_decode($result, true);

//print_r($reward);


$ch2 = curl_init('http://localhost:3000/api/org.acme.BitPoint.Merchant');

curl_setopt($ch2, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Accept: application/json'
    )); 

//return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true); 

$result2 = curl_exec($ch2);

$merchant = json_decode($result2, true);

//print_r($merchant);

?>


<h2> All Rewards Available</h2>
<table>
 <tr>
	<th>Rewards ID</th>
	<th>Merchant</th>
	<th>Name</th>
	<th>Description</th>
	<th>Points Amount</th>
	<th>Start Date</th>
	<th>Quantity</th>
 </tr>
 <?php foreach($reward as $i){  ?>
 <tr>
 	<th><?php echo $i['rewardsId']; ?></th>
 	<th><?php foreach($merchant as $j) { if(strpos($i['merchant'], $j['email']) !== false){ echo $j['companyName'];}}?></th>
 	<th><?php echo $i['name']; ?></th>
 	<th><?php echo $i['description']; ?></th>
 	<th><?php echo $i['pointsAmount']; ?></th>
 	<th><?php echo $i['startDate']; ?></th>
 	<th><?php echo $i['quantity']; ?></th>
 </tr>	
 <?php }?>

</table>	


<br>
<a href="main.php">Back to Main page</a><br>

</body>
</html>