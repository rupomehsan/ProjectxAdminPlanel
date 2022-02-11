@extends('layouts.admin.index')
@section('content')
    <!-- ======= Main Content Section ======= -->
    <main id="main" class="main">
        <div class="row">
            <div class="col-lg-2 col-12">
                <h1 class="pagetitle">Blog</h1>
            </div>

            <div class="col-lg-2 col-12">

                <a href="{{url('admin/blog/create')}}" class="btn">
                    <span class="iconify" data-icon="carbon:add-filled" style="color: black;" data-width="16"
                          data-height="16"></span>
                    Add Blog
                </a>
            </div>

            <div class="col-lg-8 col-12">
                <div class="d-flex flex-column align-items-end">
                    <form action="" id="search-form" name="search-form" novalidate>
                        <span class="iconify search_icon" id="search_icon" data-icon="codicon:search" data-width="20"
                              data-height="20"></span>
                        <input type="search" id="search_input" name="search" class="search_input"
                               placeholder="Search..">
                    </form>
                </div>
            </div>
        </div>

        <section class="section mt-4" id="blog">
            <div class="row" id="blogData">

            </div>


        </section>

    </main>
    <!-- ======= End Main Content Section ======= -->
@endsection

@push('custom-js')
    <script>
        /**
         * GET All Blogs
         * **/
        $(document).ready(function () {
            $.ajax({
                url: "{{ URL::to('api/blog/get-all') }}",
                type: 'GET',
                dataType: "json",
                success: function (res) {
                    // console.log(res);

                    if (res.status === 'success') {
                        $('#blogData').empty()
                        fetchData(res)
                    }
                    // setTimeout(location.reload.bind(location), 1000);
                },
                error: function (xhr, resp, text) {
                    console.log(xhr);
                    // on error, tell the failed
                },
            });
        })


        /**
         * GET Search Data
         * **/
        $(document).on('keyup','#search_input',function () {
            // alert('hi')
            var searchdata = $('#search_input').val()
            // alert(searchdata);
            console.log(searchdata)
            $.ajax({
                url: "{{ URL::to('api/blog/search-data') }}",
                type: 'GET',
                dataType: "json",
                data : {
                    'searchdata' : searchdata
                },
                success: function (res) {
                    console.log("searchdata",res);

                    if (res.status === 'success') {
                        $('#blogData').empty()
                        fetchData(res)
                    }
                    // setTimeout(location.reload.bind(location), 1000);
                },
                error: function (xhr, resp, text) {
                    console.log(xhr);
                    // on error, tell the failed
                },
            });
        })

        /**
         * Generate Fetch Data
         * **/
        function fetchData(res){
            res.data.forEach(function(item){
                $('#blogData').append(`
                               <div class="col-lg-4 col-12">
                                    <div class="card">
                                        <img src="${item.image}" class="card-img-top rounded-3 border"
                                             alt="">
                                        <div class="card-img-overlay">
                                            <a href="{{url('api/blog/edit')}}/${item.id}" class="btn bg-white">
                                                <span class="iconify" data-icon="ant-design:edit-filled" style="color: black;" data-width="15" data-height="15"></span>
                                            </a>
                                            <button class="btn bg-white" onclick="deleteItem('{{url("api/blog/delete")}}/${item.id}')">
                                                <span class="iconify" data-icon="bx:bxs-trash-alt" style="color: black;" data-width="15" data-height="15"></span>
                                            </button>
                                        </div>
                                        <p>${item.title}</p>
                                    </div>
                                </div>
                        `)
            })
        }

    </script>

@endpush
