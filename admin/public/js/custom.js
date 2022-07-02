
function getCoursesData(){
    axios.get('/getCoursesData')
    .then(function (response) {
        if(response.status==200) {
            $('#mainDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');

            $('#course_table').empty();

        
            var dataJSON=response.data;
            $.each(dataJSON, function(i, item) {
            $('<tr>').html(
                "<th class='th-sm'>"+dataJSON[i].course_name+"</th>"+
                "<th class='th-sm'>"+dataJSON[i].course_fee+"</th>"+
                "<th class='th-sm'>"+dataJSON[i].course_totalclass+"</th>"+
                "<th class='th-sm'>"+dataJSON[i].course_totalenroll+"</th>"+
                "<th><a class='courseDesBtn' data-id="+dataJSON[i].id+"><i class='fas fa-eye'></i></th>"+
                "<td><a class='courseEditBtn' data-id="+dataJSON[i].id+"><i class='fas fa-edit'></i></a></td>"+
                "<td><a class='courseDeleteBtn' data-id="+dataJSON[i].id+"><i class='fas fa-trash-alt'></i></a></td>").appendTo('#course_table');
            });
  

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