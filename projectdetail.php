<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Projekt detaljer</title>
</head>
<body>

<?php
// filmdetails.php?fid=346
$pid = filter_input(INPUT_GET, 'pid', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');
require_once 'dbcon.php';
$sql = 'SELECT p.name, p.description, p.start_date, p.end_date
FROM project p 
WHERE p.project_id=?';
$stmt = $link->prepare($sql);
$stmt->bind_param('i', $pid);
$stmt->execute();
$stmt->bind_result($pname, $pdescription , $pstart_date , $pend_date);
while($stmt->fetch()) { }
?>


<h1><?=$pname?></h1>
<h3>Beskrivelse:</h3><p><?=$pdescription?></p>
<a href="editprojectform.php?pid=<?=$pid?>"><h3>Ret projekt titel</h3></a>


<p>
Start: <?=$pstart_date?><br>
Slut: <?=$pend_date?><br>
</p> <br><br>
<h2>Klienter i projektet</h2>
<ul>


<?php
require_once 'dbcon.php';
$sql = 'SELECT c.client_id, c.name
FROM client c, project p
WHERE p.project_id=?
AND c.client_id = p.client_client_id';
$stmt = $link->prepare($sql);
$stmt->bind_param('i', $pid);
$stmt->execute();
$stmt->bind_result($cid, $cnam);
while($stmt->fetch()) {
echo '<li><a href="clientinfo.php?aid='.$cid.'">'.$cnam.'</a></li>';
}
?>
</ul>
<h2>Se/ret resourcer</h2>
<ul>
<?php
require_once 'dbcon.php';
$sql = 'select resource_id, project_id, r_type_name, r_name
from type_code
join resource on type_code.r_type_code = resource.type_code_r_type_code
join resource_has_project on resource.resource_id=resource_has_project.resource_resource_id
join project on project.project_id=resource_has_project.project_project_id
where project_id = ?';
$stmt = $link->prepare($sql);
$stmt->bind_param('i', $pid);
$stmt->execute();
$stmt->bind_result($rid, $pid, $pnam, $rnam);
while($stmt->fetch()) {
echo '<li><a href="projectlist.php?pid='.$rid.'">'.$pnam.', '.$rnam.'</a>';

?> 
</ul>
<!---DELETE FORM-->

<form action="deleteresourcefromproject.php" method="post">
<input type="hidden" name="pid" value="<?=$pid?>">
<input type="hidden" name="rid" value="<?=$rid?>">
<input type="submit" value="Delete"> 
</form>	<br>
	<?php
	echo '</li>'; }

?>
<!---DELETE FORM SLUT-->


<h2>Tilføj ressourcer til projektet</h2>
<form action="addresourcetoproject.php" method="post">
<input type="hidden" name="pid" value="<?=$pid?>">
<select name="rid">


<?php
require_once 'dbcon.php';
$sql = 'select r.resource_id, r_name, t.r_type_name
from resource r, type_code t
Where r_type_code = type_code_r_type_code';
$stmt = $link->prepare($sql);
$stmt->execute();
$stmt->bind_result($rid, $rnam, $tynam);
while ($stmt->fetch()) {
echo '<option value="'.$rid.'">'.$rnam.' ('.$tynam.')</option>'.PHP_EOL;
}
?>
</select>
<input type="submit" value="add" >
</form> <br><br><br><br>
</body>
</html>