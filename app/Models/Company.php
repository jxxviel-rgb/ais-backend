<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';

    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
        'user_id' => 'string'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
