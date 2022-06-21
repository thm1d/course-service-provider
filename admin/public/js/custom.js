$(document).ready(function () {
$('#VisitorDt').DataTable();
$('.dataTables_length').addClass('bs-select');
});


function getServicesData(){
	axios.get('/getServicesData')
  	.then(function (response) {
    	var dataJSON=response.data;
    	$.each(dataJSON, function(i, item) {
    	$('<tr>').html(
    		"<td> <img class='table-img' src="+dataJSON[i].service_img+"> </td>"+
    		"<td>"+ dataJSON[i].service_name +"</td>"+
    		"<td>"+ dataJSON[i].service_des +"</td>"+
    		"<td><a href='' ><i class='fas fa-edit'></i></a></td>"+
    		"<td><a href='' ><i class='fas fa-edit'></i></a></td>").appendTo('#service_table');
   		});

	}).catch(function (error) {

});
}