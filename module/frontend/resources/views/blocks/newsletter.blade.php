<section class="newsletter theme-bg" style="background-image:url({{asset('frontend/assets/img')}}/bg-new.png)">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="heading light">
                    <h2>{{trans('frontend.subscribe')}}</h2>
                    <p>{{trans('frontend.subscribe_desc')}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="alert-content"></div>
            <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
                <div class="newsletter-box text-center">
                    <div class="input-group"> <span class="input-group-addon"><span class="ti-email theme-cl"></span></span>
                        <input type="email" class="form-control" name="email" placeholder="{{trans('frontend.enter_your_email')}}...">
                    </div>
                    <button data-url="{{route('ajax.newsletter.get')}}" type="button" id="btnNewsletter" class="btn theme-btn btn-radius btn-m">{{trans('frontend.subscribe_button')}}</button>
                </div>
                <div style="text-align: center;" class="alert_about" id="alert_success"></div>
            </div>
        </div>
    </div>
</section>
