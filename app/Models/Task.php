<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'due_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene la traducción del estado para mostrarlo en la vista.
     */
    public function getStatusLabelAttribute()
    {
        return [
            'pending'     => 'Pendiente',
            'in_progress' => 'En progreso',
            'completed'   => 'Completado',
        ][$this->status] ?? $this->status;
    }

// Colores para los badges
public function getStatusColorAttribute()
{
    return [
        'pending' => 'bg-yellow-200 text-yellow-800',
        'in_progress' => 'bg-blue-200 text-blue-800',
        'completed' => 'bg-green-200 text-green-800',
    ][$this->status] ?? 'bg-gray-200 text-gray-800';
}
}
