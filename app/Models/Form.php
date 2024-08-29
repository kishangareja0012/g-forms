<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = str()->uuid()->toString();
        });
    }

    public function formField()
    {
        return $this->hasMany(FormField::class);
    }
}
