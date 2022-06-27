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
        <h4 class="mt-4" id="serviceDeleteId" hidden> </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">No</button>
        <button type="button" id="deleteConfirmBtn" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editModal" data-mdb-backdrop="static"
  data-mdb-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body p-5 text-center">
            <div id="serviceEditForm" class="d-none w-100">
                <h4 class="mt-4" id="serviceEditId" hidden> </h4>
                <input type="text" id="serviceNameId" class="form-control mb-4" placeholder="Service Name" />
                <input type="text" id="serviceDescId" class="form-control mb-4" placeholder="Service Description" />
                <input type="text" id="serviceImgId" class="form-control mb-4" placeholder="Service Image" />
            </div>

            
            <img id="editLoaderId" class="loading-icon m-5" src="{{ asset('images/loading.gif') }}">
               
            <h5 id="editMsgId" class="d-none">Something Went Wrong!</h5>
            

            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">Cancel</button>
        <button type="button" id="updateConfirmBtn" class="btn btn-danger">Save</button>
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