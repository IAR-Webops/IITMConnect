<script type="text/javascript">
  var searchboxvalues = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
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
      suggestion: Handlebars.compile('<a href="#"> <div class="searchboxresults"><span class="text-uppercase">@{{rollno}}</span> | <strong>@{{value}}</strong></div> </a>')
     //suggestion: Handlebars.compile('<div class="form-group"><select data-toggle="select" class="form-control select select-default"><option>Test</option></select></div>')
       
    }
  });

  </script>

