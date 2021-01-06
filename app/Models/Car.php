<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';
    protected $primaryKey = 'id';

    protected $fillable = [
                            'user_id',
                            'model_id',
                            'car_year',
                            'car_color',
                            'car_patent'
                        ];

    public function typeVehicle()
    {
        return $this->hasOne('App\Models\TypeVehicle', 'id', 'type_vehicle_id');
    }
}
