<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FertilizingLog extends Model
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
        'fertilizing_date' => 'date',
        'amount' => 'decimal:2',
    ];

    /**
     * Relationship with the Plant model.
     * Assuming each fertilizing log belongs to a plant.
     */
    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }
}
