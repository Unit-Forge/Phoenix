<?php

namespace Phoenix\Http\Controllers\Frontend\API\Unit\Documentation;

use Illuminate\Http\Request;
use Phoenix\Http\Controllers\Controller;
use Phoenix\Http\Requests\Unit\Documentation\Category\CreateCategory;
use Phoenix\Http\Requests\Unit\Documentation\Category\DeleteCategory;
use Phoenix\Http\Requests\Unit\Documentation\Category\UpdateCategory;
use Phoenix\Models\Unit\Documentation\Category;

/**
 * Class CategoryController
 * @package Phoenix\Http\Controllers\Frontend\API\Unit\Documentation
 */
class CategoryController extends Controller
{
    /**
     * Get all Categories
     *
     * Returns all categories
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories->toArray());
    }

    /**
     * Create a Category
     *
     * Create a category based on the input
     *
     * @param CreateCategory $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateCategory $request)
    {
        $category = Category::create($request->all());
        return response()->json($category->toArray());
    }

    /**
     * Get a Category
     *
     * Retrieves a category and returns it
     *
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Category $category)
    {
        return response()->json($category->toArray());
    }

    /**
     * Update a Category
     *
     * Updates a category based on input
     *
     * @param Category $category
     * @param UpdateCategory $request
     * @return bool
     */
    public function update(Category $category, UpdateCategory $request)
    {
        if($category->update($request->all()))
        {
            return response('',200);
        } else {
            return response('',400);
        }
    }

    /**
     * Delete a Category
     *
     * Deletes a category based on ID
     *
     * @param Category $category
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(Category $category)
    {
        if($category->delete())
        {
            return response('',204);
        } else {
            return response('',400);
        }
    }
}
