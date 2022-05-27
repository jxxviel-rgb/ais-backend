<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vessel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
        'fisherman_id' => 'string',
        'vessels_type_id' => 'string',
    ];

    public function fisherman() {
        return $this->belongsTo(Fishermans::class);
    }

    public function vesselType() {
        return $this->belongsTo(VesselsType::class, 'vessels_type_id', 'id');
    }
}
