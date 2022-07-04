
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
$('#deleteConfirmBtn').click(function(){
    var id = $('#courseDeleteId').html();

    deleteCoursesData(id);
})


function deleteCoursesData(deleteId){
    $('#deleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); // spinner

    axios.post('/courseDelete', {id:deleteId})
    .then(function(response) {
        $('#deleteConfirmBtn').html("Yes");
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