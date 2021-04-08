<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class CommitmentDaily extends Model
{
    use HasFactory;

    protected $table = 'commitment_dailys';

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}