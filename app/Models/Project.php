<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'location', 'start_date', 'end_date', 'status', 'progress',
        'budget', 'image_path', 'document_path', 'client_name', 'client_company', 'category_id'
    ];

    // Un projet appartient à une catégorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Un projet peut avoir plusieurs témoignages
    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
}
