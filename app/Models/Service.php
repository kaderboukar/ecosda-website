<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'availability', 'document_path', 'icon_path', 'category_id'
    ];

    // Un service appartient à une catégorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
