@php
    $listRoute = [
        'wadmin::video.index.get', 'wadmin::video.create.get', 'wadmin::video.edit.get'
    ];

@endphp
@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
@endphp
@if ($permissions->contains('name','video_index'))
<li class="{{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}"><a href="{{route('wadmin::video.index.get',['post_type'=>'video'])}}"><i class="fa fa-video-camera"></i> <span>Video</span></a></li>
@endif
