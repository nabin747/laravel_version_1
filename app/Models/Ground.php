<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ground extends Model
{
    use HasFactory;

    protected $fillable =[
        'admin_id',
        'groundName',
        'location',
        'description'
    ];

    public  function admin()
    {
        return $this->belongsTo(User::class,'admin_id','id');
    }
}


