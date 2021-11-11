@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content">
        <div class="row">
        	<div class="col-md-8 col-sm-offset-2">
            	<div class="box box-success">
                	<div class="box-header with-border">
                    	<h3 class="box-title">Select Name</h3> 
                	</div>
                	<div class="box-body">

                		<div class="col-sm-12">
    						
    						<div class="card">
    							<div class="card-header">
    								<h3 class="text-center"><i class="fa fa-edit"></i> Edit Form of <code><b>Select Name</b></code> </h3>
    							</div>
    							<div class="card-body">
    						  		
    								@include('select._form')

    							</div>
    						</div>
    					</div>

                	</div>
          		</div>
        	</div>
      	</div>
    </section>
</div>
@endsection