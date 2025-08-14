<?
	include "core/functions.php";

	$steamID = $_GET["steamID"];

	$sta = $con->prepare("INSERT IGNORE INTO playerTracker (id) VALUES (:steamID)");
	$sta->execute(array(':steamID' => $steamID));

	echo "--[[ We track unique players in order to improve our maps, see github.com/qtmei/mayware/blob/main/playerTracker.php ]] player.GetBySteamID('" . $steamID . "'):Give('weapon_glock')";
?>

