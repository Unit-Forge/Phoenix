<?php

namespace Phoenix\Http\Controllers\Frontend\API\Unit\Documentation;

use Illuminate\Http\Request;
use Phoenix\Http\Controllers\Controller;
use Phoenix\Http\Requests\Unit\Documentation\Page\CreatePage;
use Phoenix\Http\Requests\Unit\Documentation\Page\DeletePage;
use Phoenix\Http\Requests\Unit\Documentation\Page\UpdatePage;
use Phoenix\Models\Unit\Documentation\Category;
use Phoenix\Models\Unit\Documentation\Page;
use Phoenix\Models\Unit\Documentation\Section;

/**
 * Class PageController
 * @package Phoenix\Http\Controllers\Frontend\API\Unit\Documentation
 */
class PageController extends Controller
{
    /**
     * Get all Pages
     *
     * Returns all categories
     *
     * @param Category $category
     * @param Section $section
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Category $category, Section $section)
    {
        return response()->json($section->pages->toArray());
    }

    /**
     * Create a Page
     *
     * Create a page based on the input
     *
     * @param Section $section
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Category $category, Section $section, CreatePage $request)
    {
        $page = $section->pages()->create($request->all());
        return response()->json($page->toArray());
    }

    /**
     * Get a Page
     *
     * Retrieves page and returns it
     *
     * @param Category $category
     * @param Section $section
     * @param Page $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Category $category, Section $section, Page $page)
    {
        return response()->json($page->toArray());
    }

    /**
     * Update a Page
     *
     * Updates a page based on input
     *
     * @param Category $category
     * @param Section $section
     * @param Page $page
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Category $category, Section $section, Page $page, UpdatePage $request)
    {
        if($page->update($request->all()))
        {
            return response('',200);
        } else {
            return response('',400);
        }
    }

    /**
     * Delete a Page
     *
     * Deletes a page based on ID
     *
     * @param Category $category
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(Category $category, Section $section, Page $page)
    {
        if($page->delete())
        {
            return response('',204);
        } else {
            return response('',400);
        }
    }
}
