<?php


namespace Company\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Product\Models\Catproduct;
use Transaction\Models\Transaction;
use Users\Models\Users;
use Wallets\Models\Wallets;

class Company extends Model
{
    protected $table = 'company';
    protected $fillable = ['name','company_code','contact_name','slug','city','address','phone','email','bank_number','bank_name','description','content','thumbnail',
        'user_id','cccd_mt','cccd_ms','count_view','status','avatar','parent','c_type','director_id','sale_admin'];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value,'-','');
    }

    public function getUserPost(){
        return $this->belongsTo(Users::class,'user_post','id');
    }
    public function user(){
        return $this->belongsTo(Users::class,'user_id','id');
    }
    public function sales(){
        return $this->belongsTo(Users::class,'sale_admin','id');
    }
    //relation to perm
    public function category()
    {
        return $this->belongsToMany(Catproduct::class, 'catproduct_company','company_id','cat_id');
    }

    public function companyPivot(){
        return $this->belongsToMany(Catproduct::class,'catproduct_company','company_id')
            ->with('category')->withPivot(['company_id','cat_id']);
    }

    public function getallCattegory(){
        $allcat = $this->category()->get();
        if(!empty($allcat)){
            foreach($allcat as $row){
                echo '<span class="skill-tag">'.$row->name.'</span>';
            }
        }else{
            return '';
        }
    }

    public function getCategory()
    {
        $cat = $this->category()->first();
        if (!empty($cat)) {
            return $cat->name;
        } else {
            echo '<span style="color:#c00">Chưa chọn danh mục</span>';
        }
    }

    public function getTransaction(){
        return $this->hasMany(Transaction::class,'company_id','id');
    }

    public function getWallet(){
        return $this->hasMany(Wallets::class,'company_id','id');
    }

    public static function assignUsers()
    {
        $users = Users::where('status','active')->whereHas('roles', function ($query) {
            $query->where('role_id', 9);
        })->get();
        $distributors = Company::where('status','!=','disable')
            ->where('c_type','distributor')
            ->get();

        $totalUsers = $users->count();
        $totalDistributors = $distributors->count();

        $distributorIndex = 0;
        for ($i = 0; $i < $totalDistributors; $i++) {
            $com = $distributors[$i];

            $com->sales()->associate($users[$distributorIndex])->save();

            $distributorIndex++;
            if ($distributorIndex === $totalUsers) {
                $distributorIndex = 0;
            }
        }
    }

}
