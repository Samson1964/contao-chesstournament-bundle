<?php
$dim= $_REQUEST['dim'];
$sys= $_REQUEST['sys'];
require('gegner.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"><html lang=de>
<head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"><title>Paarungstabellen</title>
<link rel="STYLESHEET" type="text/css" href="bmmnn4.css"></head><body><h1>Paarungstabellen</h1>
<div align=center><form action="#">
<input type="Radio" name="sys" value="std"<?php if ($sys=='std')	echo ' checked'; ?>>Standard-Rundensystem
<input type="Radio" name="sys" value="tds"<?php if ($sys=='tds')	echo ' checked'; ?>>Verschobenes Rundensystem (BMM 06/07)<br><br>
<?php for ($i=2; $i<24; $i+=2){?><input type="Submit" name="dim" value="<?php= $i ?>"><?php }?><br><br>
<table class="kreuz"><tr><th>Runde</th><th colspan="23">Paarungen</th></tr>
<?php for ($runde = 1; $runde<$dim; $runde++){
	$gegner= holpaare($dim, $runde, $sys);
	?><tr><th><?php= $runde ?></th><?php
	$i=0;
	while ($gegner[$i])	echo '<td>', $gegner[$i++], ' - ', $gegner[$i++], '</td>';
	?></tr><?php
}?>
</table></form></div></body></html>