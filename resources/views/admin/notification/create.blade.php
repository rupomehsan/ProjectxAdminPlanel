@extends('layouts.admin.index')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="card p-5 border-0">

                        <div class="card-body ">
                            <h1 class="pagetitle">Add Notification</h1>
                            <form action="{{url('api/notification/send-notification')}}" id="form" name="form" novalidate>

                                <!-- Notification Title -->
                                <div class="customInput mt-5">
                                    <input placeholder=" " id="title" name="title" class="form-control" type="text">
                                    <label for="title">Title</label>
                                </div>
                                <div class="text-danger" id="title_error"> </div>

                                <!-- Notification Description -->
                                <div class="my-3">
                                    <textarea name="description" id="description" placeholder="Description"></textarea>
                                </div>


                                <!-- Notification Image -->
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

                                <!-- Select Blog For Notification -->
                                <select class="form-select py-3 mt-3" id="blog_id" name="blog_id">
                                    <option value="0">Select Blog</option>
                                </select>
                                <div class="text-danger" id="select_blog_error"></div>

                                <!-- Notification External Link -->
                                <div class="customInput mt-4">
                                    <input placeholder=" " id="link" name="link" class="form-control" type="text">
                                    <label for="link">External Link</label>
                                </div>
                                <div class="text-danger mb-4" id="link_error"> </div>


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
@endsection
@push('custom-js')
    <script>
        let descriptionEditor;
        ClassicEditor.create(document.querySelector('#description'))
            .then(editor => {
                window.editor = editor;
                descriptionEditor = editor;
            });

        /***
         * Form Submit
         * */
        $('#form').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            formSubmit("post", "submit-button", form);
        })
        /**
         * GET All Blogs
         * */
        $(document).ready(function () {
            $.ajax({
                type: 'GET',
                url: "{{url('/api/blog/get-all')}}",
                success: function (response) {
                    if (response.status === 'success'){
                        response.data.forEach( item => {
                            $("#blog_id").append(`
                    <option value="${item.id}">${item.title}</option>
                 `)
                        })
                    }
                },
                error: function (xhr, resp, text) {
                    console.log(xhr, resp)
                }
            });
        })
        /**
         * Blog Select and Disable External Link
         * */
        $(document).on('change', '#blog_id', function (e) {
            let value = $(this).val();
            if (value !== '0') {
                $('#link').prop('disabled', true);
            } else {
                $('#link').prop('disabled', false);
            }
        });

        /**
         * Press External Link and Disable Blog
         * */
        $("#link").keyup(function(){
            let value = $(this).val();

            if (value !== '') {
                $("#blog_id").prop('disabled', true);
            } else {
                $('#blog_id').prop('disabled', false);
            }

        });
        /**
         * Image upload
         * */
        $(document).on("change", ".file-uploader", function(e) {
            e.preventDefault();
            var file = e.target.files[0];
            let formData = new FormData()
            formData.append('file', file);
            formData.append('folder', 'notification');
            var showurl = window.origin + '/api/notification/file-upload';
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


@endpush
