<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Url extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function name(): BelongsTo
    {
        return $this->belongsTo(Name::class);
    }
    
    public function surname(): BelongsTo
    {
        return $this->belongsTo(Surname::class);
    }
    
    public function phone(): BelongsTo
    {
        return $this->belongsTo(Phone::class);
    }
    
    public function email(): BelongsTo
    {
        return $this->belongsTo(Email::class);
    }
    
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }
}
