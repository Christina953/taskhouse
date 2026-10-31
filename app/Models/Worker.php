<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Worker extends Model
{
    protected $fillable = ['name', 'hourly_rate'];

    public function workEntries(): HasMany
    {
        return $this->hasMany(WorkEntry::class);
    }
}
