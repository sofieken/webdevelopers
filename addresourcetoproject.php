<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>tilføj ressource</title>
</head>

<body>
<?php
$rid = filter_input(INPUT_POST, 'rid', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');
$pid = filter_input(INPUT_POST, 'pid', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');

//echo $rid.' xxxx '.$pid;

require_once 'dbcon.php';
$sql = 'INSERT INTO resource_has_project (project_project_id, resource_resource_id) VALUES (?, ?)';
$stmt = $link->prepare($sql);
$stmt->bind_param('ii', $pid, $rid);
$stmt->execute();

if($stmt->affected_rows > 0) {
	echo 'Ressourcen er tilføjet til Projektet :)';
}
else {
	echo 'Ressourcen er allerede tilknyttet Projektet';
}

?>

<a href="projectdetail.php?pid=<?=$pid?>">Se projektdetaljer</a><br>

</body>
</html>