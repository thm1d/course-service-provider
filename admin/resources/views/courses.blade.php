@extends('layout.app')

@section('content')

<div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">
	<button id="addNewBtnId" class="btn btn-sm btn-danger my-3">Add New</button>
<table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Fee</th>
	  <th class="th-sm">Class</th>
	  <th class="th-sm">Enroll</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="course_table">
  
	<tr>
	  <th class="th-sm">IT Course</th>
	  <th class="th-sm">2000/=</th>
	  <th class="th-sm">45</th>
	  <th class="th-sm">224</th>
	  <th class="th-sm"><a href="" ><i class="fas fa-edit"></i></a></th>
	  <th class="th-sm"><a href="" ><i class="fas fa-trash-alt"></i></a></th>
    </tr>	
	
	
	
	
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

<!--  Add Course Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body  text-center">
        <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-mdb-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
    </div>
    </div>
  </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="editModal" data-mdb-backdrop="static"  role="dialog"
  data-mdb-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    	<div class="modal-header">
	        <button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
    	</div>
        <div class="modal-body p-5 text-center">
            <div id="serviceEditForm" class="d-none w-100">
                <h4 class="mt-4" id="courseEditId" hidden> </h4>

        		<div class="container">
        			<div class="row">
		                <div class="col-md-6">
			             	<input id="CourseNameEditId" type="text" class="form-control mb-3" placeholder="Course Name">
			          	 	<input id="CourseDesEditId" type="text" class="form-control mb-3" placeholder="Course Description">
			    		 	<input id="CourseFeeEditId" type="text" class="form-control mb-3" placeholder="Course Fee">
			     			<input id="CourseEnrollEditId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
			       		</div>
			       		<div class="col-md-6">
			     			<input id="CourseClassEditId" type="text" class="form-control mb-3" placeholder="Total Class">      
			     			<input id="CourseLinkEditId" type="text" class="form-control mb-3" placeholder="Course Link">
			     			<input id="CourseImgEditId" type="text" class="form-control mb-3" placeholder="Course Image">
			       		</div>
			       	</div>
	       		</div>
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

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" data-mdb-backdrop="static"
  data-mdb-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
      	<h4 class="mt-4">Do You want To Delete This Item?</h4>
        <h4 class="mt-4" id="courseDeleteId" hidden> </h4>
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
	getCoursesData();


</script>
@endsection