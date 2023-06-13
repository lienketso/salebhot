<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Customer extends Authenticatable
{
    use Notifiable;

    protected $guarded = 'customer';

    protected $fillable = [
      'phone',
      'password',
        'name',
        'status'
    ];

    protected $table = 'company';

    protected $hidden = [
        'password', 'remember_token',
    ];
}
