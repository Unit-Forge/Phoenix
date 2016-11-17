<?php

namespace Phoenix\Http\Controllers\Frontend\API\User;

use Illuminate\Http\Request;
use Phoenix\Http\Controllers\Controller;
use Phoenix\Http\Requests\User\Teamspeak\AddTeamspeakToFile;
use Phoenix\Http\Requests\User\Teamspeak\RemoveTeamspeakToFile;
use Phoenix\Models\User;
use Phoenix\Models\User\Teamspeak;

/**
 * Class TeamspeakController
 * @package Phoenix\Http\Controllers\Frontend\API\User
 */
class TeamspeakController extends Controller
{
    /**
     * Creates a Teamspeak to a User
     *
     * @param AddTeamspeakToFile $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(AddTeamspeakToFile $request)
    {
        $user = User::where('uuid', $request->user_uuid)->firstOrFail();
        $teamspeak = $user->teamspeak()->create($request->all());
        return response()->json($teamspeak->toArray());
    }

    /**
     * Delete a Teamspeak from User
     *
     * @param Teamspeak $teamspeak
     * @param RemoveTeamspeakToFile $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(Teamspeak $teamspeak, RemoveTeamspeakToFile $request)
    {
        if($teamspeak->delete())
        {
            return response('',204);
        } else {
            return response('',400);
        }
    }

}
