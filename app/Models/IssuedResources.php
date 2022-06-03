<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuedResources extends Model
{
    use HasFactory;
    
    protected $fillable = ['userEmail', 'userName', 'image', 'title', 'from', 'to'];
}
