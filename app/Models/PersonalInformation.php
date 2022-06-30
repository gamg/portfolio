<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PersonalInformation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'cv', 'image'];

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::disk('google')->url($this->image ?? 'hero/default-hero.jpg'),
        );
    }

    protected function cvUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::disk('google')->url($this->cv ?? 'cv/my-cv.pdf'),
        );
    }
}
