<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelabuhan extends Model
{
    use HasFactory;
    protected $table ='pelabuhan';

    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
    ];
    
}
