<?php

namespace Modules\Car\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class CarPrice extends Model
{
    use SoftDeletes;

    protected $table = 'car_prices';

    protected $fillable = [
        'car_id',
        'ranges',
        'distance_from',
        'distance_to',
        'one_way_trip_price',
        'one_way_trip_discount',
        'round_trip_price',
        'round_trip_discount',
        'created_at',
        'updated_at',
    ];

    
    public function getRecordRoot(){
        return $this->belongsTo(Car::class,'car_id');
    }

}