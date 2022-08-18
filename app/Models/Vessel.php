<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vessel extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
    // use SoftDeletes;
    protected $table = 'vessel';

    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function pelabuhan()
    {
        return $this->belongsTo(Pelabuhan::class);
    }
    public function position()
    {
        return $this->hasMany(Position::class)->latest();
    }
    public function latestPosition()
    {
        return $this->hasOne(Position::class)->latest()->limit(1);
    }
}
