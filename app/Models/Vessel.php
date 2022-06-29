<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vessel extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = 'vessel';

    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function pelabuhan() {
        return $this->belongsTo(Pelabuhan::class);
    }


}
