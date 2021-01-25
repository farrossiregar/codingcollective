<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    use HasFactory;
    protected $connection = 'epl_pmt';
    protected $table = 'region_cluster';

    public function region()
    {
        return $this->belongsTo(\App\Models\Region::class);
    }
}