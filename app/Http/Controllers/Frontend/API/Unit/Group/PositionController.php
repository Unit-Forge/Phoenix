<?php

namespace Phoenix\Http\Controllers\Frontend\API\Unit\Group;

use Illuminate\Http\Request;
use Phoenix\Http\Controllers\Controller;
use Phoenix\Http\Requests\Unit\Group\Position\CreatePosition;
use Phoenix\Http\Requests\Unit\Group\Position\DeletePosition;
use Phoenix\Http\Requests\Unit\Group\Position\UpdatePosition;
use Phoenix\Models\Unit\Group\Group;
use Phoenix\Models\Unit\Group\Position;

/**
 * Class PositionController
 * @package Phoenix\Http\Controllers\Frontend\API\Unit\Group
 */
class PositionController extends Controller
{

    /**
     * Get all Positions from Group
     *
     * Returns all positions from a specific group
     *
     * @param Group $group
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Group $group)
    {
        return response()->json($group->positions->toArray());
    }

    /**
     * Create a Section
     *
     * Create a section based on the input
     *
     * @param Group $group
     * @param CreatePosition $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Group $group, CreatePosition $request)
    {
        $position = $group->positions()->create($request->all());
        return response()->json($position->toArray());
    }


    /**
     * Get a Position
     *
     * Retrieves position and returns it
     *
     * @param Group $group
     * @param Position $position
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Group $group, Position $position)
    {
        return response()->json($position->toArray());
    }

    /**
     * Update a Group
     *
     * Updates a group based on input
     *
     * @param Group $group
     * @param UpdatePosition $request
     * @return bool
     */
    public function update(Group $group, Position $position, UpdatePosition $request)
    {
        if($position->update($request->all()))
        {
            return response('',200);
        } else {
            return response('',400);
        }
    }

    /**
     * Delete a Position
     *
     * Deletes a position based on ID
     *
     * @param Group $group
     * @param Position $position
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(Group $group, Position $position, DeletePosition $request)
    {
        if($position->delete())
        {
            return response('',204);
        } else {
            return response('',400);
        }
    }

}
