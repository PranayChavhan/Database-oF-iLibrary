<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcceptBook extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'userEnrollment', 'image', 'id'];
}
