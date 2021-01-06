<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $table = 'drivers';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
                            'user_id',
                            'car_id',
                            'documentation_id',
                            'latitud',
                            'longitud',
                            'validated',
                            'in_travel',
                            'offline',
                            'banned',
                            'deleted_at',
                        ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function balancesReverse()
    {
        return $this->hasMany('App\Models\BalanceDriver')->orderBy('created_at', 'desc');
    }
    
    public function car()
    {
        return $this->belongsTo('App\Models\Car', 'user_id', 'user_id');
    }

    public function documentation()
    {
        return $this->belongsTo('App\Models\Documentation', 'user_id', 'user_id');
    }

    public function travelsFinished()
    {
        return $this->hasOne('App\Models\Travel', 'driver_id', 'id')->where('status', 6);
    }
}
