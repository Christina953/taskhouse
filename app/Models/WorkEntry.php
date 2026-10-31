<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkEntry extends Model
{
    protected $fillable = [
        'project_id',
        'worker_id',
        'date',
        'hours',
        'description',
        'hourly_rate',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function project (): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function worker (): BelongsTo
    {
        return $this->belongsTo(Worker::class);
    }

    public function cost(): float
    {
        return $this->hours * $this->hourly_rate;
    }
}
