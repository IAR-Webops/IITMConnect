<html>
<head>
<style type="text/css">
   body {
         font-family: sans-serif;
         font-size: 14px;
   }
</style>

<title>Google Maps JavaScript API v3 Example: Places Autocomplete</title>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places" type="text/javascript"></script>
<script type="text/javascript">
   function initialize() {
      
      var options = {
	  types: ['(cities)']
	 };

	 var input = document.getElementById('searchTextField');
	 var autocomplete = new google.maps.places.Autocomplete(input, options);

   }
   google.maps.event.addDomListener(window, 'load', initialize);
</script>

</head>
<body>

<form method="post" action="{{ URL::route('debug-test-post') }}">
	
   <div>
      <input id="searchTextField" type="text" size="50" name="city" placeholder="Enter a location" autocomplete="on" required > 
   </div>

   <input type="submit" value="submit">
</form>

</body>
</html>