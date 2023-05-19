@extends('frontend::master')
@section('content')
<div class="page-title">
    <div class="container">
        <div class="page-caption">
            <h2>Create an Account</h2>
            <p><a href="{{route('frontend::home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> SignUp</p>
        </div>
    </div>
</div>
<section class="padd-top-80 padd-bot-80">
    <div class="container">
        <div class="log-box">
            <form class="log-form">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="********">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" placeholder="********">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" placeholder="Phone Number">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group text-center mrg-top-15">
                        <button type="submit" class="btn theme-btn btn-m full-width">Sign Up</button>
                    </div>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</section>
    @endsection
