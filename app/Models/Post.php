<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['name_en','name_ar','desc','address','phone','image'];
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
