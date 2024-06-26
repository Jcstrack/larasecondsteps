<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class PostController extends Controller
{
    public function all()
    {
        try {
            return response()->json(Post::get());
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener todas las publicaciones: ' . $e->getMessage()], 500);
        }
    }
    /**
     * Muestra una lista de los recursos.
     */
    public function index()
    {
        try {
            // Intenta obtener una lista paginada de publicaciones.
            return response()->json(Post::paginate(10));
        } catch (Exception $e) {
            // Maneja cualquier excepción y devuelve un error 500 con el mensaje de la excepción.
            return response()->json(['error' => 'Error al obtener las publicaciones: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Almacena un nuevo recurso en la base de datos.
     */
    public function store(StoreRequest $request)
    {
        try {
            // Intenta crear una nueva publicación con los datos validados.
            $post = Post::create($request->validated());
            return response()->json($post, 201); // Devuelve la publicación creada con un código de estado 201.
        } catch (Exception $e) {
            // Maneja cualquier excepción y devuelve un error 500 con el mensaje de la excepción.
            return response()->json(['error' => 'Error al crear la publicación: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Muestra un recurso específico.
     */
    public function show(Post $post)
    {
        try {
            // Devuelve la publicación especificada.
            return response()->json($post);
        } catch (ModelNotFoundException $e) {
            // Maneja el caso en que no se encuentra la publicación y devuelve un error 404.
            return response()->json(['error' => 'Publicación no encontrada'], 404);
        } catch (Exception $e) {
            // Maneja cualquier otra excepción y devuelve un error 500.
            return response()->json(['error' => 'Error al obtener la publicación: ' . $e->getMessage()], 500);
        }
    }

    public function slug(string $slug)
    {
        // try {
        $post = Post::where('slug', $slug)->firstOrFail();
        return response()->json($post);
        // } catch (Exception $e) {
        //     return response()->json(['error' => 'Error al obtener datos por slug:' . $e->getMessage()], 500);
        // }
    }

    /**
     * Actualiza un recurso específico en la base de datos.
     */
    public function update(PutRequest $request, Post $post)
    {
        try {
            // Intenta actualizar la publicación con los datos validados.
            $post->update($request->validated());
            return response()->json($post);
        } catch (ModelNotFoundException $e) {
            // Maneja el caso en que no se encuentra la publicación y devuelve un error 404.
            return response()->json(['error' => 'Publicación no encontrada'], 404);
        } catch (Exception $e) {
            // Maneja cualquier otra excepción y devuelve un error 500.
            return response()->json(['error' => 'Error al actualizar la publicación: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Elimina un recurso específico de la base de datos.
     */
    public function destroy(Post $post)
    {
        try {
            // Intenta eliminar la publicación especificada.
            $post->delete();
            return response()->json(['message' => 'Publicación eliminada con éxito']);
        } catch (ModelNotFoundException $e) {
            // Maneja el caso en que no se encuentra la publicación y devuelve un error 404.
            return response()->json(['error' => 'Publicación no encontrada'], 404);
        } catch (Exception $e) {
            // Maneja cualquier otra excepción y devuelve un error 500.
            return response()->json(['error' => 'Error al eliminar la publicación: ' . $e->getMessage()], 500);
        }
    }
}
