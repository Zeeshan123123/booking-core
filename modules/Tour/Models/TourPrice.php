<?php

namespace Modules\Tour\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class TourPrice extends Model
{
    use SoftDeletes;

    protected $table = 'tour_prices';

    protected $fillable = [
        'ranges',
        'distance_from',
        'distance_to',
        'range_1_price',
        'range_1_add',
        'range_1_discount',
        'range_2_price',
        'range_2_add',
        'range_2_discount',
        'range_3_price',
        'range_3_add',
        'range_3_discount',
        'range_4_price',
        'range_4_add',
        'range_4_discount',
        'range_5_price',
        'range_5_add',
        'range_5_discount',
        'range_6_price',
        'range_6_add',
        'range_6_discount',
        'created_at',
        'updated_at',
    ];

    
    // public function getRecordRoot(){
    //     return $this->belongsTo(Car::class,'car_id');
    // }

}