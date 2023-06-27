@extends('frontend::customer.master')
@section('content')
    <header class="header">
        <div class="main-bar">
            <div class="container">
                <div class="header-content">
                    <div class="left-content">
                        <a href="javascript:void(0);" class="back-btn">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.70632 17.9907C1.26501 18.0166 0.830995 17.8682 0.495801 17.5767C-0.165267 16.904 -0.165267 15.8175 0.495801 15.1447L14.971 0.501017C15.6586 -0.149851 16.7375 -0.11367 17.3809 0.5819C17.9627 1.2109 17.9966 2.17769 17.4603 2.84679L2.89977 17.5767C2.56889 17.864 2.14185 18.0121 1.70632 17.9907Z" fill="black"></path>
                                <path d="M16.1645 17.9907C15.7173 17.9888 15.2886 17.8092 14.971 17.4905L0.495743 2.84675C-0.116702 2.12323 -0.0334367 1.03438 0.681756 0.414752C1.32008 -0.138251 2.26149 -0.138251 2.89976 0.414752L17.4603 15.0585C18.1477 15.7095 18.1832 16.801 17.5397 17.4964C17.5141 17.5241 17.4876 17.5508 17.4603 17.5767C17.1037 17.8904 16.6345 18.0403 16.1645 17.9907Z" fill="black"></path>
                            </svg>
                        </a>
                        <h5 class="title mb-0 text-nowrap">Đổi mật khẩu</h5>
                    </div>
                    <div class="mid-content">
                    </div>
                    <div class="right-content">
                        <a href="javascript:void(0);"
                           class="text-dark font-20 SaveInfo"
                           data-id=""
                           data-url=""
                        >
                            <i class="fa-solid fa-check"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="page-content">
        <div class="account-box">
            <div class="container">
                <div class="account-area">
                    <div>
                        <h2 class="title">Đổi mật khẩu</h2>
                        <p class="text-soft">Nhập mật khẩu mới để hoàn thành đổi mật khẩu tài khoản của bạn</p>
                        <form method="post">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="error-change">
                                @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                                <div class="mb-3 input-group input-group-icon">

                                    <div class="input-group-text">
                                        <div class="input-icon">
                                            <svg width="14" height="20" viewBox="0 0 14 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13 6H12V3C12 2.20435 11.6839 1.44129 11.1213 0.87868C10.5587 0.316071 9.79565 0 9 0H5C4.20435 0 3.44129 0.316071 2.87868 0.87868C2.31607 1.44129 2 2.20435 2 3V6H1C0.734784 6 0.48043 6.10536 0.292893 6.29289C0.105357 6.48043 0 6.73478 0 7V15C0 16.3261 0.526784 17.5979 1.46447 18.5355C2.40215 19.4732 3.67392 20 5 20H9C10.3261 20 11.5979 19.4732 12.5355 18.5355C13.4732 17.5979 14 16.3261 14 15V7C14 6.73478 13.8946 6.48043 13.7071 6.29289C13.5196 6.10536 13.2652 6 13 6ZM4 3C4 2.73478 4.10536 2.48043 4.29289 2.29289C4.48043 2.10536 4.73478 2 5 2H9C9.26522 2 9.51957 2.10536 9.70711 2.29289C9.89464 2.48043 10 2.73478 10 3V6H4V3ZM8 13.72V15C8 15.2652 7.89464 15.5196 7.70711 15.7071C7.51957 15.8946 7.26522 16 7 16C6.73478 16 6.48043 15.8946 6.29289 15.7071C6.10536 15.5196 6 15.2652 6 15V13.72C5.69772 13.5455 5.44638 13.2949 5.27095 12.9932C5.09552 12.6914 5.00211 12.349 5 12C5 11.4696 5.21071 10.9609 5.58579 10.5858C5.96086 10.2107 6.46957 10 7 10C7.53043 10 8.03914 10.2107 8.41421 10.5858C8.78929 10.9609 9 11.4696 9 12C8.99789 12.349 8.90448 12.6914 8.72905 12.9932C8.55362 13.2949 8.30228 13.5455 8 13.72Z" fill="#7D8FAB"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <input type="password" name="old_password" class="form-control dz-password" placeholder="Mật khẩu cũ *">
                                    <span class="input-group-text show-pass">
                                        <i class="fa fa-eye-slash text-primary"></i>
                                        <i class="fa fa-eye text-primary"></i>
								    </span>

                                </div>
                                <div class="error-change">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            <div class="mb-3 input-group input-group-icon">
                                <div class="input-group-text">
                                    <div class="input-icon">
                                        <svg width="14" height="20" viewBox="0 0 14 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13 6H12V3C12 2.20435 11.6839 1.44129 11.1213 0.87868C10.5587 0.316071 9.79565 0 9 0H5C4.20435 0 3.44129 0.316071 2.87868 0.87868C2.31607 1.44129 2 2.20435 2 3V6H1C0.734784 6 0.48043 6.10536 0.292893 6.29289C0.105357 6.48043 0 6.73478 0 7V15C0 16.3261 0.526784 17.5979 1.46447 18.5355C2.40215 19.4732 3.67392 20 5 20H9C10.3261 20 11.5979 19.4732 12.5355 18.5355C13.4732 17.5979 14 16.3261 14 15V7C14 6.73478 13.8946 6.48043 13.7071 6.29289C13.5196 6.10536 13.2652 6 13 6ZM4 3C4 2.73478 4.10536 2.48043 4.29289 2.29289C4.48043 2.10536 4.73478 2 5 2H9C9.26522 2 9.51957 2.10536 9.70711 2.29289C9.89464 2.48043 10 2.73478 10 3V6H4V3ZM8 13.72V15C8 15.2652 7.89464 15.5196 7.70711 15.7071C7.51957 15.8946 7.26522 16 7 16C6.73478 16 6.48043 15.8946 6.29289 15.7071C6.10536 15.5196 6 15.2652 6 15V13.72C5.69772 13.5455 5.44638 13.2949 5.27095 12.9932C5.09552 12.6914 5.00211 12.349 5 12C5 11.4696 5.21071 10.9609 5.58579 10.5858C5.96086 10.2107 6.46957 10 7 10C7.53043 10 8.03914 10.2107 8.41421 10.5858C8.78929 10.9609 9 11.4696 9 12C8.99789 12.349 8.90448 12.6914 8.72905 12.9932C8.55362 13.2949 8.30228 13.5455 8 13.72Z" fill="#7D8FAB"></path>
                                        </svg>
                                    </div>
                                </div>
                                <input type="password" name="password" class="form-control dz-password" placeholder="Mật khẩu mới *">
                                <span class="input-group-text show-pass">
									<i class="fa fa-eye-slash text-primary"></i>
									<i class="fa fa-eye text-primary"></i>
								</span>

                            </div>
                            <div class="mb-3 input-group input-group-icon">
                                <div class="input-group-text">
                                    <div class="input-icon">
                                        <svg width="14" height="20" viewBox="0 0 14 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13 6H12V3C12 2.20435 11.6839 1.44129 11.1213 0.87868C10.5587 0.316071 9.79565 0 9 0H5C4.20435 0 3.44129 0.316071 2.87868 0.87868C2.31607 1.44129 2 2.20435 2 3V6H1C0.734784 6 0.48043 6.10536 0.292893 6.29289C0.105357 6.48043 0 6.73478 0 7V15C0 16.3261 0.526784 17.5979 1.46447 18.5355C2.40215 19.4732 3.67392 20 5 20H9C10.3261 20 11.5979 19.4732 12.5355 18.5355C13.4732 17.5979 14 16.3261 14 15V7C14 6.73478 13.8946 6.48043 13.7071 6.29289C13.5196 6.10536 13.2652 6 13 6ZM4 3C4 2.73478 4.10536 2.48043 4.29289 2.29289C4.48043 2.10536 4.73478 2 5 2H9C9.26522 2 9.51957 2.10536 9.70711 2.29289C9.89464 2.48043 10 2.73478 10 3V6H4V3ZM8 13.72V15C8 15.2652 7.89464 15.5196 7.70711 15.7071C7.51957 15.8946 7.26522 16 7 16C6.73478 16 6.48043 15.8946 6.29289 15.7071C6.10536 15.5196 6 15.2652 6 15V13.72C5.69772 13.5455 5.44638 13.2949 5.27095 12.9932C5.09552 12.6914 5.00211 12.349 5 12C5 11.4696 5.21071 10.9609 5.58579 10.5858C5.96086 10.2107 6.46957 10 7 10C7.53043 10 8.03914 10.2107 8.41421 10.5858C8.78929 10.9609 9 11.4696 9 12C8.99789 12.349 8.90448 12.6914 8.72905 12.9932C8.55362 13.2949 8.30228 13.5455 8 13.72Z" fill="#7D8FAB"></path>
                                        </svg>
                                    </div>
                                </div>
                                <input type="password" name="password_confirmation" class="form-control dz-password" placeholder="Nhập lại mật khẩu *">
                                <span class="input-group-text show-pass">
									<i class="fa fa-eye-slash text-primary"></i>
									<i class="fa fa-eye text-primary"></i>
								</span>
                            </div>
                            <div class="btn-change-pass">
                                <button type="submit" class="btn btn-secondary w-100">Xác nhận</button>
                            </div>
                        </form>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0);" class="text-light text-center d-block">Chưa có tài khoản?</a>
                            <a href="javascript:void(0);" class="btn-link d-block ms-2 text-underline">Đăng ký</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
