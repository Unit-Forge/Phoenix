<?php

namespace Phoenix\Http\Controllers\Frontend\API\Unit\File;

use Illuminate\Http\Request;
use Phoenix\Http\Controllers\Controller;
use Phoenix\Http\Requests\Unit\File\Award\CreateAward;
use Phoenix\Http\Requests\Unit\File\Award\DeleteAward;
use Phoenix\Http\Requests\Unit\File\Award\UpdateAward;
use Phoenix\Models\Unit\File\Award;

class AwardController extends Controller
{
    /**
     * Get all Awards
     *
     * Returns all awards
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $award = Award::all();
        return response()->json($award->toArray());
    }

    /**
     * Create a Award
     *
     * Create a award based on the input
     *
     * @param CreateAward $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateAward $request)
    {
        $award = Award::create($request->all());
        return response()->json($award->toArray());
    }

    /**
     * Get a Award
     *
     * Retrieves a award and returns it
     *
     * @param Award $award
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Award $award)
    {
        return response()->json($award->toArray());
    }

    /**
     * Update a Award
     *
     * Updates a award based on input
     *
     * @param Award $award
     * @param UpdateAward $request
     * @return bool
     */
    public function update(Award $award, UpdateAward $request)
    {
        if($award->update($request->all()))
        {
            return response('',200);
        } else {
            return response('',400);
        }
    }

    /**
     * Delete a Award
     *
     * Deletes a Award based on ID
     *
     * @param Award $award
     * @param DeleteAward $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(Award $award, DeleteAward $request)
    {
        if($award->delete())
        {
            return response('',204);
        } else {
            return response('',400);
        }
    }
}
