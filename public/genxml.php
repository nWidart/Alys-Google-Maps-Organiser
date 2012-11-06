<?php 
	// $username = "root";
	// $password = "root";
	// $database = "gmaps-org";
	// $host = "localhost";
	
	// Pagoda box config:
	//
	$host = $_SERVER['DB1_HOST'];
	$database = $_SERVER['DB1_NAME'];
	$username = $_SERVER['DB1_USER'];
	$password = $_SERVER['DB1_PASS'];


	// Start XML file, create parent node

	$dom = new DOMDocument("1.0", "utf8");
	$node = $dom->createElement("markers");
	$parnode = $dom->appendChild($node); 

	// Opens a connection to a MySQL server

	$connection = mysql_connect ($host, $username, $password);
	if (!$connection) {  die('Not connected : ' . mysql_error());} 

	// Set the active MySQL database

	$db_selected = mysql_select_db($database, $connection);
	if (!$db_selected) {
	  die ('Can\'t use db : ' . mysql_error());
	} 

	// Select all the rows in the markers table

	$query = "SELECT * FROM gmaps_markers WHERE user_id = 5";
	$result = mysql_query($query);
	if (!$result) {  
	  die('Invalid query: ' . mysql_error());
	} 

	header("Content-type: text/xml"); 

	// Iterate through the rows, adding XML nodes for each

	while ($row = @mysql_fetch_assoc($result)){  
	  // ADD TO XML DOCUMENT NODE  
		$node = $dom->createElement("marker");
		$newnode = $parnode->appendChild($node);
		$newnode->setAttribute("name",$row['name']);
		$newnode->setAttribute("address", $row['address']);  
		$newnode->setAttribute("lat", $row['lat']);
		$newnode->setAttribute("lng", $row['lng']);
		$newnode->setAttribute("type", $row['type']);
		$newnode->setAttribute("img_thumb", $row['img_url']);
		
		$newnode->setAttribute("rem1", $row['rem1']);
		$newnode->setAttribute("rem2", $row['rem2']);
		$newnode->setAttribute("rem3", $row['rem3']);
		$newnode->setAttribute("rem4", $row['rem4']);
		$newnode->setAttribute("rem5", $row['rem5']);
	} 

	echo $dom->saveXML();