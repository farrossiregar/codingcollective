<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class ClaimingProcessLimit extends Model
{
    use HasFactory;

    protected $table = 'claiming_process_limit';

}