<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    use HasFactory;

    protected $table = 'documentations';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
                            'user_id',
                            'license',
                            'license_img',
                            'carlicense',
                            'carlicense_img',
                            'insurance',
                            'insurance_img',
                            'vtv',
                            'vtv_img',
                            'front_img',
                            'back_img',
                            'left_img',
                            'right_img',
                            'deleted_at',
                            'license_status',
                            'carlicense_status',
                            'insurance_status',
                            'vtv_status',
                            'front_status',
                            'back_status',
                            'right_status',
                            'left_status',
                        ];
}
