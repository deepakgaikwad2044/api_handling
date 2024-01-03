<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class customer extends Model implements JWTSubject
{
    use HasFactory;

    protected $table = "customers";
    protected $primaryKey = "id";

    protected $fillable = [
        "name","email","password","pincode" ];

        protected $hidden = [
            'password', 'remember_token',
        ];


    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];

    }
}
