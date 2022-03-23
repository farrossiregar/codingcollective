<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Region;
use App\Models\SubRegion;

class HealthCheck extends Model
{
    use HasFactory;

    protected $table = 'health_check';

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    
    public function sub_region()
    {
        return $this->belongsTo(SubRegion::class);
    }
}
