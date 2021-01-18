<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class SubscripPackage extends Model
{
  
    protected $fillable = [ 'title', 'slug', 'description', 'price' ,'duration','active'];

}
