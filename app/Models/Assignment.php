<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    public function softwares(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Software::class);
    }

    public function setSoftware(int $softwareId): void
    {
        if (!$this->softwares()->where('software_id', $softwareId)->exists()) {
            $this->softwares()->attach($softwareId);
        }
    }
}
