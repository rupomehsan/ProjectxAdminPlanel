@extends('layouts.admin.index')
@section('content')
    <!-- ======= Main Content Section ======= -->
    <main id="main" class="main">
        <div class="row">
            <div class="col-lg-6 col-12">
                <h1 class="pagetitle">All Users</h1>
            </div>

{{--            <div class="col-lg-2 col-12">--}}
{{--                <a href="add-user.php" class="btn">--}}
{{--                    <span class="iconify" data-icon="carbon:add-filled" style="color: black;" data-width="16"--}}
{{--                          data-height="16"></span>--}}
{{--                    Add User--}}
{{--                </a>--}}
{{--            </div>--}}

            <div class="col-lg-6 col-12">
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

        <section class="section mt-5">

            <table class="table table-borderless mt-5">
                <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>

                <tbody id='user_list'>
                <td>
                    <img src="/assets/img/card.jpg" width="50" height="50" alt="">
                </td>
                <td>hello</td>
                <td>hello</td>
                <td>hello</td>
                <td>
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="" class="btn btn-outline-secondary primary-btn-outline form-control">EDIT</a>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn btn-outline-secondary primary-btn-outline form-control">DELETE</button>
                        </div>
                    </div>

                </td>
                </tbody>

                <tbody id='user_list'>
                <td>
                    <img src="/assets/img/card.jpg" width="50" height="50" alt="">
                </td>
                <td>hello</td>
                <td>hello</td>
                <td>hello</td>
                <td>
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="" class="btn btn-outline-secondary primary-btn-outline form-control">EDIT</a>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn btn-outline-secondary primary-btn-outline form-control">DELETE</button>
                        </div>
                    </div>

                </td>
                </tbody>

            </table>

        </section>

    </main>
    <!-- ======= End Main Content Section ======= -->
@endsection
