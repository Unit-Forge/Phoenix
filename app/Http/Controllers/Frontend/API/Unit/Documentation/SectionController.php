<?php

namespace Phoenix\Http\Controllers\Frontend\API\Unit\Documentation;

use Illuminate\Http\Request;
use Phoenix\Http\Controllers\Controller;
use Phoenix\Http\Requests\Unit\Documentation\Section\CreateSection;
use Phoenix\Http\Requests\Unit\Documentation\Section\DeleteSection;
use Phoenix\Http\Requests\Unit\Documentation\Section\UpdateSection;
use Phoenix\Models\Unit\Documentation\Category;
use Phoenix\Models\Unit\Documentation\Section;

/**
 * Class SectionController
 * @package Phoenix\Http\Controllers\Frontend\API\Unit\Documentation
 */
class SectionController extends Controller
{
    /**
     * Get all Sections
     *
     * Returns all Sections
     *
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Category $category)
    {
        return response()->json($category->sections->toArray());
    }

    /**
     * Create a Section
     *
     * Create a section based on the input
     *
     * @param Category $category
     * @param CreateSection $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Category $category, CreateSection $request)
    {
        $section = $category->sections()->create($request->all());
        return response()->json($section->toArray());
    }

    /**
     * Get a Section
     *
     * Retrieves section and returns it
     *
     * @param Category $category
     * @param Section $section
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Category $category, Section $section)
    {
        return response()->json($section->toArray());
    }


    /**
     * Update a Section
     *
     * Updates a Section based on input
     *
     * @param Category $category
     * @param UpdateSection $request
     * @return bool
     */
    public function update(Category $category, Section $section, UpdateSection $request)
    {
        if($section->update($request->all()))
        {
            return response('',200);
        } else {
            return response('',400);
        }
    }

    /**
     * Delete a Section
     *
     * Deletes a Section based on ID
     *
     * @param Category $category
     * @param Section $section
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(Category $category, Section $section, DeleteSection $request)
    {
        if($section->delete())
        {
            return response('',204);
        } else {
            return response('',400);
        }
    }
}
