<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'input_id',
        'label',
        'options',
        'is_required'
    ];

    protected $casts = [
        'options' => 'array'
    ];

    public function input()
    {
        return $this->belongsTo(Input::class);
    }
}
