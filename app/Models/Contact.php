<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kirschbaum\PowerJoins\PowerJoins;

class Contact extends Model
{
    use HasFactory;
    use PowerJoins;

    protected $guarded = ['id'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
