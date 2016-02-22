@extends('layout.main')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12 col-md-offset-3 col-md-6">
			<h4 class="text-center">Access Program</h4>        	
		    <hr>
			
			<a href="#">
	        	<div class="card-wrapper"></div>
			</a>	        


        </div>
	</div>        
</div>

@stop

@section('jscontent')
    
    {{ HTML::script('js/card-master/lib/js/card.js'); }}

    <script>
        new Card({
            // a selector or DOM element for the form where users will
	    // be entering their information
	    form: 'form', // *required*
	    // a selector or DOM element for the container
	    // where you want the card to appear
	    container: '.card-wrapper', // *required*

	    formSelectors: {
	        numberInput: 'input#number', // optional — default input[name="number"]
	        expiryInput: 'input#expiry', // optional — default input[name="expiry"]
	        cvcInput: 'input#cvc', // optional — default input[name="cvc"]
	        nameInput: 'input#name' // optional - defaults input[name="name"]
	    },

	    width: 350, // optional — default 350px
	    formatting: true, // optional - default true

	    // Strings for translation - optional
	    messages: {
	        validDate: 'valid\ndate', // optional - default 'valid\nthru'
	        monthYear: 'Month/Year', // optional - default 'month/year'
	    },

	    // Default placeholders for rendered fields - optional
	    placeholders: {
	        number: '{{ Auth::user()->rollno }} ••••',
	        name: '{{ $basic_info->firstname }} {{ $basic_info->lastname }}',
	        expiry: '04/2017',
	        cvc: '•••'
	    },

	    // if true, will log helpful messages for setting up Card
	    debug: false // optional - default false

        });
    </script>

@stop