@extends('layouts.admin.index')
@section('content')
    <!-- ===== Main Section ===== -->
    <main id="main" class="main setting">
        <h1 class="pagetitle">Basic Setting</h1>

        <!-- ===== Create Settings Section ===== -->
        <section class="section mt-5">
            <!-- create form -->
            <form action="{{url('api/setting/store')}}" id="form" name="form" novalidate>
                <!-- basic settings -->
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <!-- System Name -->
                        <div class="customInput ">
                            <input type="text" placeholder=" " id="system_name" name="system_name"
                                   class="form-control"/>
                            <label for="system_name">System Name</label>
                        </div>
                        <div class="text-danger mb-4" id="system_name_error"></div>

                        <!-- App Version -->
                        <div class="customInput ">
                            <input type="text" placeholder=" " id="app_version" name="app_version"
                                   class="form-control form-control-lg  bg-white"/>
                            <label for="app_version">App Version</label>
                        </div>
                        <div class="text-danger mb-4" id="app_version_error"></div>

                        <!-- Email -->
                        <div class="customInput ">
                            <input type="email" placeholder=" " id="mail_address" name="mail_address" class="form-control form-control-lg  bg-white"/>
                            <label class="form-label" for="mail_address">Email</label>
                        </div>
                        <div class="text-danger mb-4" id="email_error"> </div>


                        <!-- Update App -->
                        <div class="customInput ">
                            <input type="text" placeholder=" " id="update_app" name="update_app"
                                   class="form-control form-control-lg  bg-white"/>
                            <label class="form-label" for="update_app">Update App</label>
                        </div>
                        <div class="text-danger mb-4" id="update_app_error"></div>


                        <!-- Developed By -->
                        <div class="customInput ">
                            <input type="text" placeholder=" " id="developed_by" name="developed_by"
                                   class="form-control form-control-lg  bg-white"/>
                            <label class="form-label" for="developed_by">Developed By</label>
                        </div>
                        <div class="text-danger mb-4" id="developed_by_error"> </div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <!-- Facebook Link -->
                        <div class="customInput ">
                            <input type="text" placeholder=" " id="facebook" name="facebook"
                                   class="form-control form-control-lg  bg-white"/>
                            <label class="form-label" for="facebook">Facebook Link</label>
                        </div>
                        <div class="text-danger mb-4" id="facebook_error"></div>

                        <!-- Instagram Link -->
                        <div class="customInput ">
                            <input type="text" placeholder=" " id="instagram" name="instagram"
                                   class="form-control form-control-lg  bg-white"/>
                            <label class="form-label" for="instagram">Instagram Link</label>
                        </div>
                        <div class="text-danger mb-4" id="instagram_error"> </div>

                        <!-- Twitter Link -->
                        <div class="customInput ">
                            <input type="text" placeholder=" " id="twitter" name="twitter"
                                   class="form-control form-control-lg  bg-white"/>
                            <label class="form-label" for="twitter">Twitter Link</label>
                        </div>
                        <div class="text-danger mb-4"  id="twitter_error"></div>

                        <!-- Twitter Link -->
                        <div class="customInput ">
                            <input type="text" placeholder=" " id="youtube" name="youtube"
                                   class="form-control form-control-lg  bg-white"/>
                            <label class="form-label" for="youtube">Youtube Link</label>
                        </div>
                        <div class="text-danger mb-4" id="youtube_error"></div>
                    </div>
                </div>

                <!-- other settings -->
                <h1 class="pagetitle mt-3   ">Other Setting</h1>


                <div class="row mt-5">
                    <div class="col-lg-6 col-12">
                        <div class="customInput ">
                            <input type="text" placeholder=" " id="copyright" name="copyright"
                                   class="form-control form-control-lg  bg-white"/>
                            <label class="form-label" for="copyright">Copyright</label>
                        </div>
                        <div class="text-danger " id="copyright_error"></div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="image" id="image">
                            <label for="image" class="mb-2">Logo</label>
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
                    </div>
                </div>

                <!-- Description -->
                <div class="my-3">
                    <textarea name="description" id="description" placeholder="Description"></textarea>
                </div>

                <!-- Privacy Policy -->
                <div class="my-3">
                    <textarea name="privacy_policy" id="privacy_policy" placeholder="Privacy Policy" class="mb-3"></textarea>
                </div>

                <!-- Cookies Policy -->
                <div class="my-3">
                    <textarea name="cookies_policy" id="cookies_policy" placeholder="Cookies Policy"></textarea>
                </div>


                <!-- Terms & Policy -->
                <div class="my-3">
                    <textarea name="terms_policy" id="terms_policy" placeholder="Terms & Policy"></textarea>
                </div>



                <button id="submit-button" type="submit" class="btn btn-primary primary-btn  waves-effect mb-3">
                    Create
                </button>

                <a href="../index.php" class="btn btn-outline-secondary mb-3">
                    Cancel
                </a>
            </form>

        </section>
        <!-- ===== End Create Settings Section ===== -->
    </main>
    <!-- ===== Emd Main Section ===== -->
@endsection
@push('custom-js')
    <script>
        /* editor */
        let descriptionEditor;
        ClassicEditor.create(document.querySelector('#description'))
            .then(editor => {
                window.editor = editor;
                descriptionEditor = editor;
            });

        let privacyEditor;
        ClassicEditor.create(document.querySelector('#privacy_policy'))
            .then(editor => {
                window.editor = editor;
                privacyEditor = editor;
            });

        let cookiesEditor;
        ClassicEditor.create(document.querySelector('#cookies_policy'))
            .then(editor => {
                window.editor = editor;
                cookiesEditor = editor;
            });
        let termsEditor;
        ClassicEditor.create(document.querySelector('#terms_policy'))
            .then(editor => {
                window.editor = editor;
                termsEditor = editor;
            });

        var url = "{{url('api/setting/show')}}";
        getEditData(url);
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
            formData.append('folder', 'setting');
            var showurl = window.origin + '/api/setting/file-upload';
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

