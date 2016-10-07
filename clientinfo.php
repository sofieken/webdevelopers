<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Projekt detaljer</title>
</head>
<body>
<?php

$cid = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');

require_once 'dbcon.php';
$sql = 'SELECT c.name, c.address, c.contact_name, c.contact_phone
FROM client c 
WHERE c.client_id=?';
$stmt = $link->prepare($sql);
$stmt->bind_param('i', $cid);
$stmt->execute();
$stmt->bind_result($cname, $caddress , $ccontactname , $ccontactphone);
while($stmt->fetch()) { }
?>
<h1><?=$cname?> (<?=$caddress?>)</h1>
<p>
Start: <?=$ccontactname?><br>
Slut: <?=$ccontactphone?><br>
</p> <br><br>


</body>
</html>