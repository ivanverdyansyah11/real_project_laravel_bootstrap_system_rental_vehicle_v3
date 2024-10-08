<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleSeries extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function vehicle_brand()
    {
        return $this->belongsTo(VehicleBrand::class, 'vehicle_brands_id')->withTrashed();
    }
}
