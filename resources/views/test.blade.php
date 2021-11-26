<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="sweetalert2.all.min.js"></script>

</head>
<body>
    <div class="container bg-success p-5  " id="app">
        <div class="row bg-danger mb-5" >
            <marquee><h1 class=" text-success mb-2">How are you!</h1></marquee>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex">
                        <h3>Table</h3><button id="aTest" class="btn btn-success ml-auto">Add Test</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bodered table-stirped">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        Thank you
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 id="addTest">Add Test Form</h3>
                        <h3 id="editTest">Edit Test Form</h3>
                    </div>
                    <div class="card-body">
                       <div class="form-group">
                           <label for="name">Test Name</label>
                           <input id='name' placeholder="Enter Name" class="form-control"><br>
                           <span id="nameErr" class="text-danger"></span>
                       </div>
                       <div class="form-group">
                           <label>Test Address</label>
                           <input id='address' placeholder="Enter Address" class="form-control"><br>
                           <span id="addressErr" class="text-danger"></span>
                       </div>
                       <input type="hidden" id="id">
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button type="submit" id="btOne" class="btn btn-success btn-small">Add Test</button>
                        <button type="submit" id="btTwo" class="btn btn-success btn-small">Update Test</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {

            $("#btTwo").hide();
            $("#editTest").hide();
            function reset(){
                $("#nameErr").text('')
                $("#addressErr").text('')
                $('#name').val('');
                $('#address').val('');
            }
            $.ajaxSetup({
                     headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                 });
            //add test
            $(document).on('click','#aTest', function () {
                $("#btTwo").hide();
                $("#editTest").hide();
                $("#btOne").show();
                $("#addTest").show();
                reset();
            });

            $(document).on('click','#btOne', function () {
                var name= $('#name').val();
                var address= $('#address').val();
                console.log(name)
                console.log(address)

                $.ajax({
                    type: "POST",
                    url: "/test/add",
                    data: {name:name,address:address},
                    dataType: "json",
                    success: function (response) {
                        reset();
                        getData();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Add successfully',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        console.log("update successfully")
                    },error: function(error){
                        $("#nameErr").text(error.responseJSON.errors.name)
                        $("#addressErr").text(error.responseJSON.errors.address)
                        //console.log(error.responseJSON.errors.name)
                    }
                });

            });
            //get test
            function getData(){
                $.ajax({
                    type: "GET",
                    url: "test/get",
                    data: "data",
                    dataType: "json",
                    success: function (response) {
                        console.log(response)
                        $('tbody').html(" ")
                        $.each(response, function(key,value){
                          $('tbody').append(
                              '<tr>\
                              <td>'+value.id+'</td>\
                              <td>'+value.name+'</td>\
                              <td>'+value.address+'</td>\
                              <td><button value="'+value.id+'" type="button" class="editBt btn btn-primary">Edit</button></td>\
                              <td><button value="'+value.id+'" type="button" class="delBt btn btn-danger">Delete</button></td>\
                              </tr>');
                        })
                    },error: function(error){
                        console.log('error hoise')
                    }
                });
            }
            getData();
            //edit test
            $(document).on('click','.editBt', function () {
                var id = $(this).val();
                //alert(id);
                $("#btOne").hide();
                $("#addTest").hide();
                $("#btTwo").show();
                $("#editTest").show();
                $.ajax({
                    type: "GET",
                    url: "test/edit/"+id,
                    data: "data",
                    dataType: "json",
                    success: function (response) {
                        console.log(response)
                        $('#name').val(response.name);
                        $('#address').val(response.address);
                        $('#id').val(response.id);
                    }
                });

            });
            //update test
            $(document).on('click','#btTwo', function () {
                var name= $('#name').val();
                var address= $('#address').val();
                var id= $('#id').val();
                console.log(name)
                console.log(address)

                $.ajax({
                    type: "POST",
                    url: "/test/update/"+id,
                    data: {name:name,address:address},
                    dataType: "json",
                    success: function (response) {
                        reset();
                        getData();
                        $("#btTwo").hide();
                        $("#editTest").hide();
                        $("#btOne").show();
                        $("#addTest").show();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Update successfully',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        console.log("update successfully")
                    },error: function(error){
                        $("#nameErr").text(error.responseJSON.errors.name)
                        $("#addressErr").text(error.responseJSON.errors.address)
                        //console.log(error.responseJSON.errors.name)
                    }
                });

            });
            //delete test
            $(document).on('click','.delBt', function () {
                var id = $(this).val();
               // alert(id);
               Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "test/del/"+id,
                            success: function (response) {
                                getData();
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Delete successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                console.log('Delete Successfully')
                            }
                        });
                    }
                    })



            });

        });
    </script>
</body>
</html>
