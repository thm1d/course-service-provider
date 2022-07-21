@extends('layout.app')

@section('content')

<div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">
	<button id="addNewBtnId" class="btn btn-sm btn-danger my-3">Add New</button>
<table id="courseTableId" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
            <h5 class="modal-title">Update Course</h5>
	        <button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
    	</div>
        <div class="modal-body p-3 text-center">
            <div id="serviceEditForm" class="d-none w-100">
                <h4 class="mt-4" id="courseEditId d-none"> </h4>

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
        <h4 class="mt-4" id="courseDeleteId d-none"> </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">No</button>
        <button type="button" id="courseDeleteConfirmBtn" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    getCoursesData();
   

    function getCoursesData(){
        axios.get('/getCoursesData')
        .then(function (response) {
            if(response.status==200) {
                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');

                $('#courseTableId').DataTable().destroy();
                $('#course_table').empty();

            
                var dataJSON=response.data;
                $.each(dataJSON, function(i, item) {
                $('<tr>').html(
                    "<th class='th-sm'>"+dataJSON[i].course_name+"</th>"+
                    "<th class='th-sm'>"+dataJSON[i].course_fee+"</th>"+
                    "<th class='th-sm'>"+dataJSON[i].course_totalclass+"</th>"+
                    "<th class='th-sm'>"+dataJSON[i].course_totalenroll+"</th>"+
                    "<td><a class='courseEditBtn' data-id="+dataJSON[i].id+"><i class='fas fa-edit'></i></a></td>"+
                    "<td><a class='courseDeleteBtn' data-id="+dataJSON[i].id+"><i class='fas fa-trash-alt'></i></a></td>").appendTo('#course_table');
                });


                // Edit Button click
                $('.courseEditBtn').click(function(){
                    var id = $(this).data('id');

                    $('#courseEditId').html(id);
                    editCourseData(id);
                    $('#editModal').modal('show');
                })


                // Delete Button click
                $('.courseDeleteBtn').click(function(){
                    var id = $(this).data('id');

                    $('#courseDeleteId').html(id);
                    $('#deleteModal').modal('show');
                })

                $('#courseTableId').DataTable({"ordering": false});
                $('.dataTables_length').addClass('bs-select');
      

            }
            else {
                $('#loaderDiv').addClass('d-none');
                $('#wrongDiv').removeClass('d-none');
            }
            

        }).catch(function (error) {
            $('#loaderDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');
        });

        
        
    }

    // Add New Course 
    $('#addNewBtnId').click(function(){
        $('#addCourseModal').modal('show');
    })

    // Add Confirm Button
    $('#CourseAddConfirmBtn').click(function(){
        var name = $('#CourseNameId').val();
        var des = $('#CourseDesId').val();
        var fee = $('#CourseFeeId').val();
        var enroll = $('#CourseEnrollId').val();
        var cls = $('#CourseClassId').val();
        var link = $('#CourseLinkId').val();
        var img = $('#CourseImgId').val();


        addCourseData(name, des, fee, enroll, cls, link, img);
    })


    function addCourseData(courseName, courseDes, courseFee, courseEnroll, courseClass, courseLink, courseImg){
        $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); // spinner

        if(courseName.length == 0){
            toastr.error('Course Name is Required!');
            $('#CourseAddConfirmBtn').html("Save");
        }
        else if(courseDes.length == 0){
            toastr.error('Course Description is Required!');
            $('#CourseAddConfirmBtn').html("Save");
        }
        else if(courseFee.length == 0){
            toastr.error('Course Fee is Required!');
            $('#CourseAddConfirmBtn').html("Save");
        }
        else if(courseEnroll.length == 0){
            toastr.error('Course Total Enroll is Required!');
            $('#CourseAddConfirmBtn').html("Save");
        }
        else if(courseClass.length == 0){
            toastr.error('Course Total Class is Required!');
            $('#CourseAddConfirmBtn').html("Save");
        }
        else if(courseLink.length == 0){
            toastr.error('Course Link is Required!');
            $('#CourseAddConfirmBtn').html("Save");
        }
        else if(courseImg.length == 0){
            toastr.error('Course Image is Required!');
            $('#CourseAddConfirmBtn').html("Save");
        }
        else {

            axios.post('/courseAdd', {
                name: courseName,
                des: courseDes,
                fee: courseFee,
                enroll: courseEnroll,
                class: courseClass,
                link: courseLink,
                img: courseImg,

            })
            .then(function(response) {
                $('#CourseAddConfirmBtn').html("Save");
                if(response.status == 200){
                    if(response.data==1){
                    $('#addCourseModal').modal('hide');
                    toastr.success('New Course Added')
                    getCoursesData();
                    }
                    else {
                        $('#addCourseModal').modal('hide');
                        toastr.error('Course Add Failed')
                        getCoursesData();
                    }
                }
                else {
                    $('#addCourseModal').modal('hide');
                    toastr.error('Something Went Wrong!')
                }
            }).catch(function (error) {
                $('#addCourseModal').modal('hide');
                toastr.error('Something Went Wrong!')
            });
        }
    }


    // Update Confirm Button
    $('#updateConfirmBtn').click(function(){
        var id = $('#courseEditId').html();
        var name = $('#CourseNameEditId').val();
        var des = $('#CourseDesEditId').val();
        var fee = $('#CourseFeeEditId').val();
        var enroll = $('#CourseEnrollEditId').val();
        var cls = $('#CourseClassEditId').val();
        var link = $('#CourseLinkEditId').val();
        var img = $('#CourseImgEditId').val();

        updateCourseData(id, name, des, fee, enroll, cls, link, img);
    })


    function editCourseData(detailId){
        axios.post('/courseDetails', {id:detailId})
        .then(function(response) {
            if(response.status==200){
                $('#editLoaderId').addClass('d-none');
                $('#serviceEditForm').removeClass('d-none');

                var jsonData = response.data;

                $('#CourseNameEditId').val(jsonData[0].course_name);
                $('#CourseDesEditId').val(jsonData[0].course_des);
                $('#CourseFeeEditId').val(jsonData[0].course_fee);
                $('#CourseEnrollEditId').val(jsonData[0].course_totalenroll);
                $('#CourseClassEditId').val(jsonData[0].course_totalclass);
                $('#CourseLinkEditId').val(jsonData[0].course_link);
                $('#CourseImgEditId').val(jsonData[0].course_img);
            }
            else {
                $('#editLoaderId').addClass('d-none');
                $('#editMsgId').removeClass('d-none');
            }
        }).catch(function (error) {
            $('#editLoaderId').addClass('d-none');
            $('#editMsgId').removeClass('d-none');
        });
    }

    function updateCourseData(courseId, courseName, courseDes, courseFee, courseEnroll, courseClass, courseLink, courseImg){
        
        $('#updateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); // spinner

        if(courseName.length == 0){
            toastr.error('Course Name is Required!');
            $('#updateConfirmBtn').html("Save");
        }
        else if(courseDes.length == 0){
            toastr.error('Course Description is Required!');
            $('#updateConfirmBtn').html("Save");
        }
        else if(courseFee.length == 0){
            toastr.error('Course Fee is Required!');
            $('#updateConfirmBtn').html("Save");
        }
        else if(courseEnroll.length == 0){
            toastr.error('Course Total Enroll is Required!');
            $('#updateConfirmBtn').html("Save");
        }
        else if(courseClass.length == 0){
            toastr.error('Course Total Class is Required!');
            $('#updateConfirmBtn').html("Save");
        }
        else if(courseLink.length == 0){
            toastr.error('Course Link is Required!');
            $('#updateConfirmBtn').html("Save");
        }
        else if(courseImg.length == 0){
            toastr.error('Course Image is Required!');
            $('#updateConfirmBtn').html("Save");
        }
        else {

            axios.post('/courseUpdate', {
                id: courseId,
                name: courseName,
                des: courseDes,
                fee: courseFee,
                enroll: courseEnroll,
                class: courseClass,
                link: courseLink,
                img: courseImg,

            })
            .then(function(response) {
                $('#updateConfirmBtn').html("Save");
                if(response.status == 200){
                    if(response.data==1){
                    $('#editModal').modal('hide');
                    toastr.success('Successfully Updated')
                    getCoursesData();
                    }
                    else {
                        $('#editModal').modal('hide');
                        toastr.error('Update Failed')
                        getCoursesData();
                    }
                }
                else {
                    $('#editModal').modal('hide');
                    toastr.error('Something Went Wrong!')
                }
            }).catch(function (error) {
                $('#editModal').modal('hide');
                toastr.error('Something Went Wrong!')
            });
        }
    }




    // Delete Confirm Button
    $('#courseDeleteConfirmBtn').click(function(){
        var id = $('#courseDeleteId').html();

        deleteCoursesData(id);
    })


    function deleteCoursesData(deleteId){
        $('#courseDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); // spinner

        axios.post('/courseDelete', {id:deleteId})
        .then(function(response) {
            $('#courseDeleteConfirmBtn').html("Yes");
            if(response.status == 200){
                if(response.data==1){
                    $('#deleteModal').modal('hide');
                    toastr.success('Successfully Deleted')
                    getCoursesData();
                }
                else {
                    $('#deleteModal').modal('hide');
                    toastr.error('Delete Failed')
                    getCoursesData();
                }
            } else {
                $('#deleteModal').modal('hide');
                toastr.error('Something Went Wrong!')
            }
        }).catch(function (error) {
            $('#deleteModal').modal('hide');
            toastr.error('Something Went Wrong!')
        });
    }
</script>
@endsection