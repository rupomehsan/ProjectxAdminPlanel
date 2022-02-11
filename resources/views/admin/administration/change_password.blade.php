@extends('layouts.admin.index')
@section('content')
    < <!-- ======= Main Content Section ======= -->
    <main id="main" class="main">

        <section class="section">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="card p-3 border-0">

                        <div class="card-body ">
                            <h1 class="pagetitle">Change Password</h1>
                            <form action="{{url('api/manage-admin/profile/change-password')}}" id="form" name="form" novalidate>
                                <!-- Current Password -->
                                <div class="customInput mt-5">
                                    <input type="hidden" id="id" name="id">
                                    <input placeholder=" " id="current_password" name="current_password" class="form-control" type="password">
                                    <label for="current_password">Current Password</label>
                                </div>
                                <div class="text-danger" id="current_password_error"></div>
                                <!-- New Password -->
                                <div class="customInput mt-3">
                                    <input placeholder=" " id="new_password" name="new_password" class="form-control" type="password">
                                    <label for="new_password">New Password</label>
                                </div>
                                <div class="text-danger" id="new_password_error"></div>
                                <!-- Confirm Password -->
                                <div class="customInput mt-3">
                                    <input placeholder=" " id="password_confirmation" name="password_confirmation" class="form-control" type="password">
                                    <label for="password_confirmation">Confirm Password</label>
                                </div>
                                <div class="text-danger" id="password_confirmation_error"></div>

                                <button id="submit-button" type="submit" class="btn btn-primary waves-effect mt-3">
                                    Update
                                </button>

                                <a href="" class="btn btn-outline-secondary mt-3">Cancel</a>

                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </section>

    </main>
    <!-- ======= End Main Content Section ======= -->
    @endsection()
@push('custom-js')
    <script>
        let userData = JSON.parse(localStorage.getItem('userData')) || null
        if(userData){
            $('#id').val(userData.id)
        }

        $('#form').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            formSubmit("patch", "submit-button", form);
        })
    </script>
@endpush
