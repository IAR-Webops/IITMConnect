@extends('page.home')

@section('mainbodycontent')
	
		<div class="col-sm-12 col-md-11">
          <h4>Insti Life Information</h4>        	
          <hr>
        	@if(isset($instilifedata))
			<table class="table">
		      <caption>PoR's</caption>
		      <thead>
		        <tr>
		          <th>Organization</th>
		          <th>Department</th>
		          <th>Post</th>
		          <th>Delete</th>
		        </tr>
		      </thead>
		      <tbody>
			    @foreach ($instilifedata as $key => $instilifedatafield)
				<tr id="por_row_id_{{ $instilifedatafield->id }}">
		          <th scope="row">{{ $instilifedatafield->organization }}</th>
		          <td>{{ $instilifedatafield->department }}</td>
		          <td>{{ $instilifedatafield->post }}</td>
		          <td><a onclick="deletepor({{ $instilifedatafield->id }})" class="btn btn-sm btn-danger">Remove</a></td>
		        </tr>
				@endforeach		      
		      </tbody>
		    </table>
		    <hr>
		    @endif
          <form action="{{ URL::route('instilife-info-post') }}" id="inftilifeform" class="form-horizontal" role="form" method="post">
          	<!-- Field - Organization Name -->                        
            <!-- Field - Department Name -->              
            <!-- Field - Post Name -->  

		    <div id="container">
			</div>		            
            <!-- Button - Add Fields -->
            <div class="form-group">
          		<div class="col-sm-12 col-md-6">
          			<a class="btn btn-block btn-lg btn-inverse" id="filldetails" onclick="addFields()">Add another PoR</a>
          		</div>
          	</div>
           
            <hr>
          	<!-- Field - Submit -->
          	<div class="form-group">
          		<div class="col-sm-12 col-md-6">
          			<input class="btn btn-block btn-lg btn-primary" type="submit" value="Save">
          		</div>
          		<div class="col-sm-12 col-md-6">
			        <a class="btn btn-block btn-lg btn-danger" href="{{ URL::route('home') }}">Cancel</a>          			
          		</div>
          		{{ Form::token() }}
          	</div>
          </form>
        </div> 


@stop


@section('jsmainbodycontent')
	<script type="text/javascript">

		var inc = 0; /* Set Global Variable i */
		function increment(){
			inc += 1; /* Function for automatic increment of field's "Name" attribute. */
		}

		 function addFields(){
            // Number of inputs to create
            var number = 3;
            // Container <div> where dynamic content will be placed
            var container = document.getElementById("container");
            // Clear previous contents of the container
            //while (container.hasChildNodes()) {
            //    container.removeChild(container.lastChild);
            //}
            for (i=0;i<number;i++){
                // Append a node with a random text
                //container.appendChild(document.createTextNode("Member " + (i+1)));
                var divformgroup = document.createElement("div");
                divformgroup.setAttribute("class", "form-group");                

                var divcol = document.createElement("div");
                divcol.setAttribute("class", "col-sm-12 col-md-8");                

                //var divinputgroup = document.createElement("div");
                //divinputgroup.setAttribute("class", "input-group");                
                

                // Create an <input> element, set its type and name attributes
                var input = document.createElement("input");
                input.type = "text";
                input.setAttribute("class", "form-control");  
                input.setAttribute("required", "");                                              
                input.name = "instilifeinfodata[" +inc+ "][]";
            	switch(i) {
				    case 0:
		                input.setAttribute("placeholder", "Organization Name (Ex: Shaastra) *");			        
				        break;
				    case 1:
		                input.setAttribute("placeholder", "Department Name (Ex: WebOps) *");			        
				        break;
				    case 2:
		                input.setAttribute("placeholder", "Post Name (Ex: Coordinator) *");			        				        
				        break;				   
				    default:
		                input.setAttribute("placeholder", "Organization/Department/Post");			        				        
				        break;
				} 

                //divinputgroup.appendChild(input);
                divcol.appendChild(input);
                divformgroup.appendChild(divcol);
                $(divformgroup).hide().fadeIn(1000);

                container.appendChild(divformgroup);

            }
            // Append a line break 
            container.appendChild(document.createElement("hr"));
            increment();
        }

        $(document).ready(addFields);

	</script>
	<script type="text/javascript">
		function deletepor(id) {
			$.ajax({
			    url: "{{ URL::route('instilife-info-delete') }}",
			    type: 'DELETE',
			    data: "por_id="+id,
			    success: function(result) {
			        // Do something with the result
					$.notify(result ,"error");	        
					$("#por_row_id_"+id).fadeOut();
					//$.notify("Under Construction " + id ,"error");	        
			    },
			    error: function(xhr, status, error) {
				  //var err = eval("(" + xhr.responseText + ")");
				  //alert(err.Message);
				  //alert(xhr.responseText);
					$.notify("Unable to remove. Contact Webops Team" ,"error");	        

				}
			});
		}
	</script>
@stop