<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{

    use HasFactory;
   protected $fillable =['title','describion','priority','user_id'];
    public function user(){

        return $this->belongsTo(User::class); 
    }
    public function categories(){

        return $this->belongsToMany(Category::class);
    }
}
