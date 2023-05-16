<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'name',
        'description',
        'done',
        'user_id',
        
    ];

    protected $hidden = [
        // 'user_id'
    ];

}
