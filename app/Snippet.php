<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Snippet extends Model
{
    protected $fillable = ['title','snip','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
