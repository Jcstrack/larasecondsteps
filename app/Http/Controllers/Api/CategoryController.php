<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\PutRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class CategoryController extends Controller
{

    public function all()
    {
        try {
            return response()->json(Category::get());
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener todas las categías: ' . $e->getMessage()], 500);
        }
    }
    // Este método devuelve una lista paginada de recursos en formato JSON.
    public function index()
    {
        try {
            // Devuelve una respuesta JSON con una lista paginada de categorías, 10 por página.
            return response()->json(Category::paginate(10));
        } catch (Exception $e) {
            // Maneja cualquier excepción y devuelve un error 500 con el mensaje de la excepción.
            return response()->json(['error' => 'Error al obtener las categorías: ' . $e->getMessage()], 500);
        }
    }

    // Este método almacena un nuevo recurso en la base de datos.
    public function store(StoreRequest $request)
    {
        try {
            // Crea una nueva categoría utilizando los datos validados de la solicitud.
            $category = Category::create($request->validated());
            // Devuelve la categoría recién creada como una respuesta JSON.
            return response()->json($category, 201); // Devuelve un código de estado 201 (creado).
        } catch (Exception $e) {
            // Maneja cualquier excepción y devuelve un error 500 con el mensaje de la excepción.
            return response()->json(['error' => 'Error al crear la categoría: ' . $e->getMessage()], 500);
        }
    }

    // Este método muestra un recurso específico.
    public function show(Category $category)
    {
        try {
            // Devuelve la categoría especificada como una respuesta JSON.
            return response()->json($category);
        } catch (ModelNotFoundException $e) {
            // Maneja el caso en que no se encuentra la categoría y devuelve un error 404.
            return response()->json(['error' => 'Categoría no encontrada'], 404);
        } catch (Exception $e) {
            // Maneja cualquier otra excepción y devuelve un error 500.
            return response()->json(['error' => 'Error al obtener la categoría: ' . $e->getMessage()], 500);
        }
    }


    public function slug(string $slug)
    {
        try {
            $post = Category::where('slug', $slug)->firstOrFail();
            return response()->json($post);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener datos por slug:' . $e->getMessage()], 500);
        }
    }

    // Este método actualiza un recurso específico en la base de datos.
    public function update(PutRequest $request, Category $category)
    {
        try {
            // Actualiza la categoría utilizando los datos validados de la solicitud.
            $category->update($request->validated());
            // Devuelve la categoría actualizada como una respuesta JSON.
            return response()->json($category);
        } catch (ModelNotFoundException $e) {
            // Maneja el caso en que no se encuentra la categoría y devuelve un error 404.
            return response()->json(['error' => 'Categoría no encontrada'], 404);
        } catch (Exception $e) {
            // Maneja cualquier otra excepción y devuelve un error 500.
            return response()->json(['error' => 'Error al actualizar la categoría: ' . $e->getMessage()], 500);
        }
    }

    // Este método elimina un recurso específico de la base de datos.
    public function destroy(Category $category)
    {
        try {
            // Elimina la categoría especificada de la base de datos.
            $category->delete();
            // Devuelve una respuesta JSON con un mensaje de éxito.
            return response()->json(['message' => 'Categoría eliminada con éxito']);
        } catch (ModelNotFoundException $e) {
            // Maneja el caso en que no se encuentra la categoría y devuelve un error 404.
            return response()->json(['error' => 'Categoría no encontrada'], 404);
        } catch (Exception $e) {
            // Maneja cualquier otra excepción y devuelve un error 500.
            return response()->json(['error' => 'Error al eliminar la categoría: ' . $e->getMessage()], 500);
        }
    }
}
