@extends('frontend::customer.master')
@section('content')
<!-- Sidebar -->
<div class="dark-overlay"></div>
<div class="sidebar style-2">
    <a href="../index.html" class="side-menu-logo">
        <img src="assets/images/logo-sidebar.svg" alt="logo">
    </a>
    <ul class="nav navbar-nav">
        <li class="nav-label">Main Menu</li>
        <li>
            <a class="nav-link" href="../index.html">
					<span class="dz-icon">
						<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
							<path d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z"/>
						</svg>
					</span>
                <span>Home</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="../package.html">
					<span class="dz-icon">
						<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M12.6 18.06c-.36.28-.87.28-1.23 0l-6.15-4.78c-.36-.28-.86-.28-1.22 0-.51.4-.51 1.17 0 1.57l6.76 5.26c.72.56 1.73.56 2.46 0l6.76-5.26c.51-.4.51-1.17 0-1.57l-.01-.01c-.36-.28-.86-.28-1.22 0l-6.15 4.79zm.63-3.02l6.76-5.26c.51-.4.51-1.18 0-1.58l-6.76-5.26c-.72-.56-1.73-.56-2.46 0L4.01 8.21c-.51.4-.51 1.18 0 1.58l6.76 5.26c.72.56 1.74.56 2.46-.01z"/></svg>
					</span>
                <span>Package</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="../pages.html">
					<span class="dz-icon">
						<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M12.6 18.06c-.36.28-.87.28-1.23 0l-6.15-4.78c-.36-.28-.86-.28-1.22 0-.51.4-.51 1.17 0 1.57l6.76 5.26c.72.56 1.73.56 2.46 0l6.76-5.26c.51-.4.51-1.17 0-1.57l-.01-.01c-.36-.28-.86-.28-1.22 0l-6.15 4.79zm.63-3.02l6.76-5.26c.51-.4.51-1.18 0-1.58l-6.76-5.26c-.72-.56-1.73-.56-2.46 0L4.01 8.21c-.51.4-.51 1.18 0 1.58l6.76 5.26c.72.56 1.74.56 2.46-.01z"/></svg>
					</span>
                <span>Pages</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="../ui-components.html">
					<span class="dz-icon">
						<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/></svg>
					</span>
                <span>Components</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="../profile.html">
					<span class="dz-icon">
						<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4z"/></svg>
					</span>
                <span>Profile</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="../chat.html">
					<span class="dz-icon">
						<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM7 9h10c.55 0 1 .45 1 1s-.45 1-1 1H7c-.55 0-1-.45-1-1s.45-1 1-1zm6 5H7c-.55 0-1-.45-1-1s.45-1 1-1h6c.55 0 1 .45 1 1s-.45 1-1 1zm4-6H7c-.55 0-1-.45-1-1s.45-1 1-1h10c.55 0 1 .45 1 1s-.45 1-1 1z"/></svg>
					</span>
                <span>Chat</span>
                <span class="badge badge-circle badge-info">5</span>
            </a>
        </li>
        <li><a class="nav-link" href="{{route('customer-logout')}}">
				<span class="dz-icon">
					<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g></g><g><g><path d="M5,5h6c0.55,0,1-0.45,1-1v0c0-0.55-0.45-1-1-1H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h6c0.55,0,1-0.45,1-1v0 c0-0.55-0.45-1-1-1H5V5z"/><path d="M20.65,11.65l-2.79-2.79C17.54,8.54,17,8.76,17,9.21V11h-7c-0.55,0-1,0.45-1,1v0c0,0.55,0.45,1,1,1h7v1.79 c0,0.45,0.54,0.67,0.85,0.35l2.79-2.79C20.84,12.16,20.84,11.84,20.65,11.65z"/></g></g></svg>
				</span>
                <span>Logout</span>
            </a></li>
        <li class="nav-label">Settings</li>
        <li class="nav-color" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
            <a href="javascript:void(0);" class="nav-link">
                    <span class="dz-icon">
                        <svg class="color-plate" xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 0 24 24" width="30px" fill="#000000">
							<path d="M12 3c-4.97 0-9 4.03-9 9s4.03 9 9 9c.83 0 1.5-.67 1.5-1.5 0-.39-.15-.74-.39-1.01-.23-.26-.38-.61-.38-.99 0-.83.67-1.5 1.5-1.5H16c2.76 0 5-2.24 5-5 0-4.42-4.03-8-9-8zm-5.5 9c-.83 0-1.5-.67-1.5-1.5S5.67 9 6.5 9 8 9.67 8 10.5 7.33 12 6.5 12zm3-4C8.67 8 8 7.33 8 6.5S8.67 5 9.5 5s1.5.67 1.5 1.5S10.33 8 9.5 8zm5 0c-.83 0-1.5-.67-1.5-1.5S13.67 5 14.5 5s1.5.67 1.5 1.5S15.33 8 14.5 8zm3 4c-.83 0-1.5-.67-1.5-1.5S16.67 9 17.5 9s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
						</svg>
                    </span>
                <span>Color Theme</span>
            </a>
        </li>
        <li>
            <div class="mode">
                    <span class="dz-icon">
                        <svg class="dark" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g></g><g><g><g><path d="M11.57,2.3c2.38-0.59,4.68-0.27,6.63,0.64c0.35,0.16,0.41,0.64,0.1,0.86C15.7,5.6,14,8.6,14,12s1.7,6.4,4.3,8.2 c0.32,0.22,0.26,0.7-0.09,0.86C16.93,21.66,15.5,22,14,22c-6.05,0-10.85-5.38-9.87-11.6C4.74,6.48,7.72,3.24,11.57,2.3z"/></g></g></g>
						</svg>
                    </span>
                <span class="text-dark">Dark Mode</span>
                <div class="custom-switch">
                    <input type="checkbox" class="switch-input theme-btn" id="toggle-dark-menu">
                    <label class="custom-switch-label" for="toggle-dark-menu"></label>
                </div>
            </div>
        </li>
    </ul>
    <a href="javascript:void(0);" onclick="deleteAllCookie()" class="btn btn-primary btn-sm cookie-btn">Delete Cookie</a>
    <div class="sidebar-bottom d-none">
        <h6 class="name">W3Grocery - Multipurpose App</h6>
        <span class="ver-info">App Version 1.0</span>
    </div>
    <div class="author-box mt-auto mb-0">
        <div class="dz-media">
            <img src="assets/images/avatar/5.jpg" alt="author-image">
        </div>
        <div class="dz-info">
            <h5 class="name">James Hawkins</h5>
            <span>jameshawkins@mail.com</span>
        </div>
    </div>
</div>
<!-- Sidebar End -->

<!-- Page Content -->
<div class="page-content bottom-content">
    <div class="container m-t100">
        <div class="card info-card bg-primary">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <div class="top-area">
                        <h3 class="quantity">180</h3>
                        <p class="mb-0">Total Menus</p>
                    </div>
                    <div class="icon-box-2 ms-auto">
                        <svg height="24" viewBox="0 0 512 512" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m433.798 106.268-96.423-91.222c-10.256-9.703-23.68-15.046-37.798-15.046h-183.577c-30.327 0-55 24.673-55 55v402c0 30.327 24.673 55 55 55h280c30.327 0 55-24.673 55-55v-310.778c0-15.049-6.27-29.612-17.202-39.954zm-29.137 13.732h-74.661c-2.757 0-5-2.243-5-5v-70.364zm-8.661 362h-280c-13.785 0-25-11.215-25-25v-402c0-13.785 11.215-25 25-25h179v85c0 19.299 15.701 35 35 35h91v307c0 13.785-11.215 25-25 25z"/><path d="m363 200h-220c-8.284 0-15 6.716-15 15s6.716 15 15 15h220c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/><path d="m363 280h-220c-8.284 0-15 6.716-15 15s6.716 15 15 15h220c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/><path d="m215.72 360h-72.72c-8.284 0-15 6.716-15 15s6.716 15 15 15h72.72c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/></svg>
                    </div>
                </div>
                <div class="bottom-area">
                    <h6 class="review-title text-end justify-content-end">75%</h6>
                    <div class="progress">
                        <div class="progress-bar progress-animated progress-bar-striped border-0" style="width: 75%;" role="progressbar">
                            <span class="sr-only">75% Complete</span>
                        </div>
                    </div>
                </div>
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
                <div class="card store-card overflow-hidden">
                    <div class="card-body p-0">
                        <div class="card-media">
                            <a href="location.html"><img src="assets/images/store/store1.jpg" alt="image"></a>
                        </div>
                        <div class="card-info">
                            <a href="location.html" class="btn btn-primary btn-sm">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.00008 0.666676C6.54969 0.666676 5.13186 1.09677 3.9259 1.90256C2.71994 2.70836 1.78001 3.85367 1.22497 5.19366C0.669925 6.53365 0.524701 8.00814 0.807659 9.43067C1.09062 10.8532 1.78905 12.1599 2.81464 13.1855C3.84022 14.211 5.14689 14.9095 6.56942 15.1924C7.99195 15.4754 9.46644 15.3302 10.8064 14.7751C12.1464 14.2201 13.2917 13.2802 14.0975 12.0742C14.9033 10.8682 15.3334 9.45041 15.3334 8.00001C15.3311 6.05579 14.5578 4.19186 13.183 2.81709C11.8082 1.44232 9.9443 0.668969 8.00008 0.666676ZM8.00008 14C6.8134 14 5.65336 13.6481 4.66666 12.9888C3.67997 12.3295 2.91093 11.3925 2.45681 10.2961C2.00268 9.19975 1.88386 7.99335 2.11537 6.82947C2.34688 5.66558 2.91833 4.59648 3.75744 3.75737C4.59656 2.91825 5.66566 2.34681 6.82954 2.1153C7.99343 1.88379 9.19983 2.00261 10.2962 2.45673C11.3925 2.91086 12.3296 3.67989 12.9889 4.66659C13.6482 5.65328 14.0001 6.81332 14.0001 8.00001C13.9981 9.59071 13.3654 11.1157 12.2406 12.2405C11.1158 13.3653 9.59079 13.9981 8.00008 14Z" fill="white"></path>
                                    <path d="M7.99992 6C7.82311 6 7.65354 6.07024 7.52852 6.19526C7.40349 6.32029 7.33325 6.48986 7.33325 6.66667V11.3333C7.33325 11.5101 7.40349 11.6797 7.52852 11.8047C7.65354 11.9298 7.82311 12 7.99992 12C8.17673 12 8.3463 11.9298 8.47133 11.8047C8.59635 11.6797 8.66659 11.5101 8.66659 11.3333V6.66667C8.66659 6.48986 8.59635 6.32029 8.47133 6.19526C8.3463 6.07024 8.17673 6 7.99992 6Z" fill="white"></path>
                                    <path d="M7.99992 5.33333C8.36811 5.33333 8.66659 5.03485 8.66659 4.66667C8.66659 4.29848 8.36811 4 7.99992 4C7.63173 4 7.33325 4.29848 7.33325 4.66667C7.33325 5.03485 7.63173 5.33333 7.99992 5.33333Z" fill="white"></path>
                                </svg>
                                <span class="ms-2">Directions</span>
                            </a>
                            <h5 class="title mb-1"><a href="location.html">Centre Point Flaza</a></h5>
                            <div class="info-bottom">
                                <p class="time mb-0">09:00 AM - 10:00 PM</p>
                                <div class="location text-primary">
                                    <svg class="svg-primary" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.9993 5.48404C9.59314 5.48404 7.64258 7.4346 7.64258 9.84075C7.64258 12.2469 9.59314 14.1975 11.9993 14.1975C14.4054 14.1975 16.356 12.2469 16.356 9.84075C16.356 7.4346 14.4054 5.48404 11.9993 5.48404ZM11.9993 12.0191C10.7962 12.0191 9.82096 11.0438 9.82096 9.84075C9.82096 8.6377 10.7962 7.66242 11.9993 7.66242C13.2023 7.66242 14.1776 8.6377 14.1776 9.84075C14.1776 11.0438 13.2023 12.0191 11.9993 12.0191Z" fill="#4A3749"></path>
                                        <path d="M21.793 9.81896C21.8074 4.41054 17.4348 0.0144869 12.0264 5.09008e-05C6.61797 -0.0143851 2.22191 4.35827 2.20748 9.76664C2.16044 15.938 5.85106 21.5248 11.546 23.903C11.6884 23.9674 11.8429 24.0005 11.9991 24C12.1565 24.0002 12.3121 23.9668 12.4555 23.9019C18.1324 21.5313 21.8191 15.9709 21.793 9.81896ZM11.9992 21.7127C7.30495 19.646 4.30485 14.9691 4.38364 9.84071C4.38364 5.63477 7.79323 2.22518 11.9992 2.22518C16.2051 2.22518 19.6147 5.63477 19.6147 9.84071V9.91152C19.6686 15.0154 16.672 19.6591 11.9992 21.7127Z" fill="#4A3749"></path>
                                    </svg> 3,5 Km
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card store-card overflow-hidden">
                    <div class="card-body p-0">
                        <div class="card-media">
                            <a href="location.html"><img src="assets/images/store/store2.jpg" alt="image"></a>
                        </div>
                        <div class="card-info">
                            <a href="location.html" class="btn btn-primary btn-sm">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.00008 0.666676C6.54969 0.666676 5.13186 1.09677 3.9259 1.90256C2.71994 2.70836 1.78001 3.85367 1.22497 5.19366C0.669925 6.53365 0.524701 8.00814 0.807659 9.43067C1.09062 10.8532 1.78905 12.1599 2.81464 13.1855C3.84022 14.211 5.14689 14.9095 6.56942 15.1924C7.99195 15.4754 9.46644 15.3302 10.8064 14.7751C12.1464 14.2201 13.2917 13.2802 14.0975 12.0742C14.9033 10.8682 15.3334 9.45041 15.3334 8.00001C15.3311 6.05579 14.5578 4.19186 13.183 2.81709C11.8082 1.44232 9.9443 0.668969 8.00008 0.666676ZM8.00008 14C6.8134 14 5.65336 13.6481 4.66666 12.9888C3.67997 12.3295 2.91093 11.3925 2.45681 10.2961C2.00268 9.19975 1.88386 7.99335 2.11537 6.82947C2.34688 5.66558 2.91833 4.59648 3.75744 3.75737C4.59656 2.91825 5.66566 2.34681 6.82954 2.1153C7.99343 1.88379 9.19983 2.00261 10.2962 2.45673C11.3925 2.91086 12.3296 3.67989 12.9889 4.66659C13.6482 5.65328 14.0001 6.81332 14.0001 8.00001C13.9981 9.59071 13.3654 11.1157 12.2406 12.2405C11.1158 13.3653 9.59079 13.9981 8.00008 14Z" fill="white"></path>
                                    <path d="M7.99992 6C7.82311 6 7.65354 6.07024 7.52852 6.19526C7.40349 6.32029 7.33325 6.48986 7.33325 6.66667V11.3333C7.33325 11.5101 7.40349 11.6797 7.52852 11.8047C7.65354 11.9298 7.82311 12 7.99992 12C8.17673 12 8.3463 11.9298 8.47133 11.8047C8.59635 11.6797 8.66659 11.5101 8.66659 11.3333V6.66667C8.66659 6.48986 8.59635 6.32029 8.47133 6.19526C8.3463 6.07024 8.17673 6 7.99992 6Z" fill="white"></path>
                                    <path d="M7.99992 5.33333C8.36811 5.33333 8.66659 5.03485 8.66659 4.66667C8.66659 4.29848 8.36811 4 7.99992 4C7.63173 4 7.33325 4.29848 7.33325 4.66667C7.33325 5.03485 7.63173 5.33333 7.99992 5.33333Z" fill="white"></path>
                                </svg>
                                <span class="ms-2">Directions</span>
                            </a>
                            <h5 class="title mb-1"><a href="location.html">Medan Plaza</a></h5>
                            <div class="info-bottom">
                                <p class="time mb-0">09:00 AM - 10:00 PM</p>
                                <div class="location text-primary">
                                    <svg class="svg-primary" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.9993 5.48404C9.59314 5.48404 7.64258 7.4346 7.64258 9.84075C7.64258 12.2469 9.59314 14.1975 11.9993 14.1975C14.4054 14.1975 16.356 12.2469 16.356 9.84075C16.356 7.4346 14.4054 5.48404 11.9993 5.48404ZM11.9993 12.0191C10.7962 12.0191 9.82096 11.0438 9.82096 9.84075C9.82096 8.6377 10.7962 7.66242 11.9993 7.66242C13.2023 7.66242 14.1776 8.6377 14.1776 9.84075C14.1776 11.0438 13.2023 12.0191 11.9993 12.0191Z" fill="#4A3749"></path>
                                        <path d="M21.793 9.81896C21.8074 4.41054 17.4348 0.0144869 12.0264 5.09008e-05C6.61797 -0.0143851 2.22191 4.35827 2.20748 9.76664C2.16044 15.938 5.85106 21.5248 11.546 23.903C11.6884 23.9674 11.8429 24.0005 11.9991 24C12.1565 24.0002 12.3121 23.9668 12.4555 23.9019C18.1324 21.5313 21.8191 15.9709 21.793 9.81896ZM11.9992 21.7127C7.30495 19.646 4.30485 14.9691 4.38364 9.84071C4.38364 5.63477 7.79323 2.22518 11.9992 2.22518C16.2051 2.22518 19.6147 5.63477 19.6147 9.84071V9.91152C19.6686 15.0154 16.672 19.6591 11.9992 21.7127Z" fill="#4A3749"></path>
                                    </svg> 3,5 Km
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card store-card overflow-hidden">
                    <div class="card-body p-0">
                        <div class="card-media">
                            <a href="location.html"><img src="assets/images/store/store3.jpg" alt="image"></a>
                        </div>
                        <div class="card-info">
                            <a href="location.html" class="btn btn-primary btn-sm">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.00008 0.666676C6.54969 0.666676 5.13186 1.09677 3.9259 1.90256C2.71994 2.70836 1.78001 3.85367 1.22497 5.19366C0.669925 6.53365 0.524701 8.00814 0.807659 9.43067C1.09062 10.8532 1.78905 12.1599 2.81464 13.1855C3.84022 14.211 5.14689 14.9095 6.56942 15.1924C7.99195 15.4754 9.46644 15.3302 10.8064 14.7751C12.1464 14.2201 13.2917 13.2802 14.0975 12.0742C14.9033 10.8682 15.3334 9.45041 15.3334 8.00001C15.3311 6.05579 14.5578 4.19186 13.183 2.81709C11.8082 1.44232 9.9443 0.668969 8.00008 0.666676ZM8.00008 14C6.8134 14 5.65336 13.6481 4.66666 12.9888C3.67997 12.3295 2.91093 11.3925 2.45681 10.2961C2.00268 9.19975 1.88386 7.99335 2.11537 6.82947C2.34688 5.66558 2.91833 4.59648 3.75744 3.75737C4.59656 2.91825 5.66566 2.34681 6.82954 2.1153C7.99343 1.88379 9.19983 2.00261 10.2962 2.45673C11.3925 2.91086 12.3296 3.67989 12.9889 4.66659C13.6482 5.65328 14.0001 6.81332 14.0001 8.00001C13.9981 9.59071 13.3654 11.1157 12.2406 12.2405C11.1158 13.3653 9.59079 13.9981 8.00008 14Z" fill="white"></path>
                                    <path d="M7.99992 6C7.82311 6 7.65354 6.07024 7.52852 6.19526C7.40349 6.32029 7.33325 6.48986 7.33325 6.66667V11.3333C7.33325 11.5101 7.40349 11.6797 7.52852 11.8047C7.65354 11.9298 7.82311 12 7.99992 12C8.17673 12 8.3463 11.9298 8.47133 11.8047C8.59635 11.6797 8.66659 11.5101 8.66659 11.3333V6.66667C8.66659 6.48986 8.59635 6.32029 8.47133 6.19526C8.3463 6.07024 8.17673 6 7.99992 6Z" fill="white"></path>
                                    <path d="M7.99992 5.33333C8.36811 5.33333 8.66659 5.03485 8.66659 4.66667C8.66659 4.29848 8.36811 4 7.99992 4C7.63173 4 7.33325 4.29848 7.33325 4.66667C7.33325 5.03485 7.63173 5.33333 7.99992 5.33333Z" fill="white"></path>
                                </svg>
                                <span class="ms-2">Directions</span>
                            </a>
                            <h5 class="title mb-1"><a href="location.html">Centre Point Flaza</a></h5>
                            <div class="info-bottom">
                                <p class="time mb-0">09:00 AM - 10:00 PM</p>
                                <div class="location text-primary">
                                    <svg class="svg-primary" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.9993 5.48404C9.59314 5.48404 7.64258 7.4346 7.64258 9.84075C7.64258 12.2469 9.59314 14.1975 11.9993 14.1975C14.4054 14.1975 16.356 12.2469 16.356 9.84075C16.356 7.4346 14.4054 5.48404 11.9993 5.48404ZM11.9993 12.0191C10.7962 12.0191 9.82096 11.0438 9.82096 9.84075C9.82096 8.6377 10.7962 7.66242 11.9993 7.66242C13.2023 7.66242 14.1776 8.6377 14.1776 9.84075C14.1776 11.0438 13.2023 12.0191 11.9993 12.0191Z" fill="#4A3749"></path>
                                        <path d="M21.793 9.81896C21.8074 4.41054 17.4348 0.0144869 12.0264 5.09008e-05C6.61797 -0.0143851 2.22191 4.35827 2.20748 9.76664C2.16044 15.938 5.85106 21.5248 11.546 23.903C11.6884 23.9674 11.8429 24.0005 11.9991 24C12.1565 24.0002 12.3121 23.9668 12.4555 23.9019C18.1324 21.5313 21.8191 15.9709 21.793 9.81896ZM11.9992 21.7127C7.30495 19.646 4.30485 14.9691 4.38364 9.84071C4.38364 5.63477 7.79323 2.22518 11.9992 2.22518C16.2051 2.22518 19.6147 5.63477 19.6147 9.84071V9.91152C19.6686 15.0154 16.672 19.6591 11.9992 21.7127Z" fill="#4A3749"></path>
                                    </svg> 3,5 Km
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card store-card overflow-hidden">
                    <div class="card-body p-0">
                        <div class="card-media">
                            <a href="location.html"><img src="assets/images/store/store4.jpg" alt="image"></a>
                        </div>
                        <div class="card-info">
                            <a href="location.html" class="btn btn-primary btn-sm">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.00008 0.666676C6.54969 0.666676 5.13186 1.09677 3.9259 1.90256C2.71994 2.70836 1.78001 3.85367 1.22497 5.19366C0.669925 6.53365 0.524701 8.00814 0.807659 9.43067C1.09062 10.8532 1.78905 12.1599 2.81464 13.1855C3.84022 14.211 5.14689 14.9095 6.56942 15.1924C7.99195 15.4754 9.46644 15.3302 10.8064 14.7751C12.1464 14.2201 13.2917 13.2802 14.0975 12.0742C14.9033 10.8682 15.3334 9.45041 15.3334 8.00001C15.3311 6.05579 14.5578 4.19186 13.183 2.81709C11.8082 1.44232 9.9443 0.668969 8.00008 0.666676ZM8.00008 14C6.8134 14 5.65336 13.6481 4.66666 12.9888C3.67997 12.3295 2.91093 11.3925 2.45681 10.2961C2.00268 9.19975 1.88386 7.99335 2.11537 6.82947C2.34688 5.66558 2.91833 4.59648 3.75744 3.75737C4.59656 2.91825 5.66566 2.34681 6.82954 2.1153C7.99343 1.88379 9.19983 2.00261 10.2962 2.45673C11.3925 2.91086 12.3296 3.67989 12.9889 4.66659C13.6482 5.65328 14.0001 6.81332 14.0001 8.00001C13.9981 9.59071 13.3654 11.1157 12.2406 12.2405C11.1158 13.3653 9.59079 13.9981 8.00008 14Z" fill="white"></path>
                                    <path d="M7.99992 6C7.82311 6 7.65354 6.07024 7.52852 6.19526C7.40349 6.32029 7.33325 6.48986 7.33325 6.66667V11.3333C7.33325 11.5101 7.40349 11.6797 7.52852 11.8047C7.65354 11.9298 7.82311 12 7.99992 12C8.17673 12 8.3463 11.9298 8.47133 11.8047C8.59635 11.6797 8.66659 11.5101 8.66659 11.3333V6.66667C8.66659 6.48986 8.59635 6.32029 8.47133 6.19526C8.3463 6.07024 8.17673 6 7.99992 6Z" fill="white"></path>
                                    <path d="M7.99992 5.33333C8.36811 5.33333 8.66659 5.03485 8.66659 4.66667C8.66659 4.29848 8.36811 4 7.99992 4C7.63173 4 7.33325 4.29848 7.33325 4.66667C7.33325 5.03485 7.63173 5.33333 7.99992 5.33333Z" fill="white"></path>
                                </svg>
                                <span class="ms-2">Directions</span>
                            </a>
                            <h5 class="title mb-1"><a href="location.html">Medan Plaza</a></h5>
                            <div class="info-bottom">
                                <p class="time mb-0">09:00 AM - 10:00 PM</p>
                                <div class="location text-primary">
                                    <svg class="svg-primary" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.9993 5.48404C9.59314 5.48404 7.64258 7.4346 7.64258 9.84075C7.64258 12.2469 9.59314 14.1975 11.9993 14.1975C14.4054 14.1975 16.356 12.2469 16.356 9.84075C16.356 7.4346 14.4054 5.48404 11.9993 5.48404ZM11.9993 12.0191C10.7962 12.0191 9.82096 11.0438 9.82096 9.84075C9.82096 8.6377 10.7962 7.66242 11.9993 7.66242C13.2023 7.66242 14.1776 8.6377 14.1776 9.84075C14.1776 11.0438 13.2023 12.0191 11.9993 12.0191Z" fill="#4A3749"></path>
                                        <path d="M21.793 9.81896C21.8074 4.41054 17.4348 0.0144869 12.0264 5.09008e-05C6.61797 -0.0143851 2.22191 4.35827 2.20748 9.76664C2.16044 15.938 5.85106 21.5248 11.546 23.903C11.6884 23.9674 11.8429 24.0005 11.9991 24C12.1565 24.0002 12.3121 23.9668 12.4555 23.9019C18.1324 21.5313 21.8191 15.9709 21.793 9.81896ZM11.9992 21.7127C7.30495 19.646 4.30485 14.9691 4.38364 9.84071C4.38364 5.63477 7.79323 2.22518 11.9992 2.22518C16.2051 2.22518 19.6147 5.63477 19.6147 9.84071V9.91152C19.6686 15.0154 16.672 19.6591 11.9992 21.7127Z" fill="#4A3749"></path>
                                    </svg> 3,5 Km
                                </div>
                            </div>
                        </div>
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
