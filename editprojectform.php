<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Ret projekt titel</title>
</head>
<body>
<?php
$pid = filter_input(INPUT_GET, 'pid', FILTER_VALIDATE_INT) or die('missing parameter');
require_once 'dbcon.php';
$sql = 'SELECT name FROM project WHERE project_id=?';
$stmt = $link->prepare($sql);
$stmt->bind_param('i', $pid);
$stmt->execute();
$stmt->bind_result($pnam);
while ($stmt->fetch()) {}
echo 'Name:'.$pnam;
?>
<form method="post" action="editprojecttitle.php">
<input type="hidden" name="pid" value="<?=$pid?>" >
New title: <input type="text" name="pname" placeholder="Projekt title" value="<?=$pnam?>" />
<input type="submit" name="action" value="submit" />
</form>
</body>
</html>