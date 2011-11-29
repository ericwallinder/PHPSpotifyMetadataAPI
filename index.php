<?php 
require_once("lib/config.php");
$aMetadataController = MetadataController::instance();

echo "<h1>Example</h1>";
echo "<h2>Lookup</h2>";
echo "<h3>XML</h3>";
echo $aMetadataController->lookup("spotify:track:70Vdd1gx5tn84jkAU31ASv","xml");
echo "<h3>JSON</h3>";
echo $aMetadataController->lookup("spotify:track:70Vdd1gx5tn84jkAU31ASv");	
echo "<h2>Search</h2>";
echo "<h3>XML</h3>";
echo $aMetadataController->search("artist", "Dexter Jones Circus Orchestra", "xml");
echo "<h3>JSON</h3>";
echo $aMetadataController->search("album", "Dexter Jones Circus Orchestra");
?>