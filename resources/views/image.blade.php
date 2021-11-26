@extends('layouts.app')
@section('content')
<div class="container-fluid px-5 pb-5 bg-success" id="app">
    <div class="row bg-danger">
        <marquee><h1><b>How are you!</b></h1></marquee>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex">
                    <h3>Image Table</h3>
                    <button class="ml-auto btn btn-success" id="addI" > Add Image</button>
                </div>
                <div class="card-body">
                    <div class="king row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    hello
                                </div>
                                <div class="card-body">
                                    <img src="{{asset('images/1637960767.jpg')}}"width="100%" height="100%">
                                </div>
                                <div class="card-footer">
                                    hi
                                    hello
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    hello
                                </div>
                                <div class="card-body">
                                    <img src="{{asset('images/1637960767.jpg')}}"width="100%" height="100%">
                                </div>
                                <div class="card-footer">
                                    hi
                                    hello
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    hello
                                </div>
                                <div class="card-body">
                                    <img src="{{asset('images/1637960767.jpg')}}"width="100%" height="100%">
                                </div>
                                <div class="card-footer">
                                    hi
                                    hello
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    thank you
                </div>
            </div>
        </div>
        <div id="tbody" class="col-md-3 mt-5 ">
            <div class="card">
                <div class="card-header">
                    <h2 id="addh">Add Image</h2>
                    <h2 id="edith">Edit Image</h2>
                </div>
                <form method="post" id="ashik" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" id="name-input">
                        <span class="text-danger" id="name-input-error"></span>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" id="image-input">
                        <span class="text-danger" id="image-input-error"></span>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-success">Upload</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $("#edith").hide();
        $("#imgE").hide();
        $.ajaxSetup({
                     headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
//
    $('#ashik').submit(function(e) {
       e.preventDefault();
       let formData = new FormData(this);
       $('#image-input-error').text('');

       $.ajax({
          type:'POST',
          url: `/image/add`,
           data: formData,
           contentType: false,
           processData: false,
           success: (response) => {
             if (response) {
                getData();
               this.reset();
               alert('Image has been uploaded successfully');
             }
           },
           error: function(response){
              console.log(response);
                $('#image-input-error').text(response.responseJSON.errors.image);
           }
       });
        });
        //
        function getData(){
                $.ajax({
                    type: "GET",
                    url: "image/get",
                    data: "data",
                    dataType: "json",
                    success: function (response) {
                        console.log(response)
                        $('.king').html(" ")
                        $.each(response, function(key,value){
                          $('.king').append(
                            '<div class="col-md-3">\
                            <div class="card">\
                                <div class="card-header justify-content-center">\
                                    <h2>  </h2>\
                                </div>\
                                <div class="card-body">\
                                    <img src="images/'+value.image+'" width="100%" height="100%">\
                                </div>\
                                <div class="card-footer d-flex justify-content-between">\
                                    <button class="editB btn btn-success">Edit</button>\
                                    <button class="delB btn btn-danger">Delete</button>\
                                </div>\
                            </div>\
                        </div>'
                            );
                          })
                    },error: function(error){
                        console.log('error hoise')
                    }
                });
            }
            getData();

    });
</script>

@endsection
