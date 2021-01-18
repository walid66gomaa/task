<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscripPackageItem extends Model
{
    protected $fillable = [ 'user_id', 'slug', 'description', 'price' ,'duration','active','subscrip_package_id'];
   
    public function user(){
        return $this->belongsTo(User::class);
    }

}
