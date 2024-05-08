<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax curd - laravel</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!--jquery ajax-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    {{-- create user modal --}}
    <div class="modal" tabindex="-1" role="dialog" id="addUserModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="adduser">

                        <div class="form-group">
                            <label for="exampleInputfname">First Name</label>
                            <input type="text" class="form-control" name="firstname" id="firstname"
                                placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputlname">Last Name</label>
                            <input type="text" class="form-control" name="lastname" id="lastname"
                                placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputphone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone"
                                placeholder="phone no.">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="text" class="form-control" name="email" id="email"
                                placeholder="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputcomment">Comment</label>
                            <input type="text" class="form-control" name="comment" id="comment"
                                placeholder="comment here">
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Submit" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end Modal For create User --}}


    {{-- add user button --}}
    <div class="container mt-5">
        <button id="adduserbtn" class="btn btn-info">Add new user</button>
    </div>
    {{-- end user button --}}


    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit & Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <ul id="update_msgList"></ul>

                    <input type="hidden" id="eid" />

                    <div class="form-group mb-3">
                        <label for="">Full Name</label>
                        <input type="text" id="ename" required class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input type="text" id="eemail" required class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary update_user">Update</button>
                </div>

            </div>
        </div>
    </div>
    {{-- Edn- Edit Modal --}}

    {{-- Delete User Modal  --}}
    <div class="modal" tabindex="-1" role="dialog" id="deleteUserModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure delete the selected user.</p>
                </div>
                <div class="modal-footer">
                    <button id="btn-delete" type="button" class="btn btn-primary">delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end Modal For Delete User --}}
    <div class="container mt-5">
        <button class="btn btn-dark" type="button" onclick="tableToCSV()">
            Export
        </button>
    </div>
    <div class="container mt-5">
        <form id="datefilter" method="POST" action="{{ route('datefilter') }}">
            @csrf
            <label for="fromdate">From</label>
            <input type="date" name="fromdate" id="fromdate">
            {{-- <label for="todate">To</label>
            <input type="date" name="todate" id="todate"> --}}
            <input type="submit" value="Filter">
        </form>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th colspan="2">Comments</th>
                </tr>
            </thead>
            <tbody id="tablebody">

            </tbody>
        </table>
    </div>

    <!--bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            fetchusers();

            //fetch all users
            function fetchusers() {
                jQuery.ajax({
                    url: "{{ route('index') }}",
                    method: "GET",
                    dataType: 'json',
                    success: function(data) {
                        // $("#tablebody").empty();
                        $.each(data.user, function(key, value) {
                            $("#tablebody").append(
                                '<tr id="id_' + value.id + '">\
                                                         <td>' + value.id + '</td>\
                                                         <td>' + value.firstname + '</td>\
                                                         <td>' + value.lastname + '</td>\
                                                         <td>' + value.phone + '</td>\
                                                         <td>' + value.email + '</td>\
                                                         <td>' + value.comment + '</td>\
                                                         </tr>'
                            );
                        })
                    }
                })
            }

            //add new user
            $('#adduserbtn').on('click', function() {
                $('#addUserModal').modal('show');

            })

            $('#adduser').on('submit', function(event) {
                event.preventDefault(); // prevent reload
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ route('add') }}",
                    data: jQuery("#adduser").serialize(),
                    dataType: 'json',
                    type: "POST",
                    success: function(value) {
                        jQuery("#adduser")[0].reset();
                        $("#tablebody").append('<tr id="id_' + value.user.id + '">\
                                                         <td>' + value.user.id + '</td>\
                                                         <td>' + value.user.firstname + '</td>\
                                                         <td>' + value.user.lastname + '</td>\
                                                         <td>' + value.user.phone + '</td>\
                                                         <td>' + value.user.email + '</td>\
                                                         <td>' + value.user.comment + '</td>\
                                                         </tr>');
                    }
                })
                $('#addUserModal').modal('hide');

            })

            //filter
            $('#datefilter').on('submit', function(event) {
                event.preventDefault(); // prevent reload
                var data = {
                    'fromdate': $('#fromdate').val(),
                    'todate': $('#todate').val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ route('datefilter') }}",
                    data: data,
                    dataType: 'json',
                    type: "POST",
                    success: function(data) {
                        console.log(data)
                        $("#tablebody").empty();
                        $.each(data.user, function(key, value) {
                            $("#tablebody").append(
                                '<tr id="id_' + value.id + '">\
                                                         <td>' + value.id + '</td>\
                                                         <td>' + value.firstname + '</td>\
                                                         <td>' + value.lastname + '</td>\
                                                         <td>' + value.phone + '</td>\
                                                         <td>' + value.email + '</td>\
                                                         <td>' + value.comment + '</td>\
                                                         </tr>'
                            );
                        })
                    }
                })

               /*  //edit user
                $(document).on('click', '.editbtn', function(e) {
                    e.preventDefault();
                    var id = $(this).val();

                    jQuery.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        url: "/edit/" + id,
                        method: 'GET',
                        success: function(result) {
                            $('#editModal').modal('show');
                            $('#eid').val(result.user.id);
                            $('#ename').val(result.user.name);
                            $('#eemail').val(result.user.email);

                        }
                    });

                })

                //update user 
                $(document).on('click', '.update_user', function(e) {
                    e.preventDefault();
                    let id = $('#eid').val();
                    var data = {
                        'name': $('#ename').val(),
                        'email': $('#eemail').val(),
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '/update/' + id,
                        type: "PUT",
                        data: data,
                        success: function(response) {
                            $("#editModal").modal('hide');
                            $('#id_' + response.user.id + ' td:nth-child(2)').text(
                                response.user.name);
                            $('#id_' + response.user.id + ' td:nth-child(3)').text(
                                response.user.email);
                        }
                    })
                })

                //delete user
                $(document).on('click', '.deletebtn', function(event) {
                    event.preventDefault();

                    let id = $(this).val();
                    $('#deleteUserModal').modal('show');
                    $('#btn-delete').on('click', function(event) {
                        event.preventDefault();

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            }
                        });

                        $.ajax({
                            url: "/deleteuser/" + id,
                            method: 'POST',
                            data: id,
                            success: function(data) {
                                console.log(data.user.name);
                                $('#deleteUserModal').modal('hide');
                                $('#id_' + data.user.id).remove();
                            }
                        })
                    })
                })
            })
        })
 */
        //export 
        function tableToCSV() {

            // Variable to store the final csv data
            let csv_data = [];

            // Get each row data
            let rows = document.getElementsByTagName('tr');
            for (let i = 0; i < rows.length; i++) {

                // Get each column data
                let cols = rows[i].querySelectorAll('td,th');

                // Stores each csv row data
                let csvrow = [];
                for (let j = 0; j < cols.length; j++) {

                    // Get the text data of each cell
                    // of a row and push it to csvrow
                    csvrow.push(cols[j].innerHTML);
                }

                // Combine each column value with comma
                csv_data.push(csvrow.join(","));
            }

            // Combine each row data with new line character
            csv_data = csv_data.join('\n');

            // Call this function to download csv file  
            downloadCSVFile(csv_data);

        }

        function downloadCSVFile(csv_data) {

            // Create CSV file object and feed
            // our csv_data into it
            CSVFile = new Blob([csv_data], {
                type: "text/csv"
            });

            // Create to temporary link to initiate
            // download process
            let temp_link = document.createElement('a');

            // Download csv file
            temp_link.download = "example.csv";
            let url = window.URL.createObjectURL(CSVFile);
            temp_link.href = url;

            // This link should not be displayed
            temp_link.style.display = "none";
            document.body.appendChild(temp_link);

            // Automatically click the link to
            // trigger download
            temp_link.click();
            document.body.removeChild(temp_link);
        }
    </script>
</body>

</html>
