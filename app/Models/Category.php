<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Une catégorie peut avoir plusieurs projets
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // Une catégorie peut avoir plusieurs services
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
