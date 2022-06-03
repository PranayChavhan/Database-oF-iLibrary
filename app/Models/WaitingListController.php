<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaitingListController extends Model
{
    use HasFactory;
    
    protected $fillable = ['author', 'category', 'title', 'status', 'image', 'userEmail', 'userEnrollment', 'userName'];
}
