@php
    $listRoute = [
        'wadmin::gallery.index.get', 'wadmin::gallery.create.get', 'wadmin::gallery.edit.get','wadmin::group.index.get','wadmin::group.create.get','wadmin::group.edit.get'
    ];
@endphp
@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
@endphp
@if ($permissions->contains('name','gallery_index'))
<li class="{{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('wadmin::group.index.get')}}"><i class="fa fa-camera-retro"></i> <span>Thư viện ảnh</span></a>
</li>
@endif
