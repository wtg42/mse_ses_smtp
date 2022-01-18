<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MseIpList extends Model
{
    use HasFactory;

    protected $table = 'mse_ip_lists';
    protected $fillable = [
        'name',
        'ipv4',
    ];
}
