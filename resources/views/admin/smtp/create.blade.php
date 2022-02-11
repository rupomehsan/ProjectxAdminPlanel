@extends('layouts.admin.index')
@section('content')
    <main id="main" class="main">
        <h1 class="pagetitle">Manage SMTP</h1>
        <section class="section mt-5">
            <div class="row">
                <div class="col-lg-10 col-12">
                    <div class="card p-3 border">
                        <div class="card-body">
                            <span class="card-title text-black smtp-card-title">Add SMTP</span>
                            <hr>
                            <form action="{{url('api/smtp/store')}}" id="form" name="form" novalidate>
                                <!-- SMTP Type -->
{{--                                <div class="row mb-3 align-items-center">--}}
{{--                                    <div class="col-lg-2 col-12">--}}
{{--                                        <label for="type" >Type <span class="text-danger">*</span>:</label>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-lg-10 col-12 ">--}}
{{--                                        <div class="d-flex align-items-center">--}}
{{--                                            <div class="form-check me-4">--}}
{{--                                                <input class="form-check-input" type="radio" name="type" value="gmail"--}}
{{--                                                       id="gmail_smtp">--}}
{{--                                                <label class="form-check-label" for="gmail_smtp">--}}
{{--                                                    Gmail SMTP--}}
{{--                                                </label>--}}
{{--                                            </div>--}}

{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="radio" value="server" name="type"--}}
{{--                                                       id="server_smtp">--}}
{{--                                                <label class="form-check-label" for="server_smtp">--}}
{{--                                                    Server SMTP--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <!-- SMTP HOST -->
                                <div class="customInput mt-4">
                                    <input placeholder=" " id="host" name="host" class="form-control" type="text">
                                    <label for="host">Host <span class="primary-color">*</span> </label>
                                </div>
                                <div class="text-danger" id="host_error"></div>

                                <!-- SMTP PORT -->
                                <div class="customInput mt-4">
                                    <input placeholder=" " id="port" name="port" class="form-control" type="text">
                                    <label for="port">Port <span class="primary-color">*</span> </label>
                                </div>
                                <div class="text-danger" id="port_error"></div>

                                <!-- SMTP USERNAME -->
                                <div class="customInput mt-4">
                                    <input placeholder=" " id="username" name="username" class="form-control" type="text">
                                    <label for="username">Username <span class="primary-color">*</span> </label>
                                </div>
                                <div class="text-danger" id="username_error"></div>

                                <!-- SMTP PASSWORD -->
                                <div class="customInput mt-4">
                                    <input placeholder=" " id="password" name="password" class="form-control" type="text">
                                    <label for="password">Password <span class="primary-color">*</span> </label>
                                </div>
                                <div class="text-danger" id="password_error"></div>

                                <!-- SMTP ENCRYPTION -->
                                <div class="customSelect my-4">
                                    <select class="customSelectText form-control" id="encryption" name="encryption"  required>
                                        <option value="tls" selected>TLS</option>
                                        <option value="ssl">SSL</option>
                                    </select>
                                    <label class="customSelectLabel">Select Encryption <span class="text-danger">*</span></label>
                                </div>

                                <button id="submit-button" type="submit" class="btn btn-primary mb-3 smtpBtn">
                                    Create
                                </button>

                                <a href="../index.php" class="btn btn-outline-secondary mb-3">
                                    Cancel
                                </a>
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
        var url = "{{url('api/smtp/show')}}";
        getEditData(url);
        $('#form').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            formSubmit("post", "submit-button", form);
        })
    </script>
@endpush
