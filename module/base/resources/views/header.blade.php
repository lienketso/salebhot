<div class="headerpanel">

    <div class="logopanel">
        <h2><a href="{{route('wadmin::dashboard.index.get')}}">Baohiemoto</a></h2>
    </div><!-- logopanel -->

    <div class="headerbar">

        <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>

        <div class="searchpanel">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Tìm kiếm...">
                <span class="input-group-btn">
            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
          </span>
            </div><!-- input-group -->
        </div>

        <div class="header-right">
            @php
                use Illuminate\Support\Facades\Auth;
                use Transaction\Models\Transaction;
                 $userLog = Auth::user();
                $roles = $userLog->load('roles.perms');
                $permissions = $roles->roles->first()->perms;
                $countOrderSale = Transaction::where('sale_admin',$userLog->id)
                ->where('order_status','new')->count();
                $listDon = Transaction::where('sale_admin',$userLog->id)
                ->where('order_status','new')->limit(5);
            @endphp
            <ul class="headermenu">
                <li>
                    <div id="noticePanel" class="btn-group">
                        <button class="btn btn-notice alert-notice" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-globe"></i> <span class="{{($countOrderSale>0) ? 'nhaychu' : ''}}">Đơn hàng mới <b>({{$countOrderSale}})</b></span>
                        </button>

                        <div id="noticeDropdown" class="dropdown-menu dm-notice pull-right">
                            <div role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-justified" role="tablist">
                                    <li class="active"><a data-target="#notification" data-toggle="tab">Đơn hàng mới ({{$countOrderSale}})</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="notification">
                                        <ul class="list-group notice-list">
                                            @foreach($listDon as $d)
                                            <li class="list-group-item unread">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <i class="fa fa-envelope"></i>
                                                    </div>
                                                    <div class="col-xs-10">
                                                        <h5><a href="{{route('wadmin::transaction.edit.get',$d->id)}}">Đơn hàng #{{$d->id}}</a></h5>
                                                        <small>{{format_date($d->created_at)}} lúc {{format_hour($d->created_at)}}</small>
                                                        <span>Từ đại lý {{$d->company->name}}</span>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach

                                        </ul>
                                        <a class="btn-more" href="{{route('wadmin::transaction.accept.get')}}">Vào quản lý đơn hàng <i class="fa fa-long-arrow-right"></i></a>
                                    </div><!-- tab-pane -->


                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div><!-- header-right -->
    </div><!-- headerbar -->
</div><!-- header-->
