<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    use HasFactory;
    protected $table = 'prices';
    protected $primaryKey = 'id';

    protected $fillable = [
                            'day',
                            'start',
                            'stop',
                            'value_multi'
                        ];
}
