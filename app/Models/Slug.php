<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    use HasFactory;

    
    protected $table = 'slugs';

    protected $fillable = [
        'key',
        'reference_id',
        'reference_type',
    ];
}