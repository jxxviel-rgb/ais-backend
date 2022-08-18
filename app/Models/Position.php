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
    protected $appends = ['last_report'];

    public function vessel()
    {
        $this->belongsTo(Vessel::class);
    }
    public function getLastReportAttribute()
    {
        // return new Attribute(
        //     get: fn () => $this->created_at->diffForHumans()
        // );
        return $this->created_at->diffForHumans();
    }
}
