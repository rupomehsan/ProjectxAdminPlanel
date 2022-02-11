@extends('layouts.admin.index')
@section('content')
<!-- ======= Main Content Section ======= -->
<main id="main" class="main">
    <h6>👋 Hello!</h6>
    <h4 class="my-3">Welcome <span class="primary-color">Onboard</span></h4>
    <h1 class="pagetitle">User Overview</h1>

    <section class="section mt-5 ">
        <!-- Total Count Section -->
        <div class="row">
            <!-- Count Cards -->
            <div class="col-lg-8 col-12">
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="card px-3 py-4 countCard">
                            <div class="d-flex justify-content-between ">
                                <div>
                                    <h2 class="countLanguage">2</h2>
                                    <span class="countingTitle">Total User</span>
                                </div>
                                <div class="countingIcon" id="icon">
                                    <span class="iconify primary-color" data-icon="eos-icons:api" data-width="20"
                                          data-height="20"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card px-3 py-4 countCard">
                            <div class="d-flex justify-content-between ">
                                <div>
                                    <h2 class="countLanguage">2</h2>
                                    <span class="countingTitle">Total User</span>
                                </div>
                                <div class="countingIcon" id="icon">
                                    <span class="iconify primary-color" data-icon="eos-icons:api" data-width="20"
                                          data-height="20"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Last Day/Week/Month Count -->
            <div class="col-lg-4 col-12" id="lastCountTab">

                <ul class="nav nav-tabs" id="countTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="dayTabBtn" data-bs-toggle="tab"
                                data-bs-target="#dayTabContent" type="button" role="tab" aria-selected="true">Last
                            Day
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="weekTabBtn" data-bs-toggle="tab"
                                data-bs-target="#weekTabContent" type="button" role="tab" aria-selected="false">Last
                            Week
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="monthTabBtn" data-bs-toggle="tab"
                                data-bs-target="#monthTabContent" type="button" role="tab" aria-controls="contact"
                                aria-selected="false">Last Month
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="countTabContent">
                    <div class="tab-pane fade show active" id="dayTabContent" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <div class="lastCountTitle">
                                    <h6>2546</h6>
                                    <span>Total Users</span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-12">
                                <div class="lastCountTitle">
                                    <h6>2546</h6>
                                    <span>Total Download</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="weekTabContent" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <div class="lastCountTitle">
                                    <h6>2546</h6>
                                    <span>Total Users</span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-12">
                                <div class="lastCountTitle">
                                    <h6>2546</h6>
                                    <span>Total Download</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="monthTabContent" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <div class="lastCountTitle">
                                    <h6>2546</h6>
                                    <span>Total Users</span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-12">
                                <div class="lastCountTitle">
                                    <h6>2546</h6>
                                    <span>Total Download</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Total Count Section -->

        <!-- Visitor Count -->
        <div class="row">
            <div class="col-lg-8 col-12">
                <img src="{{asset('/assets/img/analytics.png')}}" class="img-fluid" alt="">
            </div>
        </div>
    </section>

</main>
<!-- ======= End Main Content Section ======= -->
@endsection
