<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantIssue extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Cast attributes to native types.
     */
    protected $casts = [
        'identified_date' => 'date',
        'resolved_date' => 'date',
    ];

    /**
     * Relationship with the Plant model.
     */
    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }
}
