@extends('layout.app')

@section('content')

<div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">
<button id="addNewBtnId" class="btn btn-sm btn-danger my-3">Add New</button>

<table id="serviceTableId" class="table table-striped table-bordered" cellspacing="0" width="100%">
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


<!-- Add Modal -->
<div class="modal fade" id="addModal" data-mdb-backdrop="static"
  data-mdb-keyboard="false" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body p-5 text-center">
            <div id="serviceAddForm" class="w-100">
                <h6 class="mb-4">Add New Service </h6>
                <input type="text" id="serviceNameAddId" class="form-control mb-4" placeholder="Service Name" />
                <input type="text" id="serviceDescAddId" class="form-control mb-4" placeholder="Service Description" />
                <input type="text" id="serviceImgAddId" class="form-control mb-4" placeholder="Service Image" />
            </div>           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">Cancel</button>
        <button type="button" id="addNewConfirmBtn" class="btn btn-danger">Save</button>
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
        <h4 class="mt-4" id="serviceDeleteId" hidden> </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">No</button>
        <button type="button" id="serviceDeleteConfirmBtn" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<!-- Update Modal -->
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
    function getServicesData(){
        axios.get('/getServicesData')
        .then(function (response) {

            $('#mainDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');

            $('#serviceTableId').DataTable().destroy();
            $('#service_table').empty();

            if(response.status==200) {
                var dataJSON=response.data;
                $.each(dataJSON, function(i, item) {
                $('<tr>').html(
                    "<td> <img class='table-img' src="+dataJSON[i].service_img+"> </td>"+
                    "<td>"+ dataJSON[i].service_name +"</td>"+
                    "<td>"+ dataJSON[i].service_des +"</td>"+
                    "<td><a class='serviceEditBtn' data-id="+dataJSON[i].id+"><i class='fas fa-edit'></i></a></td>"+
                    "<td><a class='serviceDeleteBtn' data-id="+dataJSON[i].id+"><i class='fas fa-trash-alt'></i></a></td>").appendTo('#service_table');
                });

                // Delete Button click
                $('.serviceDeleteBtn').click(function(){
                    var id = $(this).data('id');

                    $('#serviceDeleteId').html(id);
                    $('#deleteModal').modal('show');
                })

                


                // Edit Button click
                $('.serviceEditBtn').click(function(){
                    var id = $(this).data('id');

                    $('#serviceEditId').html(id);
                    editServicesData(id);
                    $('#editModal').modal('show');
                }) 


                $('#serviceTableId').DataTable();
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

    // Delete Confirm Button
    $('#serviceDeleteConfirmBtn').click(function(){
        var id = $('#serviceDeleteId').html();

        deleteServicesData(id);
    })


    function deleteServicesData(deleteId){
        $('#serviceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); // spinner

        axios.post('/serviceDelete', {id:deleteId})
        .then(function(response) {
            $('#serviceDeleteConfirmBtn').html("Yes");
            if(response.status == 200){
                if(response.data == 1){
                    $('#deleteModal').modal('hide');
                    toastr.success('Successfully Deleted')
                    getServicesData();
                }
                else {
                    $('#deleteModal').modal('hide');
                    toastr.error('Delete Failed')
                    getServicesData();
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


    // Update Confirm Button
    $('#updateConfirmBtn').click(function(){
        var id = $('#serviceEditId').html();
        var name = $('#serviceNameId').val();
        var des = $('#serviceDescId').val();
        var img = $('#serviceImgId').val();

        updateServicesData(id, name, des, img);
    })


    function editServicesData(detailId){
        axios.post('/serviceDetails', {id:detailId})
        .then(function(response) {
            if(response.status==200){
                $('#editLoaderId').addClass('d-none');
                $('#serviceEditForm').removeClass('d-none');

                var jsonData = response.data;

                $('#serviceNameId').val(jsonData[0].service_name);
                $('#serviceDescId').val(jsonData[0].service_des);
                $('#serviceImgId').val(jsonData[0].service_img);
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

    function updateServicesData(serviceID,serviceName,serviceDes,serviceImg){
        
        $('#updateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); // spinner

        if(serviceName.length == 0){
            toastr.error('Service Name is Required!');
        }
        else if(serviceDes.length == 0){
            toastr.error('Service Description is Required!')
        }
        else if(serviceImg.length == 0){
            toastr.error('Service Image is Required!')
        }
        else {
            //console.log(serviceID,serviceName,serviceDes,serviceImg);
            axios.post('/serviceUpdate', {
                id: serviceID,
                name: serviceName,
                des: serviceDes,
                img: serviceImg,

            })
            .then(function(response) {
                //console.log(response);
                $('#updateConfirmBtn').html("Save");
                if(response.status == 200){
                    if(response.data==1){
                    $('#editModal').modal('hide');
                    toastr.success('Successfully Updated')
                    getServicesData();
                    }
                    else {
                        $('#editModal').modal('hide');
                        toastr.error('Update Failed')
                        getServicesData();
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



    // Add New Service 
    $('#addNewBtnId').click(function(){
        $('#addModal').modal('show');
    })

    // Add Confirm Button
    $('#addNewConfirmBtn').click(function(){
        var name = $('#serviceNameAddId').val();
        var des = $('#serviceDescAddId').val();
        var img = $('#serviceImgAddId').val();


        addServicesData(name, des, img);
    })


    function addServicesData(serviceName, serviceDes, serviceImg){
        $('#addNewConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); // spinner

        if(serviceName.length == 0){
            toastr.error('Service Name is Required!');
            $('#addNewConfirmBtn').html("Save");
        }
        else if(serviceDes.length == 0){
            toastr.error('Service Description is Required!');
            $('#addNewConfirmBtn').html("Save");
        }
        else if(serviceImg.length == 0){
            toastr.error('Service Image is Required!');
            $('#addNewConfirmBtn').html("Save");
        }
        else {

            axios.post('/serviceAdd', {
                name: serviceName,
                des: serviceDes,
                img: serviceImg,

            })
            .then(function(response) {
                $('#addNewConfirmBtn').html("Save");
                if(response.status == 200){
                    if(response.data==1){
                    $('#addModal').modal('hide');
                    toastr.success('New Service Added')
                    getServicesData();
                    }
                    else {
                        $('#addModal').modal('hide');
                        toastr.error('Service Add Failed')
                        getServicesData();
                    }
                }
                else {
                    $('#addModal').modal('hide');
                    toastr.error('Something Went Wrong!')
                }
            }).catch(function (error) {
                $('#addModal').modal('hide');
                toastr.error('Something Went Wrong!')
            });
        }
    }

</script>
@endsection