<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Definición de un modelo llamado "Post" que extiende la clase "Model" de Laravel
class Post extends Model
{
    // Usa el trait "HasFactory" para habilitar la generación de instancias de este modelo mediante factories
    use HasFactory;

    // Define los atributos que se pueden asignar de forma masiva
    // Esto es útil para la protección contra asignación masiva (Mass Assignment)
    protected $fillable = [
        'title',        // Título del post
        'slug',         // URL amigable del post
        'content',      // Contenido del post
        'category_id',  // ID de la categoría a la que pertenece el post
        'description',  // Descripción breve del post
        'posted',       // Estado de publicación (publicado o no)
        'image'         // URL o ruta de la imagen asociada al post
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
