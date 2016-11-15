<?php

namespace Phoenix\Http\Controllers\Frontend\API\Unit\File;

use Illuminate\Http\Request;
use Phoenix\Http\Controllers\Controller;
use Phoenix\Http\Requests\Unit\File\CreateFile;
use Phoenix\Http\Requests\Unit\File\DeleteFile;
use Phoenix\Http\Requests\Unit\File\UpdateFile;
use Phoenix\Models\Unit\File\File;
use Phoenix\Models\User;

class FileController extends Controller
{
    /**
     * Get all Files
     *
     * Returns all files
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $file = File::all();
        return response()->json($file->toArray());
    }

    /**
     * Create a File
     *
     * Create a file based on the input
     *
     * @param CreateFile $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateFile $request)
    {
        // We need to look up the user
        $user = User::where('uuid', $request->user_uuid)->firstOrFail();

        $file = $user->file()->create($request->except('user_uuid'));
        return response()->json($file->toArray());
    }

    /**
     * Get a File
     *
     * Retrieves a file and returns it
     *
     * @param File $file
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(File $file)
    {
        return response()->json($file->toArray());
    }

    /**
     * Update a File
     *
     * Updates a File based on input
     *
     * @param File $file
     * @param UpdateFile $request
     * @return bool
     */
    public function update(File $file, UpdateFile $request)
    {
        if($file->update($request->all()))
        {
            return response('',200);
        } else {
            return response('',400);
        }
    }

    /**
     * Delete a File
     *
     * Deletes a File based on ID
     *
     * @param File $file
     * @param DeleteFile $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(File $file, DeleteFile $request)
    {
        if($file->delete())
        {
            return response('',204);
        } else {
            return response('',400);
        }
    }
}
