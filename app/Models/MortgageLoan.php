<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MortgageLoan extends Model
{
    use HasFactory;

    protected $table = 'mortgage_loans';

    protected $guarded = ['id'];
}
