<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // Sluggable
    use Sluggable;
    use SluggableScopeHelpers;

    protected $path = '/storage/images/';

    public function getPictureAttribute($file) {
        return $this->path . $file;
    }

    // To make sure that everything is fillable
    protected $guarded = [];

    public $timestamps = false;

    // Relationship with users table
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title'],
                'onUpdate' => true,
            ]
        ];
    }




}
