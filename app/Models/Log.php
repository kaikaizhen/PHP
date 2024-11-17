<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table='tzuchiLog';

    protected $primaryKey='id';

    protected $fillable=[
        'Type',
        'Date',
        'Title',
        'description',
        'image_url'
    ];
    public $timestamps = false; // 禁用時間戳
}