@extends('layouts.admin.index')
@section('content')
    <!-- ======= Main Content Section ======= -->
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="card p-5 border-0">
                        <div class="card-body ">
                            <h1 class="pagetitle">Add Admin</h1>
                            <form action="{{url('api/manage-admin/store')}}" id="form" name="form" novalidate>
                                <!-- Name -->
                                <div class="customInput mt-5">
                                    <input placeholder=" " id="name" name="name" class="form-control" type="text">
                                    <label for="name">Name</label>
                                </div>
                                <div class="text-danger" id="name_error"></div>
                                <!-- Role -->
                                <div class="customSelect mt-4">
                                    <select class="customSelectText form-control" id="user_role_id" name="user_role_id" required>
                                        <option value="2" selected>Admin</option>
                                        <option value="1">Super Admin</option>
                                    </select>
                                    <label for="user_role_id" class="customSelectLabel">Select Admin Type</label>
                                </div>
                                <div class="text-danger" id="role_error"></div>
                                <!-- Email -->
                                <div class="customInput mt-3">
                                    <input placeholder=" " id="email" name="email" class="form-control" type="email">
                                    <label for="email">Email</label>
                                </div>
                                <div class="text-danger" id="email_error"></div>
                                <!-- Phone -->
                                <div class="customInput mt-3">
                                    <input placeholder=" " id="phone" name="phone" class="form-control" type="tel">
                                    <label for="phone">Phone</label>
                                </div>
                                <div class="text-danger" id="phone_error"></div>
                                <!-- Password -->
                                <div class="customInput mt-3">
                                    <input placeholder=" " id="password" name="password" class="form-control" type="password">
                                    <label for="password">Password</label>
                                </div>
                                <div class="text-danger" id="password_error"></div>
                                <!-- Access -->
                                <div class="row" id="access_control">
                                    <label for="" class="my-2">Access</label>
                                    <!-- Access For Manage Admin -->
                                    <div class="col-lg-4 col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="user" id="user" name="access[]" />
                                            <label class="form-check-label" for="user">User</label>
                                        </div>
                                    </div>
                                    <!-- Access For Manage Admin -->
                                    <div class="col-lg-4 col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="subscription" id="subscription" name="access[]" />
                                            <label class="form-check-label" for="subscription">Subscription</label>
                                        </div>
                                    </div>
                                    <!-- Access For Manage Admin -->
                                    <div class="col-lg-4 col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="api" id="api" name="access[]" />
                                            <label class="form-check-label" for="api">Weather Api</label>
                                        </div>
                                    </div>
                                    <!-- Access For Manage Admin -->
                                    <div class="col-lg-4 col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="blog" id="blog" name="access[]" />
                                            <label class="form-check-label" for="blog">Blog</label>
                                        </div>
                                    </div>

                                    <!-- Access For Advertisement -->
                                    <div class="col-lg-4 col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="advertisement" id="advertisement" name="access[]" />
                                            <label class="form-check-label" for="manage">Advertisement</label>
                                        </div>
                                    </div>
                                    <!-- Access For Notification -->
                                    <div class="col-lg-4 col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="notification" id="notification" name="access[]" />
                                            <label class="form-check-label" for="manage">Notification</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="setting" id="setting" name="access[]" />
                                            <label class="form-check-label" for="setting">Basic Settings</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="smtp" id="smtp" name="access[]" />
                                            <label class="form-check-label" for="manage">Smtp</label>
                                        </div>
                                    </div>
                                </div>


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
@endsection

@push('custom-js')
    <script>
        $(document).on('change', '#user_role_id', function () {
            let role = $(this).val()

            if (role === '1') {
                $('#access_control').hide()
            } else {
                $('#access_control').show()
            }
        })
        /***
         * Form Submit
         * */
        $('#form').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            formSubmit("post", "submit-button", form);
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
