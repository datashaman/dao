<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonProfession extends Model
{
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function profession(): BelongsTo
    {
        return $this->belongsTo(Profession::class);
    }

    public function professionLevel(): BelongsTo
    {
        return $this->belongsTo(ProfessionLevel::class);
    }
}
