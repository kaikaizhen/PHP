<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EF extends Model
{
    protected $table='tzuchiEF';

    protected $primaryKey='id';

    protected $fillable=[
        'id',
        'gen_recyclable_weight',
        'rec_recyclable_weight',
        'gen_food_waste_weight',
        'rec_food_waste_weight',
        'gen_general_waste_weight',
        'rec_general_waste_weight',
        'gen_hazardous_weight',
        'rec_hazardous_weight',
        'collection_date'
    ];

    public $timestamps=false;
}
