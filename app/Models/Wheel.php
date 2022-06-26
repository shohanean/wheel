<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wheel extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['used_status', 'discount'];
}
