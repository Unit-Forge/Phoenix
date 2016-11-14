<?php

namespace Phoenix\Http\Controllers\Frontend\API\Unit;

use Illuminate\Http\Request;
use Phoenix\Http\Controllers\Controller;
use Phoenix\Http\Requests\Unit\Rank\CreateRank;
use Phoenix\Http\Requests\Unit\Rank\DeleteRank;
use Phoenix\Http\Requests\Unit\Rank\UpdateRank;
use Phoenix\Models\Unit\Rank;

class RankController extends Controller
{
    /**
     * Get all Ranks
     *
     * Returns all ranks
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $ranks = Rank::all();
        return response()->json($ranks->toArray());
    }

    /**
     * Create a Rank
     *
     * Create a rank based on the input
     *
     * @param CreateRank $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateRank $request)
    {
        $ranks = Rank::create($request->all());
        return response()->json($ranks->toArray());
    }

    /**
     * Get a Rank
     *
     * Retrieves a rank and returns it
     *
     * @param Rank $ranks
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Rank $ranks)
    {
        return response()->json($ranks->toArray());
    }

    /**
     * Update a Rank
     *
     * Updates a rank based on input
     *
     * @param Rank $ranks
     * @param UpdateRank $request
     * @return bool
     */
    public function update(Rank $ranks, UpdateRank $request)
    {
        if($ranks->update($request->all()))
        {
            return response('',200);
        } else {
            return response('',400);
        }
    }

    /**
     * Delete a Rank
     *
     * Deletes a Rank based on ID
     *
     * @param Rank $ranks
     * @param DeleteRank $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(Rank $ranks, DeleteRank $request)
    {
        if($ranks->delete())
        {
            return response('',204);
        } else {
            return response('',400);
        }
    }
}
