<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTangkapan extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $table = 'jenis_tangkapan';

    protected $casts = [
        'id' => 'string',
    ];

    public function activity() {
        return $this->hasMany(Activity::class, 'jenis_tangkapan_id');
    }
}
