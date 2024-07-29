<?php
$(document).ready(function() {
    showStudents();

    $('#studentForm').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        
        let id = $('#studentId').val();
        let name = $('#studentName').val();
        let email = $('#studentEmail').val();
        let address = $('#studentAddress').val();
        let file = $('#studentFile').prop('files')[0]; // Get the file object

        let formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('address', address);
        formData.append('file', file);
        
        if (id) {
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
        } else {
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

    function showStudents() {
        $.get('read.php', function(data) {
            let students = JSON.parse(data);
            
            let rows = '';
            $.each(students, function(index, student) {
                rows += `<tr data-id="${student.id}">
                            <td>${student.id}</td>
                            <td class="name">${student.name}</td>
                            <td class="email">${student.email}</td>
                            <td class="address">${student.address}</td>
                            <td class="image">${student.file}</td>
                            <td>
                                <button class="edit-btn">Edit</button>
                                <button class="delete-btn" data-id="${student.id}">Delete</button>
                            </td>
                         </tr>`;
            });
            $('#studentTable tbody').html(rows);
        });
    }

    // Handle the Edit button click
    $(document).on('click', '.edit-btn', function() {
        let row = $(this).closest('tr');
        $('#studentId').val(row.data('id'));
        $('#studentName').val(row.find('.name').text());
        $('#studentEmail').val(row.find('.email').text());
        $('#studentAddress').val(row.find('.address').text());
        // Note: File input can't be set programmatically due to security reasons
    });
});

?>