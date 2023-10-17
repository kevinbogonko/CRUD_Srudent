<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body{
            width: 100%;
        }

        .wrapper {
            background-color: #f7f4f4;
            margin: 0 20px;
        }

        .exam-table {
            background-color: #ffffff;
            padding: 1.25rem;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 2px #818181;
        }


        @media only screen and (max-width: 768px) {

        .wrapper {
            background-color: #f7f4f4;
            margin: 0 20px;
        }

        .exam-table {
            width: 100%;
        }

        table{
                display: flex;
                flex-wrap: wrap;
        }
        .exam-table {
        background-color: #ffffff;
        padding: .45rem;
        margin-top: 10px;
        border-radius: 5px;
        box-shadow: 0 0 2px #818181;
        }

        table thead {
        display: none;
        margin-bottom: 0.55rem;
        overflow-x: scroll;
        }
    
        table tfoot {
        display: none;
        }
    
        table,
        tbody,
        tbody tr,
        tbody tr td {
            display: block;
            width: 100%;
        }
    
        table tbody tr {
            margin: 10px 0;
        }
    
        table tbody tr td {
            width: auto;
            height: 1.5rem;
            border-bottom: 1px solid #dee2e6;
            background-color: #f7f4f4;
        }
    
        table tbody tr td {
            text-align: right;
            padding-left: 50%;
            padding-right: 15px;
            padding-top: 5px;
            padding-bottom: 25px;
            position: relative;
            align-items: center;
            font-size: .85rem;
            font-weight: 400;
        }
    
        table td::before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 50%;
            text-align: left;
            padding-left: 10px;
            font-weight: 400;
        }

        .pagination{
            display: flex;
            flex-wrap: wrap;
        }


        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="exam-table">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentAddModal">Add Student</button>
        </div>
        <div class="exam-table">
            <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require 'dbcon.php';
                    $query = "SELECT * FROM students";
                    $query_run = mysqli_query($con, $query);

                    if(mysqli_num_rows($query_run) > 0){
                        foreach($query_run as $student){
                ?>
                <tr>
                    <td data-label="ID"><?= $student['id'] ?></td>
                    <td data-label="Name"><?= $student['name'] ?></td>
                    <td data-label="Email"><?= $student['email'] ?></td>
                    <td data-label="Phone"><?= $student['phone'] ?></td>
                    <td data-label="Course"><?= $student['course'] ?></td>
                    <td data-label="Action">
                        <button type="button" value="<?=$student['id'];?>" class="viewStudentBtn btn btn-info btn-sm"><i class="fa fa-eye"></i> View</button>
                        <button type="button" value="<?=$student['id'];?>" class="editStudentBtn btn btn-success btn-sm"><i class="fa fa-pencil"></i> Edit</button>
                        <button type="button" value="<?=$student['id'];?>" class="deleteStudentBtn btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                    </td>
                </tr>
                <?php
                    }
                        }
                ?>

            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </tfoot>
            </table>
            <div style="clear:both"></div>
        </div>
    </div>

    <div class="modal fade" id="studentAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="saveStudent">
                <div class="modal-body">

                    <div id="errorMessage" class="alert alert-warning d-none"></div>

                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Phone</label>
                        <input type="text" name="phone" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Course</label>
                        <input type="text" name="course" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Student</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateStudent">
                <div class="modal-body">

                    <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                    <input type="hidden" name="student_id" id="student_id" >

                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="text" name="email" id="email" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Course</label>
                        <input type="text" name="course" id="course" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Student</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- View Student Modal -->
    <div class="modal fade" id="studentViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="">Name</label>
                        <p id="view_name" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <p id="view_email" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label for="">Phone</label>
                        <p id="view_phone" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label for="">Course</label>
                        <p id="view_course" class="form-control"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>



    <script>
        new DataTable('#example', {
        pagingType: 'full_numbers'
        });
    </script>


    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

    <script>
        $(document).on('submit', '#saveStudent', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_student", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessage').addClass('d-none');
                        $('#studentAddModal').modal('hide');
                        $('#saveStudent')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#example').load(location.href + " #example");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editStudentBtn', function () {

            var student_id = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "code.php?student_id=" + student_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#student_id').val(res.data.id);
                        $('#name').val(res.data.name);
                        $('#email').val(res.data.email);
                        $('#phone').val(res.data.phone);
                        $('#course').val(res.data.course);

                        $('#studentEditModal').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateStudent', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_student", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessageUpdate').addClass('d-none');

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                        
                        $('#studentEditModal').modal('hide');
                        $('#updateStudent')[0].reset();

                        $('#example').load(location.href + " #example");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.viewStudentBtn', function () {

            var student_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "code.php?student_id=" + student_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#view_name').text(res.data.name);
                        $('#view_email').text(res.data.email);
                        $('#view_phone').text(res.data.phone);
                        $('#view_course').text(res.data.course);

                        $('#studentViewModal').modal('show');
                    }
                }
            });
        });

        $(document).on('click', '.deleteStudentBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?'))
            {
                var student_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'delete_student': true,
                        'student_id': student_id
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if(res.status == 500) {

                            alert(res.message);
                        }else{
                            alertify.set('notifier','position', 'top-right');
                            alertify.success(res.message);

                            $('#example').load(location.href + " #example");
                        }
                    }
                });
            }
        });

    </script>

</body>
</html>