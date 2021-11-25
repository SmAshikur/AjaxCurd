<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <script src="{{asset('js/app.js')}}"></script>
    </head>
    <body >
        <div class="container p-5 bg-success" id="app"  >
            <div class="mb-5 bg-danger">
                <marquee> <h1 class="text-success b">Ajax curd</h1></marquee>
                <button id="butOne">clcgcnc</button>
            </div>
            <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">

                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                        <tbody>


                                        </tbody>
                                 </table>
                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="card">
                            <div class="card-header">
                                <h2>Form</h2>
                            </div>

                               <div class="card-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="name" class="form-contorl"><br>
                                        <span id="nameError" class="text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <textarea class="form-contorl" id="address"></textarea><br>
                                        <span id="addressError" class="text-danger"></span>
                                    </div>
                               </div>
                                <div class="card-footer">
                                    <div class="form-group d-flex justify-content-center">
                                        <button id="b1" type="submit" class="btn btn-success">Add</button>
                                     </div>
                                     <div class="form-group d-flex justify-content-center">
                                        <button id="b2"  type="submit" class="btn btn-success"> Update</button>
                                     </div>
                                </div>

                        </div>
                    </div>
                </div>

            </div>



       <script>
           $(document).ready(function(){
                $('#b2').hide();
                $.ajaxSetup({
                     headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                 });
                 allData();
                function allData(){
                    $.ajax({
                    type:'GET',
                    datatype:'json',
                    url:"/ajax/get",
                    success: function(response){
                        $('tbody').html(" ")
                       $.each(response, function(key,value){
                            $('tbody').append('<tr>\
                                <td>'+value.id+'</td>\
                                <td>'+value.name+'</td>\
                                <td>'+value.address+'</td>\
                                <td><button type="button" value="'+value.id+'" class="butOne">Edit</button></td>\
                                <td><button value="'+value.id+'" class="butTwo">Add</button></td>\
                            </tr>');
                       })

                    }

                 });

                }
                $(document).on('click','.butOne',function () {
                            var x= $(this).val();
                            console.log(x)
                    });

                function resetData(){
                    $("#nameError").text( '')
                    $("#addressError").text( '')
                    $('#name').val('');
                    $('#address').val('');
                }

                $("#b1").click(function(){
                        var name = $('#name').val();
                        var address = $('#address').val();
                        console.log(name);
                        console.log(address);
                        $.ajax({
                            type:'POST',
                            datatype:'json',
                            data:{name:name,address:address},
                            url:"/ajax/add",
                            success: function(response){
                                resetData()
                                allData();
                            },
                            error:function(error){
                                $("#nameError").text(error.responseJSON.errors.name)
                                $("#addressError").text(error.responseJSON.errors.address)
                                console.log(error.responseJSON.errors.name);
                            }

                        })

                    });
                    $(".butOne").click(function(){
                            console.log('vai')
                            $('#b2').show();
                            $('#b1').hide();
                         });
                 $(".butTwo").click(function(){
                            console.log('vai')
                            $('#b2').show();
                            $('#b1').hide();
                     });






            });


       </script>
    </body>
</html>
