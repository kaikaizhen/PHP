<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogItem extends Model
{
    protected $table='tzuchiLogItem';

    protected $primaryKey='id';

    protected $fillable=[
        'Date',
        'Number',
        'Title',
        'description',
        'image_url'
    ];
    public $timestamps = false; // 禁用時間戳
}
