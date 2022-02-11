@extends('layouts.admin.index')
@section('content')
    <main id="main" class="main">
        <h1 class="pagetitle">Weather API</h1>

        <section class="section mt-5">

            <div class="row">
                <div class="col-lg-10 col-12">
                    <div class="card p-4">
                        <div class="card-body">
                            <form action="{{url('api/weather-api/store')}}" id="form" name="form" novalidate>
                                <div class="row">
                                    <div class="col-lg-8 col-12">
                                        <!-- Set API Key -->
                                        <div class="customInput">
                                            <input placeholder=" " id="api_key" name="api_key" class="form-control" type="text" style="padding: 8px 14px">
                                            <label for="api_key">API KEY</label>
                                        </div>
                                        <div class="text-danger p-2" id="api_key_error"></div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <button id="submit-button " type="submit" class="btn btn-primary">
                                            SET
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Current API Key -->
                    </div>
                </div>

            </div>
        </section>

    </main>
@endsection
@push('custom-js')
    <script>
         var url = "{{url('api/weather-api/show')}}";
        getEditData(url);

    $('#form').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        formSubmit("post", "submit-button", form);
    })


    </script>
@endpush
