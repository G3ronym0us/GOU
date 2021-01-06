<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VirtualWalletDriver extends Model
{
    use HasFactory;
    protected $table = 'virtual_wallet_drivers';
    protected $primaryKey = 'id';

    protected $fillable = [
                            'driver_id',
                            'total_pending',
                            'total_commission',
                            'total_paid',
                            'last_payment'
                        ];

    public function driver()
    {
        return $this->belongsTo('App\Models\Driver');
    }

    public function lines()
    {
        return $this->hasMany('App\Models\LineVirtualWalletDriver');
    }
}
