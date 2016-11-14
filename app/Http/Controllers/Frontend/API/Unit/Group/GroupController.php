<?php

namespace Phoenix\Http\Controllers\Frontend\API\Unit\Group;

use Illuminate\Http\Request;
use Phoenix\Http\Controllers\Controller;
use Phoenix\Http\Requests\Unit\Group\CreateGroup;
use Phoenix\Http\Requests\Unit\Group\UpdateGroup;
use Phoenix\Models\Unit\Group\Group;

class GroupController extends Controller
{
    /**
     * Get all Groups
     *
     * Returns all groups
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $groups = Group::all();
        return response()->json($groups->toArray());
    }

    /**
     * Create a Group
     *
     * Create a group based on the input
     *
     * @param CreateGroup $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateGroup $request)
    {
        $group = Group::create($request->all());
        return response()->json($group->toArray());
    }

    /**
     * Get a Group
     *
     * Retrieves a group and returns it
     *
     * @param Group $group
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Group $group)
    {
        return response()->json($group->toArray());
    }

    /**
     * Update a Group
     *
     * Updates a group based on input
     *
     * @param Group $group
     * @param UpdateGroup $request
     * @return bool
     */
    public function update(Group $group, UpdateGroup $request)
    {
        if($group->update($request->all()))
        {
            return response('',200);
        } else {
            return response('',400);
        }
    }

    /**
     * Delete a Group
     *
     * Deletes a Group based on ID
     *
     * @param Group $group
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(Group $group)
    {
        if($group->delete())
        {
            return response('',204);
        } else {
            return response('',400);
        }
    }
}
