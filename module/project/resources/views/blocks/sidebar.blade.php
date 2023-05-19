@php
    $listRoute = [
        'wadmin::project.index.get', 'wadmin::project.create.get', 'wadmin::project.edit.get'
    ];

@endphp
@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
@endphp
@if ($permissions->contains('name','project_index'))
<li class="{{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('wadmin::project.index.get',['post_type'=>'project'])}}"><i class="fa fa-rocket"></i> <span>Thông tin trang chủ</span></a></li>
@endif
