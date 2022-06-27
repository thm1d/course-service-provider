$(document).ready(function () {
$('#VisitorDt').DataTable();
$('.dataTables_length').addClass('bs-select');
});


function getServicesData(){
	axios.get('/getServicesData')
  	.then(function (response) {

  		$('#mainDiv').removeClass('d-none');
  		$('#loaderDiv').addClass('d-none');

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

	   		$('#deleteConfirmBtn').click(function(){
	   			var id = $('#serviceId').html();
 
	   			deleteServicesData(id);
	   		})


	   		// Edit Button click
	   		$('.serviceEditBtn').click(function(){
	   			var id = $(this).data('id');

	   			$('#serviceEditId').html(id);
	   			editServicesData(id);
	   			$('#editModal').modal('show');
	   		})

	   		

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


function deleteServicesData(deleteId){
	axios.post('/serviceDelete', {id:deleteId})
	.then(function(response) {
		if(response.data==1){
			$('#deleteModal').modal('hide');
			toastr.success('Successfully Deleted')
			getServicesData();
		}
		else {
			$('#deleteModal').modal('hide');
			toastr.error('Delete Failed')
			getServicesData();
		}
	}).catch(function (error) {
		
	});
}

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
	if(serviceName.length == 0){
		toastr.error('Service Name is Required!')
	}
	else if(serviceDes.length == 0){
		toastr.error('Service Description is Required!')
	}
	else if(serviceImg.length == 0){
		toastr.error('Service Image is Required!')
	}
	else {

		axios.post('/serviceUpdate', {
	        id: serviceID,
	        name: serviceName,
	        des: serviceDes,
	        img: serviceImg,

	    })
		.then(function(response) {
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
		}).catch(function (error) {
			console.log(error);
		});
	}
}