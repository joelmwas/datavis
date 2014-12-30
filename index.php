<?php   

// Connect to MySQL
$link = mysql_connect( 'localhost', 'root', 'wewe' );
if ( !$link ) {
  die( 'Could not connect: ' . mysql_error() );
}

// Select the data base
$db = mysql_select_db( 'datavis', $link );
if ( !$db ) {
  die ( 'Error selecting database \'datavis\' : ' . mysql_error() );
}

// Fetch the data
$query = "
  SELECT *
  FROM my_chart_data
  ORDER BY category ASC";
$result = mysql_query( $query );

// All good?
if ( !$result ) {
  // Nope
  $message  = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $query;
  die( $message );
}

// Print out rows
while ( $row = mysql_fetch_assoc( $result ) ) {
  echo $row['category'] . ' | ' . $row['value1'] . ' | ' .$row['value2'] . "\n";
}

// Close the connection
mysql_close($link);









?>


