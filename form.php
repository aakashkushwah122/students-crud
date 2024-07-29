<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Include jQuery before Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    
</head>
<body>
    <div class="container">
        <h1>Students Details</h1>
        <form action="" method="post" id="studentForm">
            <input type="hidden" id="studentId" class="form-control"><br>
            Name: <input type="text" id="studentName" class="form-control" placeholder="Enter Your Name" required><br>
            Email: <input type="email" id="studentEmail" class="form-control" placeholder="Enter Your Email" required><br>
            Address: <input type="text" id="studentAddress" class="form-control" placeholder="Enter Your Address"><br>
            <!-- File: <input type="file" id="studentFile" class="form-control"> -->
            <input type="file" id="studentFile" class="form-control">
            <input type="text" id="studentFileName" class="form-control" readonly>

            <input type="submit" name="submit" id="add-btn" class="btn btn-primary">
        </form>

        <table id="studentTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>


</div>
</body>
<script>
    
    $(document).ready(function() {
        showStudents();

// create & update
        $('#studentForm').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            alert("hello all");
            let id = $('#studentId').val();
            let name = $('#studentName').val();
            let email = $('#studentEmail').val();
            let address = $('#studentAddress').val();
            let file = $('#studentFile').val();
            

            // console.log(id, name, email, address, file);
            let formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('address', address);
            formData.append('file', file);
            if(id){
                    // $.post('update.php', { name, email, address, file }, function(response) {
                    // alert(response);
                    // $('#studentForm')[0].reset();
                    // showStudents();
                    // });
                    formData.append('id', id);
                $.ajax({
                    url: 'update.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert(response);
                        $('#studentForm')[0].reset();
                        showStudents();
                    }
                });
            }else{
                // $.post('create.php', { name, email, address, file }, function(response) {
                // alert(response);
                // $('#studentForm')[0].reset();
                // showStudents();
                // });
                $.ajax({
                url: 'create.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert(response);
                    $('#studentForm')[0].reset();
                    showStudents();
                }
            });
            }
        });

// read 
        function showStudents() {
            // console.log("Users loaded");
            // alert("user loaded....");
            $.get('read.php', function(data) {
            let students = JSON.parse(data);
            console.log(students);
            
            let rows = '';
            $.each(students, function(index, student) {
                    rows += `<tr data-id="${student.id}">
                                <td>${student.id}</td>
                                <td class="name">${student.name}</td>
                                <td class="email">${student.email}</td>
                                <td class="address">${student.address}</td>
                                <td class="file">${student.file}</td>
                                <td>
                                    <button class="edit-btn">Edit</button>
                                    <button class="delete-btn" data-id="${student.id}">Delete</button>
                                </td>
                            </tr>`;
                });
                $('#studentTable tbody').html(rows);
            });

        }

// update file
        $(document).on('click', '.edit-btn', function() {
            let row = $(this).closest('tr');
            $('#studentId').val(row.data('id'));
            $('#studentName').val(row.find('.name').text());
            $('#studentEmail').val(row.find('.email').text());
            $('#studentAddress').val(row.find('.address').text());
            // $('#studentFile').val(row.find('.file').text());
            $('#studentFileName').val(row.find('.file').text());
            // if ($('#studentFile').length) {
            // }

        });

        // delete file
        $(document).on('click', '.delete-btn', function() {
        //    alert("done");
            if (confirm('Are you sure you want to delete this user?')) {
                let id = $(this).data('id');
                $.post('delete.php', { id }, function(response) {
                    alert(response);
                    showStudents();
                });
            }
        });
        
    });

</script>
</html>