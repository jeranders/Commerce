<?php 
include 'bdd.php';
include 'function.php';

$info_historique = $bdd->query('SELECT * FROM historiques ORDER BY h_date DESC LIMIT 10'); 

while ($donnees = $info_historique->fetch())
{
?>
<tr>
<td>
		<a href="#">
		<?php echo $donnees['h_page']; ?> </a>
		</td>
		<td class="hidden-xs">
		<?php echo $donnees['h_description']; ?> </a>
		</td>
		<td>
		<?php type_historique($donnees['h_type']); ?>
		</td>
		<td>
		<a class="btn default btn-xs blue-stripe" href="#">
		<?php echo getRelativeTime ($donnees['h_date']); ?> </a>
		</td>
		</tr>
<?php
}
$info_historique->closeCursor();
?>