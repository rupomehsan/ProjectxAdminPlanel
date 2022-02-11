@extends('layouts.admin.index')
@section('content')
    <main id="main" class="main">
        <div class="row">
            <div class="col-lg-2 col-12">
                <h1 class="pagetitle">Manage Admin</h1>
            </div>

            <div class="col-lg-2 col-12">
                <a href="{{url('admin/manage-admin/create')}}" class="btn">
                    <span class="iconify" data-icon="carbon:add-filled" style="color: black;" data-width="16"
                          data-height="16"></span>
                    Add Admin
                </a>
            </div>

            <div class="col-lg-8 col-12">
                <div class="d-flex flex-column align-items-end">
                    <form action="{{url('api/manage-admin/search-data')}}" id="search-form" name="search-form" novalidate>
                        <span class="iconify search_icon" id="search_icon" data-icon="codicon:search" data-width="20"
                              data-height="20"></span>
                        <input type="search" id="search_input" name="search" class="search_input"
                               placeholder="Search..">
                    </form>
                </div>
            </div>
        </div>

        <section class="section mt-5">
            <!-- ===== Manage Admin Nav Tab  ===== -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="adminTab" data-bs-toggle="tab" data-bs-target="#adminTabContent"
                            type="button"
                            role="tab" aria-controls="home" aria-selected="true">Admin
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="superAdminTab" data-bs-toggle="tab" data-bs-target="#superAdminTabContent"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">Super Admin
                    </button>
                </li>
            </ul>
            <!-- ===== End Manage Admin Nav Tab  ===== -->

            <!-- ===== Manage Admin Tab Content ===== -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="adminTabContent" role="tabpanel" aria-labelledby="adminTab">
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

                        <tbody id='admin_list'>

                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="superAdminTabContent" role="tabpanel" aria-labelledby="superAdminTab">
                    <table class="table table-borderless mt-5">
                        <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col " class="text-center">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody id='super_admin_list'>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- ===== End Manage Admin Tab Content ===== -->

        </section>

    </main>
@endsection
@push('custom-js')
    <script>

        let url = "{{url('api/manage-admin/get-admin')}}";
        let url2 = "{{url('api/manage-admin/get-super-admin')}}";
        let headers = [
            {title: 'Image', field: 'image'},
            {title: 'Name', field: 'name'},
            {title: 'Phone No', field: 'phone'},
            {title: 'Email', field: 'email'},
            {title: 'Action', field: 'action'},
        ];
        let actions = [
            {label: 'Edit', url: "{{url('/admin/manage-admin/edit/:id')}}"},
            {label: 'Delete', url: "{{url('/api/manage-admin/delete/:id')}}"}
        ]
        getTableData(url, "admin_list", headers, actions);
        getTableData(url2, "super_admin_list", headers, actions);

        $('#search-form').keyup(function (e) {
            e.preventDefault();

            // get form data
            let form = $(this);
            let url = form.attr('action');
            let searchdata = $('#search_input').val();

            $.ajax({
                type: "POST",
                url: url,
                data: {'searchdata' : searchdata },
                success: function (response) {
                    // console.log(response)
                    let data = response.data
                    let headers = [
                        {title: 'Image', field: 'image'},
                        {title: 'Name', field: 'name'},
                        {title: 'Phone No', field: 'phone'},
                        {title: 'Email', field: 'email'},
                        {title: 'Action', field: 'action'},
                    ];

                    let actions = [
                        // {label: 'Edit', url: '/api/user/get.php?id=:id'},
                        {label: 'Edit', url: "{{url('/admin/manage-admin/edit/:id')}}"},
                        {label: 'Delete', url: "{{url('/api/manage-admin/delete/:id')}}"}
                    ]
                    generateTable("admin_list", headers, data, actions)
                },
                error: function (xhr, resp, text) {
                    console.log(resp)
                }
            });
        });
    </script>

@endpush
