<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareSchedule extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $casts = [
        'last_performed_date' => 'date',
        'next_due_date'       => 'date',
    ];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    // public function updateNextDueDate(): void
    // {
    //     $this->next_due_date = $this->last_performed_date->add(
    //         $this->frequency,
    //         strtolower($this->frequency_unit)
    //     );
    //     $this->save();
    // }
}
