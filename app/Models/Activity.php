<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table = 'activity';
    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
        'company_id' => 'string',
        // 'vessel_id' => ' string'
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function vessel() {
        return $this->belongsTo(Vessel::class);
    }

    public function crew() {
        return $this->hasMany(CrewDepature::class, 'activity_id', 'id');
    }

}

