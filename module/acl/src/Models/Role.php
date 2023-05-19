<?php


namespace Acl\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name','display_name','description'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('acl.roles_table');
    }
    //relation to perm
    public function perms()
    {
        return $this->belongsToMany(Permission::class, Config::get('acl.permission_role_table'));
    }

    public function users(){
        return $this->belongsToMany(User::class,'role_user','role_id','user_id');
    }

}
