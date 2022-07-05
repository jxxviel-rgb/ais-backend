<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrewDepature extends Model
{
    use HasFactory;
    protected $table = 'crew_departure';

    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
        'crew_id' => 'string'
    ];

    public function crew() {
        return $this->belongsTo(Crew::class);
    }

}
