<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Sofa\Eloquence\Eloquence;

class Snippet extends Model
{
    use Eloquence;

    protected $searchableColumns = ['title'];
    protected $fillable = ['title','snip','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
