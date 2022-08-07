<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    protected $table = 'position';

    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
    ];

    public function vessel()
    {
        $this->belongsTo(Vessel::class);
    }
}
