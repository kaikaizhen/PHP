<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table='Site';
    protected $primaryKey = 'Id';
    protected $fillable=[
        'Type',
        'Class',
        'Name',
        'Site',
        'Lat',
        'Lng',
        'Description',
        'StartDate',
        'EndDate'
    ];

    public $timestamps=false;
}
