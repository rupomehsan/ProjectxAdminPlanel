
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>Dashboard</title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<!-- Favicons -->
	<link href="{{asset('assets/img/favicon.png')}}" rel="icon">
	<link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
	<!-- Google Fonts -->
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
	      rel="stylesheet">
    <!-- Toaster -->

	<!-- Vendor CSS Files -->
	<link href="{{asset('assets/css/toastr.css')}}" rel="stylesheet">
	<link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
{{--	<link href="{{asset('assets/vendor/MDB5-STANDARD-UI-KIT-Free-3.10.2/css/mdb.min.css')}}" rel="stylesheet">	--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
          integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- Template Main CSS File -->
	<link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
	<!-- =======================================================
	* Template Name: Admin - v1.1.0
	* Author: ProjectX.Ltd
	======================================================== -->
</head>
<body>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <i class="bi bi-list toggle-sidebar-btn"></i>
    <!-- Profile Navigation -->
    <nav class="header-nav ms-auto">
        <!-- Profile Image & Name -->
        <a class="nav-link nav-profile d-flex align-items-center" href="#" data-bs-toggle="dropdown">
            <img src="{{asset('/assets/img/profile-img.jpg')}}" alt="Profile" id="userImage" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2" id="userName">Admin</span>
        </a>
        <!-- End Profile Image & Name  -->

        <!-- Profile Dropdown Items -->
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
                <a class="dropdown-item d-flex align-items-center" href="{{url('admin/manage-admin/profile')}}">
                    <i class="bi bi-person"></i>
                    <span>My Profile</span>
                </a>
            </li>
            <li>
                <a class="dropdown-item d-flex align-items-center" href="" id="signOut">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- End Profile Navigation -->
</header>
<!-- ======= End Header ======= -->
