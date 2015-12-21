<?php
include_once("db_connection.php");
if(!empty($_GET['q']) and $_GET['q']=='server') {
	include_once("backend.php");
	$res = json_decode($res);
}
if(!empty($_GET['q']) and $_GET['q']=='client') {
	$sql = mysql_query("select *from server_details");
	$result = array();
	while($data = mysql_fetch_assoc($sql)) {
		$res[] = $data;
	}
	$res = json_encode($res);
	$res = json_decode($res);
}

if(!empty($_POST)) {
	mysql_query("update server_details set name='".$_POST['name']."', phone='".$_POST['phone']."', address='".$_POST['address']."' where id='".$_POST['id']."'")or die(mysql_error());
	$sql = mysql_query("select *from server_details");
	$result = array();
	while($data = mysql_fetch_assoc($sql)) {
		$res[] = $data;
	}
	$res = json_encode($res);
	$res = json_decode($res);
}
if(!empty($_GET['delete'])) {
	mysql_query("delete from server_details where id='".$_GET['delete']."'");
	$sql = mysql_query("select *from server_details");
	$result = array();
	while($data = mysql_fetch_assoc($sql)) {
		$res[] = $data;
	}
	$res = json_encode($res);
	$res = json_decode($res);
}

?>
<html>
<link href="css/style.css" rel="stylesheet">
<a href="index.php?q=server"><button id="fetch">Fetch From Server</button></a><a href="index.php?q=client"><button id="fetch">Fetch From Local</button></a><br>
Your Data
<div class="parent1">
	<div class="child">Name</div>
	<div class="child">Phone</div>
	<div class="child">Address</div>
	<div class="child">Action</div>
</div>
<div style="clear:both;"></div>
<?php if(!empty($res)) {
	foreach($res as $r) {
		?>
		<div class="parent">
			<div class="child"><?=$r->name?></div>
			<div class="child"><?=$r->phone?></div>
			<div class="child"><?=$r->address?></div>
			<div class="child"><span class="action"><a href="index.php?edit=<?=$r->id?>">Edit</a></span><span class="action"><a href="index.php?delete=<?=$r->id?>">Delete</a></span></div>
			<div style="clear:both;"></div>
		</div>
<?php	}
}?>
<?php if(!empty($_GET['edit'])) {
	$d = mysql_query("select *from server_details where id='".$_GET['edit']."'");
	$data = mysql_fetch_assoc($d);
	?>
<form method="post">
	<input type="hidden" name="id" value="<?=$data['id']?>">
	<div class="child">Name</div><div class="child"><input type="text" name="name" value="<?=$data['name']?>"></div>
	<div style="clear:both;"></div>
	<div class="child">Phone</div><div class="child"><input type="text" name="phone" value="<?=$data['phone']?>"></div>
	<div style="clear:both;"></div>
	<div class="child">Address</div><div class="child"><input type="text" name="address" value="<?=$data['address']?>"></div>
	<div>
		<input type="submit" value="Update">
	</div>
</form>
<?php }?>
<script src="js/jquery-1.11.3.min.js"></script>
</html>
