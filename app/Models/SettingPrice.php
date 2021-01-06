<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingPrice extends Model
{
    use HasFactory;

    protected $table = 'setting_prices';
    protected $primaryKey = 'id';

    protected $fillable = [
                            'base_price',
                            'limit_km',
                            'price_km',
                            'price_min'
                        ];
}
