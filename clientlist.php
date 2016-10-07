<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>

<h1>Categories</h1>

<ul>

<?php /*
require_once 'dbcon.php';

$sql = 'SELECT c.client_id, c.name FROM client c';
$stmt = $link->prepare($sql);
$stmt->execute();
$stmt->bind_result($cid, $cnam);

while($stmt->fetch()) {
	echo '<li><a href="filmlist.php?cid='.$cid.'">'.$cnam.'</a></li>'.PHP_EOL;
}

*/
?>
</ul>

<?php
require_once 'dbcon.php';

$sql = 'SELECT c.client_id, c.name FROM client c';
$stmt = $link->prepare($sql);
$stmt->execute();
$stmt->bind_result($cid, $cnam);

while($stmt->fetch()) {
	echo '<li><a href="projectdetail.php?pid='.$cid.'">'.$cnam.'</a></li>'.PHP_EOL;
}


?>

</body>
</html>