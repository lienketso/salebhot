@php
    $listRoute = [
        'wadmin::contact.index.get'
    ];

@endphp
@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
@endphp
@if ($permissions->contains('name','contact_index'))
<li class="{{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('wadmin::contact.index.get')}}"><i class="fa fa-paper-plane-o"></i>
        <span>Liên hệ</span> @if($countContact>0)<strong class="alert_an">{{$countContact}}</strong>@endif</a></li>
@endif
