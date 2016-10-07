<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Titlen er nu rettet</title>
</head>

<body>


<?php
$pid = filter_input(INPUT_POST, 'pid', FILTER_VALIDATE_INT) or die('missing parameter');
$pname = filter_input(INPUT_POST, 'pname') or die('missing parameter');

require_once 'dbcon.php';
$sql = 'UPDATE project SET name=? WHERE project_id=?';
$stmt = $link->prepare($sql);
$stmt->bind_param('si', $pname, $pid);
$stmt->execute();
if ($stmt->affected_rows > 0){
	echo 'Title updated...';
}
?>
<hr>
<a href="projectdetail.php?pid=<?=$pid?>"><?=$pname?></a>

</body>
</html>