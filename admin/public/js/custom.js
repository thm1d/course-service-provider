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
	    		"<td><a href='' ><i class='fas fa-edit'></i></a></td>"+
	    		"<td><a class='serviceDeleteBtn' data-id="+dataJSON[i].id+"><i class='fas fa-trash-alt'></i></a></td>").appendTo('#service_table');
	   		});


	   		$('.serviceDeleteBtn').click(function(){
	   			var id = $(this).data('id');

	   			$('#serviceId').html(id);
	   			$('#deleteModal').modal('show');
	   		})

	   		$('#deleteConfirmBtn').click(function(){
	   			var id = $('#serviceId').html();
 
	   			deleteServicesData(id);
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
			
			getServicesData();
		}
		else {
			$('#deleteModal').modal('hide');
			getServicesData();
		}
	}).catch(function (error) {
		
	});
}