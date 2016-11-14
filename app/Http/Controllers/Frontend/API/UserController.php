<?php

namespace Phoenix\Http\Controllers\Frontend\API;

use Illuminate\Http\Request;
use Phoenix\Http\Controllers\Controller;
use Phoenix\Models\User;


/**
 * Class UserController
 * @package Phoenix\Http\Controllers\Frontend\API
 * @hideFromAPIDocumentation
 */
class UserController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json($user->toArray());

    }
}
