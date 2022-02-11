@extends('layouts.admin.index')
@section('content')
    <main id="main" class="main">

        <section class="section">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="card p-5 border-0">

                        <div class="card-body ">
                            <h1 class="pagetitle">Notification Setting</h1>
                            <form action="{{url('api/manage-notification/store')}}" id="form" name="form" novalidate>

                                <!-- OneSignal App ID -->
                                <div class="customInput mt-5">
                                    <input placeholder=" " id="app_id" name="app_id" class="form-control" type="text">
                                    <label for="app_id">OneSignal App ID</label>
                                </div>
                                <div class="text-danger" id="app_id_error"></div>


                                <!-- OneSignal API Key -->
                                <div class="customInput mt-3">
                                    <input placeholder=" " id="api_key" name="api_key" class="form-control" type="text">
                                    <label for="api_key">OneSignal API Key</label>
                                </div>
                                <div class="text-danger mb-3" id="api_key_error"></div>



                                <button id="submit-button " type="submit" class="btn btn-primary waves-effect mb-3">
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
        var url = "{{url('api/manage-notification/show')}}";
        getEditData(url);
        $('#form').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            formSubmit("post", "submit-button", form);
        })

    </script>
@endpush
