<div class="modal fade" id="partner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="myModalLabel1">
            <div class="modal-body">
                <h4 class="title_model">{{trans('frontend.title_form_partner')}} <strong id="companyName" style="color: #26ae61"></strong></h4>
                <form method="get" id="frmFormPartner">
                    {{csrf_field()}}
                    <input type="hidden" name="company_id" value="">
                    <div class="form-group">
                        <div class="form_part">
                            <span id="sp_name">{{trans('frontend.required')}}</span>
                        <input type="text" class="form-control " value="" id="partName"  name="name" placeholder="{{trans('frontend.name')}}*">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form_part">
                            <span id="sp_mail">{{trans('frontend.mail_valid')}}</span>
                        <input type="text" class="form-control" id="partMail" name="email" placeholder="{{trans('frontend.email')}}*">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="partPhone" name="phone" placeholder="{{trans('frontend.phone')}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="partCominfor" name="company_info" placeholder="{{trans('frontend.company_name')}}">
                    </div>
                    <div class="form-group">
                        <div class="form_part">
                            <span id="sp_nation">{{trans('frontend.required')}}</span>
                        <input type="text" class="form-control" id="partNation" name="nation" placeholder="{{trans('frontend.your_nation')}}*">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form_part">
                            <span id="sp_address">{{trans('frontend.required')}}</span>
                        <input type="text" class="form-control" id="partAddress" name="address" placeholder="{{trans('frontend.address')}}*">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form_part">
                            <span id="sp_message">{{trans('frontend.mess_valid')}}</span>
                        <textarea class="form-control" rows="4" id="partMessage" name="message" placeholder="{{trans('frontend.your_request')}}*"></textarea>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="button" id="btnPartner" data-url="{{route('ajax.create.partner.get')}}" class="btn theme-btn full-width btn-m">{{trans('frontend.send_request')}}</button>
                    </div>
                </form>

                <div class="message_success" id="successPartner">
                    <p>{{trans('frontend.partner_message_1')}} <a href="mailto:info@lienketso.vn">info@lienketso.vn</a>, Click <a href="{{route('frontend::home')}}">Here</a> {{trans('frontend.partner_message_2')}}</p>
                </div>

            </div>
        </div>
    </div>
</div>
