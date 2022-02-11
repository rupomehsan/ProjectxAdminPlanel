@extends('layouts.admin.index')
@section('content')
    <!-- ======= Main Content Section ======= -->
    <!-- ======= Main Content Section ======= -->
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-10 col-12">
                    <div class="card p-3 border-0">
                        <div class="card-body ">
                            <h1 class="pagetitle">Add Blog</h1>
                            <form action="{{url('api/blog/store')}}" id="form" name="form" novalidate>
                                <!-- Blog Title -->
                                <div class="customInput mt-5">
                                    <input placeholder=" " id="title" name="title" class="form-control" type="text">
                                    <label for="title">Title</label>
                                </div>
                                <div class="text-danger" id="title_error"></div>

                                <!-- Description -->
                                <div class="my-3">
                                    <textarea name="description" id="description" placeholder="Description"></textarea>
                                </div>
                                <div class="text-danger" id="description_error"></div>

                                <!-- Blog Image -->
                                <div class="image my-3" id="image">
                                    <label for="image">Select Image</label>
                                    <div class="file-upload">
                                        <div class="image-upload-wrap">
                                            <input type="hidden" name="image" id="imageUrl">
                                            <input id="image" class="file-upload-input file-uploader" type='file' onchange="readURL(this);"
                                                   accept="image/*" />
                                            <div class="drag-text text-center">
                                                <span class="iconify" data-icon="teenyicons:user-square-outline"></span> <br>
                                                <span>Upload Image Or Drag Here</span>
                                            </div>
                                        </div>
                                        <div class="file-upload-content">
                                            <img class="file-upload-image" src="#" alt="your image" />
                                            <div class="image-title-wrap">
                                                <button type="button" onclick="removeUpload()" class="remove-image">
                                                    <span class="iconify" data-icon="akar-icons:cross"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button id="submit-button" type="submit" class="btn btn-primary waves-effect mb-3">
                                    Create
                                </button>

                                <a href="" class="btn btn-outline-secondary mb-3">Cancel</a>

                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </section>

    </main>
    <!-- ======= End Main Content Section ======= -->
    <!-- ======= End Main Content Section ======= -->
@endsection
@push('custom-js')
    <script>
        let descriptionEditor;
        ClassicEditor.create(document.querySelector('#description'))
            .then(editor => {
                window.editor = editor;
                descriptionEditor = editor;
            });


        $(document).on("change", ".file-uploader", function(e) {
            e.preventDefault();
            var file = e.target.files[0];
            let formData = new FormData()
            formData.append('file', file);
            formData.append('folder', 'blog');
            var showurl = window.origin + '/api/blog/file-upload';
            // alert(showurl);
            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            $.ajax({
                url: showurl,
                type: 'POST',
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization' : localStorage.getItem('token'),
                },
                data: formData,
                success: function(res) {
                    console.log(res);
                    toastr.success('File Upload successfully');
                    $("#imageUrl").val(res.data);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                    toastr.error('Error', 'Something went wrong', options);
                }
            });
        });

    </script>


    <script>
        /***
         * Form Submit
         * */
        $('#form').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            formSubmit("post", "submit-button", form);
        })
    </script>














    @endpush
