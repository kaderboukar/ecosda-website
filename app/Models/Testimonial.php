<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name', 'client_company', 'feedback', 'rating', 'project_id'
    ];

    // Un témoignage est associé à un projet
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
