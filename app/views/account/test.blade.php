<html>
<head>
<style type="text/css">
   body {
         font-family: sans-serif;
         font-size: 14px;
   }
   #remote .empty-message  {
      padding: 5px 10px;
     text-align: center;
    }
    .searchboxresults {
     text-align: center;
      margin: 20px;
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

<div>
	
	<div id="remote" style="">
  <input class="typeahead" style="" type="text" placeholder="Oscar winners for Best Picture">
</div>

</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script src="//twitter.github.com/typeahead.js/releases/latest/typeahead.bundle.js"></script>
<script src="{{ URL::asset('js/handlebars-v3.0.3.js') }}"></script>
<script type="text/javascript">
var searchboxvalues = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  //prefetch: '{{ URL::asset("data/post_1960.json") }}'//,
  //prefetch: '{{ URL::asset("data/searchboxvalues.json") }}'//,
  prefetch: '{{ URL::route("search-box") }}'//,

  //remote: {
    //url: 'https://twitter.github.io/typeahead.js/data/films/queries/%QUERY.json',
    //wildcard: '%QUERY'
  //}
});
 
$('#remote .typeahead').typeahead(null, {
  name: 'searh-box-values',
  display: 'value',
  source: searchboxvalues,
  templates: {
    empty: [
      '<div class="empty-message">',
        'Perform Advanced Search',
      '</div>'
    ].join('\n'),
    //suggestion: Handlebars.compile('<div class="searchboxresults"><strong>@{{value}}</strong> – </div>')
   suggestion: Handlebars.compile('<div><select data-toggle="select" class="form-control select select-default"><option>Test</option></select</div>')
     
  }
});

</script>

</body>
</html>