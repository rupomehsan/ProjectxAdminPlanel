@extends('layouts.admin.index')
@section('content')
    <!-- ======= Main Content Section ======= -->
    <main id="main" class="main">

        <section class="section">
            <div class="row">
                <div class="col-lg-10 col-12">
                    <div class="card p-5 border-0">

                        <div class="card-body ">
                            <div class="row">
                                <div class="col-lg-7 col-12 ">
                                    <h1 class="pagetitle">Profile</h1>
                                </div>
                                <div class="col-lg-5 col-12 text-end ">
                                    <a href="{{url('admin/manage-admin/change-password')}}" class="btn btn-primary">Change Password</a>
                                </div>
                            </div>

                            <form action="{{url('api/manage-admin/profile/update')}}" id="form" name="form" novalidate>

                                <!-- Name -->
                                <div class="customInput mt-5">

                                    <input type="hidden" id="id" name="id" class="form-control">
                                    <input placeholder=" " id="name" name="name" class="form-control" type="text">
                                    <label for="name">Name</label>
                                </div>
                                <div class="text-danger" id="name_error"></div>



{{--                                <!-- Email -->--}}
{{--                                <div class="customInput mt-3">--}}
{{--                                    <input placeholder=" " id="email" name="email" class="form-control" type="email">--}}
{{--                                    <label for="email">Email</label>--}}
{{--                                </div>--}}
{{--                                <div class="text-danger" id="email_error">error msg</div>--}}

                                <!-- Phone -->
                                <div class="customInput mt-3">
                                    <input placeholder=" " id="phone" name="phone" class="form-control" type="tel">
                                    <label for="phone">Phone</label>
                                </div>
                                <div class="text-danger" id="phone_error"></div>




                                <div class="image my-3" id="image">
                                    <label for="image">Select Image</label>
                                    <div class="file-upload-edit">
                                        <div class="image-upload-wrap-edit">
                                            <input type="hidden" name="image" id="imageUrl">
                                            <input value="" name="image" class="file-upload-input-edit file-uploader" type='file' onchange="readURLEdit(this);" accept="image/*" />
                                            <div class="drag-text-edit text-center">
                                                <span class="iconify" data-icon="bx:bx-image-alt"></span> <br>
                                                <span>Upload Image Or Drag Here</span>
                                            </div>
                                        </div>
                                        <div class="file-upload-content-edit">
                                            <img class="file-upload-image-edit" src="" alt="" />
                                            <div class="image-title-wrap-edit">
                                                <button type="button" onclick="removeUploadEdit()" class="remove-image-edit">
                                                    <span class="iconify" data-icon="akar-icons:cross"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button id="submit-button" type="submit" class="btn btn-primary waves-effect mb-3">
                                    Update
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


@endsection

@push('custom-js')
    <script>
        let userData = JSON.parse(localStorage.getItem('userData')) || null
        if(userData){
            $('#name').val(userData.name)
            $('#id').val(userData.id)
            $('#phone').val(userData.phone)
            $('.file-upload-image-edit').attr('src',userData.image)
        }

        $('#form').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            formSubmit("patch", "submit-button", form);
        })
        $(document).on("change", ".file-uploader", function(e) {
            e.preventDefault();
            var file = e.target.files[0];
            let formData = new FormData()
            formData.append('file', file);
            formData.append('folder', 'admin');
            var showurl = window.origin + '/api/admin/file-upload';
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
