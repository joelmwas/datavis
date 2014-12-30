<<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
	AmCharts.loadJSON = function(url) {
  // create the request
  if (window.XMLHttpRequest) {
    // IE7+, Firefox, Chrome, Opera, Safari
    var request = new XMLHttpRequest();
  } else {
    // code for IE6, IE5
    var request = new ActiveXObject('Microsoft.XMLHTTP');
  }

  // load it
  // the last "false" parameter ensures that our code will wait before the
  // data is loaded
  request.open('GET', url, false);
  request.send();

  // parse adn return the output
  return eval(request.responseText);
};

</script>
</head>
<body>


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
//in JSON
$prefix = '';
echo "[\n";
while ( $row = mysql_fetch_assoc( $result ) ) {
  echo $prefix . " {\n";
  echo '  "category": "' . $row['category'] . '",' . "\n";
  echo '  "value1": ' . $row['value1'] . ',' . "\n";
  echo '  "value2": ' . $row['value2'] . '' . "\n";
  echo " }";
  $prefix = ",\n";
}
echo "\n]";





// Close the connection
mysql_close($link);

?>

<script type="text/javascript">
	AmCharts.ready(function() {
   // load the data
   var chartData = AmCharts.loadJSON('data.php');

   // this is a temporary line to verify if the data is loaded and parsed correctly
   // please note, that console.debug will work on Safari/Chrome only
   console.debug(chartData);

   // build the chart
   // ...
 });
</script>



</body>
</html>
