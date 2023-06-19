<!-- Header -->
<header class="header style-6 header-fixed">
    <div class="container p-0">
        <div class="header-content">
            <div class="media-60 me-3 user-image">
                <img class="rounded-circle" src="{{asset('frontend/mobile/assets/images/avatar.png')}}" alt="user-image">
            </div>
            <div class="flex-1">
                <h5 class="title-head font-w700 mb-0">
                    <a href="#">{{\Illuminate\Support\Facades\Auth::guard('customer')->user()->name}}</a>
                </h5>
                <span>{{\Illuminate\Support\Facades\Auth::guard('customer')->user()->contact_name}}</span>
            </div>
            <a href="javascript:void(0);" class="menu-toggler icon-box">
                <i class="fa-solid fa-bars text-primary"></i>
            </a>
        </div>
    </div>
</header>
<!-- Header -->
<div class="sidebar style-2">
    <a href="" class="side-menu-logo">
        <img src="{{asset('frontend/mobile/assets/images/logo-bao-hiem.png')}}" alt="logo">
    </a>
    <ul class="nav navbar-nav">
        <li class="nav-label">Main Menu</li>
        <li>
            <a class="nav-link" href="{{route('frontend::customer.index.get')}}">
					<span class="dz-icon">
						<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
							<path d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z"/>
						</svg>
					</span>
                <span>Trang chính</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="{{route('frontend::customer.order.get')}}">
					<span class="dz-icon">
						<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M12.6 18.06c-.36.28-.87.28-1.23 0l-6.15-4.78c-.36-.28-.86-.28-1.22 0-.51.4-.51 1.17 0 1.57l6.76 5.26c.72.56 1.73.56 2.46 0l6.76-5.26c.51-.4.51-1.17 0-1.57l-.01-.01c-.36-.28-.86-.28-1.22 0l-6.15 4.79zm.63-3.02l6.76-5.26c.51-.4.51-1.18 0-1.58l-6.76-5.26c-.72-.56-1.73-.56-2.46 0L4.01 8.21c-.51.4-.51 1.18 0 1.58l6.76 5.26c.72.56 1.74.56 2.46-.01z"/></svg>
					</span>
                <span>Đơn hàng</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="{{route('frontend::customer.revenue.get')}}">
					<span class="dz-icon">
						<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M12.6 18.06c-.36.28-.87.28-1.23 0l-6.15-4.78c-.36-.28-.86-.28-1.22 0-.51.4-.51 1.17 0 1.57l6.76 5.26c.72.56 1.73.56 2.46 0l6.76-5.26c.51-.4.51-1.17 0-1.57l-.01-.01c-.36-.28-.86-.28-1.22 0l-6.15 4.79zm.63-3.02l6.76-5.26c.51-.4.51-1.18 0-1.58l-6.76-5.26c-.72-.56-1.73-.56-2.46 0L4.01 8.21c-.51.4-.51 1.18 0 1.58l6.76 5.26c.72.56 1.74.56 2.46-.01z"/></svg>
					</span>
                <span>Doanh thu</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="#">
					<span class="dz-icon">
						<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/></svg>
					</span>
                <span>Ví của bạn</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="#">
					<span class="dz-icon">
						<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4z"/></svg>
					</span>
                <span>Quản lý tài khoản</span>
            </a>
        </li>

        <li><a class="nav-link" href="{{route('customer-logout')}}">
				<span class="dz-icon">
					<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g></g><g><g><path d="M5,5h6c0.55,0,1-0.45,1-1v0c0-0.55-0.45-1-1-1H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h6c0.55,0,1-0.45,1-1v0 c0-0.55-0.45-1-1-1H5V5z"/><path d="M20.65,11.65l-2.79-2.79C17.54,8.54,17,8.76,17,9.21V11h-7c-0.55,0-1,0.45-1,1v0c0,0.55,0.45,1,1,1h7v1.79 c0,0.45,0.54,0.67,0.85,0.35l2.79-2.79C20.84,12.16,20.84,11.84,20.65,11.65z"/></g></g></svg>
				</span>
                <span>Logout</span>
            </a></li>
        <li class="nav-label">Settings</li>

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
    <a href="javascript:void(0);" onclick="deleteAllCookie()" class="btn btn-primary btn-sm cookie-btn">Xóa Cookie</a>
    <div class="sidebar-bottom d-none">
        <h6 class="name">Baohiemoto.vn</h6>
        <span class="ver-info">App Version 1.0</span>
    </div>
    <div class="author-box mt-auto mb-0">
        <div class="dz-media">
            <img src="{{asset('frontend/mobile/assets/images/avatar.png')}}" alt="author-image">
        </div>
        <div class="dz-info">
            <h5 class="name">{{\Illuminate\Support\Facades\Auth::guard('customer')->user()->name}}</h5>
            <span>{{\Illuminate\Support\Facades\Auth::guard('customer')->user()->contact_name}}</span>
        </div>
    </div>
</div>
