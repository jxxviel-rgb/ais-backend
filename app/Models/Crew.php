<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    use HasFactory;
    protected $table = 'crew';

    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
