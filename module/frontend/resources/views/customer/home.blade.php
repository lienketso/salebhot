@extends('frontend::customer.master')
@section('content')
<!-- Sidebar -->
<div class="dark-overlay"></div>


<!-- Page Content -->
<div class="page-content bottom-content">
    <div class="container m-t100">
        <div class="card info-card bg-primary">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <div class="top-area">
                        <h3 class="quantity">{{number_format($totalRevenue)}} VND</h3>
                        <p class="mb-0">Doanh thu tháng {{date('m')}}</p>
                    </div>
                    <div class="icon-box-2 ms-auto">
                        <svg height="24" viewBox="0 0 512 512" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m433.798 106.268-96.423-91.222c-10.256-9.703-23.68-15.046-37.798-15.046h-183.577c-30.327 0-55 24.673-55 55v402c0 30.327 24.673 55 55 55h280c30.327 0 55-24.673 55-55v-310.778c0-15.049-6.27-29.612-17.202-39.954zm-29.137 13.732h-74.661c-2.757 0-5-2.243-5-5v-70.364zm-8.661 362h-280c-13.785 0-25-11.215-25-25v-402c0-13.785 11.215-25 25-25h179v85c0 19.299 15.701 35 35 35h91v307c0 13.785-11.215 25-25 25z"/><path d="m363 200h-220c-8.284 0-15 6.716-15 15s6.716 15 15 15h220c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/><path d="m363 280h-220c-8.284 0-15 6.716-15 15s6.716 15 15 15h220c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/><path d="m215.72 360h-72.72c-8.284 0-15 6.716-15 15s6.716 15 15 15h72.72c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/></svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="service-area mb-4">
            <div class="service-box">
                <div class="dz-icon mx-auto mb-2">
                    <svg clip-rule="evenodd" fill-rule="evenodd" height="24" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 32 32" width="24" xmlns="http://www.w3.org/2000/svg"><g id="Icon"><path d="m23 16c-3.863 0-7 3.137-7 7s3.137 7 7 7 7-3.137 7-7-3.137-7-7-7zm-19 10h9c.552 0 1-.448 1-1s-.448-1-1-1h-9v-19c0-.552.448-1 1-1h6v8c0 .347.179.668.474.851.295.182.663.198.973.043l3.553-1.776s3.553 1.776 3.553 1.776c.31.155.678.139.973-.043.295-.183.474-.504.474-.851v-8h6c.552 0 1 .448 1 1v10c0 .552.448 1 1 1s1-.448 1-1v-10c0-1.656-1.344-3-3-3h-22c-1.656 0-3 1.344-3 3v22c0 1.656 1.344 3 3 3h10c.552 0 1-.448 1-1s-.448-1-1-1h-10c-.552 0-1-.448-1-1zm19-8c2.76 0 5 2.24 5 5s-2.24 5-5 5-5-2.24-5-5 2.24-5 5-5zm-3.207 5.707 2 2c.39.391 1.024.391 1.414 0l3-3c.39-.39.39-1.024 0-1.414s-1.024-.39-1.414 0l-2.293 2.293s-1.293-1.293-1.293-1.293c-.39-.39-1.024-.39-1.414 0s-.39 1.024 0 1.414zm-.793-19.707h-6v6.382l2.553-1.276c.281-.141.613-.141.894 0 0 0 2.553 1.276 2.553 1.276z"></path></g></svg>
                </div>
                <span class="font-14 d-block mb-2">Đơn hàng hoàn thành</span>
                <h5 class="mb-0">{{$totalSuccess}}</h5>
            </div>
            <div class="service-box">
                <div class="dz-icon mx-auto mb-2">
                    <svg height="24" viewBox="0 0 16 16" width="24" xmlns="http://www.w3.org/2000/svg" data-name="Layer 2"><path d="m14 .5h-12a1.5017 1.5017 0 0 0 -1.5 1.5v1a1.4977 1.4977 0 0 0 1 1.4079v7.5921a1.5017 1.5017 0 0 0 1.5 1.5h4.2618a4.4891 4.4891 0 1 0 7.2382-5.2935v-3.7986a1.4977 1.4977 0 0 0 1-1.4079v-1a1.5017 1.5017 0 0 0 -1.5-1.5zm-11 12a.501.501 0 0 1 -.5-.5v-7.5h11v2.7618a4.4725 4.4725 0 0 0 -6.7236 5.2382zm8 2a3.5 3.5 0 1 1 3.5-3.5 3.5042 3.5042 0 0 1 -3.5 3.5zm3.5-11.5a.501.501 0 0 1 -.5.5h-12a.501.501 0 0 1 -.5-.5v-1a.501.501 0 0 1 .5-.5h12a.501.501 0 0 1 .5.5z"></path><path d="m11.5 10.793v-1.793a.5.5 0 0 0 -1 0v2a.4993.4993 0 0 0 .1465.3535l1 1a.5.5 0 0 0 .707-.707z"></path></svg>
                </div>
                <span class="font-14 d-block mb-2">Đang đợi duyệt</span>
                <h5 class="mb-0">{{$totalPending}}</h5>
            </div>
            <div class="service-box">
                <div class="dz-icon mx-auto mb-2">
                    <svg enable-background="new 0 0 100 100" height="24" viewBox="0 0 100 100" width="24" xmlns="http://www.w3.org/2000/svg"><path id="Not_Delivered" d="m92 54.066v-19.066c0-.545-.146-1.078-.428-1.544l-16.251-27.091c-1.62-2.692-4.579-4.365-7.719-4.365h-41.204c-3.141 0-6.1 1.673-7.72 4.368l-16.25 27.088c-.282.466-.428.999-.428 1.544v48c0 4.963 4.037 9 9 9h43.066c4.636 3.745 10.524 6 16.934 6 14.889 0 27-12.111 27-27 0-6.41-2.255-12.298-6-16.934zm-42-46.066h17.602c1.049 0 2.036.56 2.575 1.456l13.524 22.544h-33.701zm-26.177 1.459c.539-.899 1.527-1.459 2.575-1.459h17.602v24h-33.701zm-12.823 76.541c-1.655 0-3-1.345-3-3v-45h78v10.565c-4.293-2.88-9.453-4.565-15-4.565-14.889 0-27 12.111-27 27 0 5.547 1.685 10.707 4.565 15zm60 6c-11.578 0-21-9.422-21-21s9.422-21 21-21 21 9.422 21 21-9.422 21-21 21zm-36-42c0 1.658-1.342 3-3 3h-12c-1.658 0-3-1.342-3-3s1.342-3 3-3h12c1.658 0 3 1.342 3 3zm47.121 14.121-6.879 6.879 6.879 6.879c1.172 1.172 1.172 3.07 0 4.242-.586.586-1.353.879-2.121.879s-1.535-.293-2.121-.879l-6.879-6.879-6.879 6.879c-.586.586-1.353.879-2.121.879s-1.535-.293-2.121-.879c-1.172-1.172-1.172-3.07 0-4.242l6.879-6.879-6.879-6.879c-1.172-1.172-1.172-3.07 0-4.242s3.07-1.172 4.242 0l6.879 6.879 6.879-6.879c1.172-1.172 3.07-1.172 4.242 0s1.172 3.07 0 4.242z"></path></svg>
                </div>
                <span class="font-14 d-block mb-2">Hủy đơn</span>
                <h5 class="mb-0">{{$totalCancel}}</h5>
            </div>
            <div class="service-box">
                <div class="dz-icon mx-auto mb-2">
                    <svg enable-background="new 0 0 100 100" height="24" viewBox="0 0 100 100" width="24" xmlns="http://www.w3.org/2000/svg"><path id="Product_Return" d="m98 50c0 26.467-21.533 48-48 48s-48-21.533-48-48c0-1.658 1.342-3 3-3s3 1.342 3 3c0 23.159 18.841 42 42 42s42-18.841 42-42-18.841-42-42-42c-11.163 0-21.526 4.339-29.322 12h11.322c1.658 0 3 1.342 3 3s-1.342 3-3 3h-18c-1.658 0-3-1.342-3-3v-18c0-1.658 1.342-3 3-3s3 1.342 3 3v10.234c8.851-8.448 20.481-13.234 33-13.234 26.467 0 48 21.533 48 48zm-21-12v27c0 1.251-.776 2.37-1.945 2.81l-24 9c-.34.126-.698.19-1.055.19s-.715-.064-1.055-.19l-24-9c-1.169-.44-1.945-1.559-1.945-2.81v-27c0-1.251.776-2.37 1.945-2.81l24-9c.68-.252 1.43-.252 2.109 0l24 9c1.17.44 1.946 1.559 1.946 2.81zm-42.457 0 15.457 5.795 15.457-5.795-15.457-5.795zm-5.543 24.92 18 6.75v-20.59l-18-6.75zm42 0v-20.59l-18 6.75v20.59z"></path></svg>
                </div>
                <span class="font-14 d-block mb-2">Hoàn lại</span>
                <h5 class="mb-0">0</h5>
            </div>
        </div>
        <div class="card summary-card">
            <div class="card-header border-0">
                <h6 class="mb-0 font-14">Order Summary</h6>
                <ul class="nav nav-pills dz-nav summary-chart" id="pills-tab1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-series="month" id="pills-month-tab1" data-bs-toggle="pill" data-bs-target="#pills-month1" type="button" role="tab" aria-selected="true">Monthly</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-week-tab1" data-series="week" data-bs-toggle="pill" data-bs-target="#pills-week1" type="button" role="tab" aria-selected="false" tabindex="-1">Weekly</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-today-tab1" data-series="today" data-bs-toggle="pill" data-bs-target="#pills-today1" type="button" role="tab" aria-selected="false" tabindex="-1">Today</button>
                    </li>
                </ul>
            </div>
            <div class="card-body p-0">
                <div id="summaryChart"></div>
            </div>
        </div>
        <div class="card revenue-card">
            <div class="card-header border-0">
                <h6 class="mb-0 font-14">Revenue</h6>
                <ul class="nav nav-pills dz-nav revenue-chart" id="pills-tab2" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-series="month" id="pills-month-tab2" data-bs-toggle="pill" data-bs-target="#pills-month1" type="button" role="tab" aria-selected="true">Monthly</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-week-tab2" data-series="week" data-bs-toggle="pill" data-bs-target="#pills-week1" type="button" role="tab" aria-selected="false" tabindex="-1">Weekly</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-today-tab2" data-series="today" data-bs-toggle="pill" data-bs-target="#pills-today1" type="button" role="tab" aria-selected="false" tabindex="-1">Today</button>
                    </li>
                </ul>
            </div>
            <div class="card-body p-0">
                <div id="revenueChart"></div>
            </div>
        </div>
        <div class="title-bar">
            <span class="title mb-0 font-18">Our Stores</span>
        </div>
        <div class="row">
            <div class="col-md-6">

                    <div class="card order-box">
                        <div class="card-body">
                            <a href="order-details.html">
                                <div class="order-content">
                                    <div class="media media-70 rounded me-3">
                                        <img src="../assets/images/categorie/3.png" alt="image">
                                    </div>
                                    <div class="right-content">
                                        <h6 class="order-number">ORDER # 277</h6>
                                        <ul>
                                            <li>
                                                <p class="order-name">Apple Royal Gal... - 1kg - $10.0</p>
                                                <span class="order-quantity">x9</span>
                                            </li>
                                            <li>
                                                <h6 class="order-time">Monday, February 13,2023 6:53pm</h6>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="badge badge-md badge-primary float-end rounded-sm">ONGOING</div>
                            </a>
                        </div>
                    </div>


            </div>



        </div>
    </div>
</div>
<!-- Page Content End-->

<div class="menubar-area style-10 footer-fixed">
    <div class="toolbar-inner menubar-nav">
        <a href="home.html" class="nav-link active">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M506.555 208.064L263.859 30.367a13.3 13.3 0 0 0-15.716 0L5.445 208.064c-5.928 4.341-7.216 12.665-2.875 18.593a13.31 13.31 0 0 0 18.593 2.875L256 57.588l234.837 171.943c2.368 1.735 5.12 2.57 7.848 2.57 4.096 0 8.138-1.885 10.744-5.445 4.342-5.927 3.054-14.251-2.874-18.592zm-64.309 24.479c-7.346 0-13.303 5.956-13.303 13.303v211.749H322.521V342.009c0-36.68-29.842-66.52-66.52-66.52s-66.52 29.842-66.52 66.52v115.587H83.058V245.847c0-7.347-5.957-13.303-13.303-13.303s-13.303 5.956-13.303 13.303V470.9c0 7.347 5.957 13.303 13.303 13.303h133.029c6.996 0 12.721-5.405 13.251-12.267.032-.311.052-.651.052-1.036V342.01c0-22.009 17.905-39.914 39.914-39.914s39.914 17.906 39.914 39.914V470.9c0 .383.02.717.052 1.024.524 6.867 6.251 12.279 13.251 12.279h133.029c7.347 0 13.303-5.956 13.303-13.303V245.847c-.001-7.348-5.957-13.304-13.304-13.304z"/></svg>
            <span>Home</span>
        </a>
        <a href="order.html" class="nav-link">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M386.689 304.403c-35.587 0-64.538 28.951-64.538 64.538s28.951 64.538 64.538 64.538c35.593 0 64.538-28.951 64.538-64.538s-28.951-64.538-64.538-64.538zm0 96.807c-17.796 0-32.269-14.473-32.269-32.269s14.473-32.269 32.269-32.269 32.269 14.473 32.269 32.269-14.473 32.269-32.269 32.269zm-220.504-96.807c-35.587 0-64.538 28.951-64.538 64.538s28.951 64.538 64.538 64.538 64.538-28.951 64.538-64.538-28.951-64.538-64.538-64.538zm0 96.807c-17.796 0-32.269-14.473-32.269-32.269s14.473-32.269 32.269-32.269 32.269 14.473 32.269 32.269-14.473 32.269-32.269 32.269zM430.15 119.675c-2.743-5.448-8.32-8.885-14.419-8.885h-84.975v32.269h75.025l43.934 87.384 28.838-14.5-48.403-96.268z"/><path d="M216.202 353.345h122.084v32.269H216.202zm-98.421 0H61.849c-8.912 0-16.134 7.223-16.134 16.134s7.223 16.134 16.134 16.134h55.933c8.912 0 16.134-7.223 16.134-16.134s-7.223-16.134-16.135-16.134zm390.831-98.636l-31.736-40.874c-3.049-3.937-7.755-6.239-12.741-6.239H346.891V94.655c0-8.912-7.223-16.134-16.134-16.134H61.849c-8.912 0-16.134 7.223-16.134 16.134s7.223 16.134 16.134 16.134h252.773V223.73c0 8.912 7.223 16.134 16.134 16.134h125.478l23.497 30.268v83.211h-44.639c-8.912 0-16.134 7.223-16.134 16.134s7.223 16.134 16.134 16.134h60.773c8.912 0 16.134-7.223 16.135-16.134V264.605c0-3.582-1.194-7.067-3.388-9.896zm-391.906 16.888H42.487c-8.912 0-16.134 7.223-16.134 16.134s7.223 16.134 16.134 16.134h74.218c8.912 0 16.134-7.223 16.134-16.134s-7.222-16.134-16.133-16.134zm37.109-63.463H16.134C7.223 208.134 0 215.357 0 224.269s7.223 16.134 16.134 16.134h137.681c8.912 0 16.134-7.223 16.134-16.134s-7.222-16.135-16.134-16.135zm26.353-63.462H42.487c-8.912 0-16.134 7.223-16.134 16.134s7.223 16.134 16.134 16.134h137.681c8.912 0 16.134-7.223 16.134-16.134s-7.222-16.134-16.134-16.134z"/></svg>
            <span>Order</span>
        </a>
        <a href="analytics.html" class="nav-link">
            <svg height="512" viewBox="0 0 32 32" width="512" xmlns="http://www.w3.org/2000/svg"><g id="Layer_2" data-name="Layer 2"><path d="m1 29h30v2h-30z"/><path d="m4 26a2.99 2.99 0 0 0 2.189-5.037l5.119-8.052a2.837 2.837 0 0 0 1.977-.212l4.015 4.016a2.951 2.951 0 0 0 -.3 1.285 3 3 0 0 0 6 0 2.972 2.972 0 0 0 -.7-1.908l5.2-9.142a3.023 3.023 0 1 0 -1.746-.976l-5.176 9.085a3.015 3.015 0 0 0 -.578-.059 2.951 2.951 0 0 0 -1.285.3l-4.015-4.015a2.951 2.951 0 0 0 .3-1.285 3 3 0 0 0 -6 0 2.968 2.968 0 0 0 .632 1.82l-5.227 8.221a3 3 0 0 0 -.405-.041 3 3 0 0 0 0 6zm16-7a1 1 0 1 1 1-1 1 1 0 0 1 -1 1zm8-16a1 1 0 1 1 -1 1 1 1 0 0 1 1-1zm-16 6a1 1 0 1 1 -1 1 1 1 0 0 1 1-1zm-8 13a1 1 0 1 1 -1 1 1 1 0 0 1 1-1z"/></g></svg>
            <span>Analytics</span>
        </a>
        <a href="vendor-profile.html" class="nav-link">
            <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><g fill="rgb(0,0,0)"><path d="m12 12.75c-3.17 0-5.75-2.58-5.75-5.75s2.58-5.75 5.75-5.75 5.75 2.58 5.75 5.75-2.58 5.75-5.75 5.75zm0-10c-2.34 0-4.25 1.91-4.25 4.25s1.91 4.25 4.25 4.25 4.25-1.91 4.25-4.25-1.91-4.25-4.25-4.25z"/><path d="m20.5901 22.75c-.41 0-.75-.34-.75-.75 0-3.45-3.5199-6.25-7.8399-6.25-4.32005 0-7.84004 2.8-7.84004 6.25 0 .41-.34.75-.75.75s-.75-.34-.75-.75c0-4.27 4.18999-7.75 9.34004-7.75 5.15 0 9.3399 3.48 9.3399 7.75 0 .41-.34.75-.75.75z"/></g></svg>
            <span>Profile</span>
        </a>
    </div>
</div>
<div class="offcanvas offcanvas-bottom m-3 rounded"  tabindex="-1" id="offcanvasBottom">
    <div class="offcanvas-body small">
        <ul class="theme-color-settings">
            <li>
                <input class="filled-in" id="primary_color_8" name="theme_color" type="radio" value="color-primary">
                <label for="primary_color_8"></label>
                <span>Default</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_2" name="theme_color" type="radio" value="color-green">
                <label for="primary_color_2"></label>
                <span>Green</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_3" name="theme_color" type="radio" value="color-blue">
                <label for="primary_color_3"></label>
                <span>Blue</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_4" name="theme_color" type="radio" value="color-pink">
                <label for="primary_color_4"></label>
                <span>Pink</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_5" name="theme_color" type="radio" value="color-yellow">
                <label for="primary_color_5"></label>
                <span>Yellow</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_6" name="theme_color" type="radio" value="color-orange">
                <label for="primary_color_6"></label>
                <span>Orange</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_7" name="theme_color" type="radio" value="color-purple">
                <label for="primary_color_7"></label>
                <span>Purple</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_1" name="theme_color" type="radio" value="color-red">
                <label for="primary_color_1"></label>
                <span>Red</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_9" name="theme_color" type="radio" value="color-lightblue">
                <label for="primary_color_9"></label>
                <span>Lightblue</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_10" name="theme_color" type="radio" value="color-teal">
                <label for="primary_color_10"></label>
                <span>Teal</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_11" name="theme_color" type="radio" value="color-lime">
                <label for="primary_color_11"></label>
                <span>Lime</span>
            </li>
            <li>
                <input class="filled-in" id="primary_color_12" name="theme_color" type="radio" value="color-deeporange">
                <label for="primary_color_12"></label>
                <span>Deeporange</span>
            </li>
        </ul>
    </div>
</div>
@endsection
