@extends('layout.app')

@section('content')

<div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">
<table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="service_table">	
	
	
  </tbody>
</table>

</div>
</div>
</div>


<div id="loaderDiv" class="container">
<div class="row">
<div class="col-md-12 text-center p-5">
	<img class="loading-icon m-5" src="{{ asset('images/loading.gif') }}">

</div>
</div>
</div>

<div id="wrongDiv" class="container d-none">
<div class="row">
<div class="col-md-12 text-center p-5">
	<h3>Something Went Wrong!</h3>

</div>
</div>
</div>



<!-- Modal -->
<div class="modal fade" id="deleteModal" data-mdb-backdrop="static"
  data-mdb-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
      	<h4 class="mt-4">Do You want To Delete This Item?</h4>
        <h4 class="mt-4" id="serviceId" hidden> </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">No</button>
        <button type="button" id="deleteConfirmBtn" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


@endsection




@section('script')
<script type="text/javascript">
	getServicesData();
</script>
@endsection