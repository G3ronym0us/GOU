<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineVirtualWalletDriver extends Model
{
    use HasFactory;
    protected $table = 'line_virtual_wallet_drivers';
    protected $primaryKey = 'id';

    protected $fillable = [
                            'virtual_wallet_driver_id',
                            'entry',
                            'egress',
                            'inprocess',
                            'paid',
                            'total_driver',
                            'commission',
                            'total'
                        ];

    public function virtualWalletDriver()
    {
        return $this->hasOne('App\Models\VirtualWalletDriver');
    }

    public function travels()
    {   
        $this->belongsToMany('App\Models\Travel');
    }
}
