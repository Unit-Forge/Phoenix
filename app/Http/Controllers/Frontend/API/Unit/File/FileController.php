<?php

namespace Phoenix\Http\Controllers\Frontend\API\Unit\File;

use Illuminate\Http\Request;
use Phoenix\Http\Controllers\Controller;
use Phoenix\Http\Requests\Unit\File\Award\AddAwardToFile;
use Phoenix\Http\Requests\Unit\File\Award\RemoveAwardToFile;
use Phoenix\Http\Requests\Unit\File\CreateFile;
use Phoenix\Http\Requests\Unit\File\DeleteFile;
use Phoenix\Http\Requests\Unit\File\ServiceHistory\AddServiceHistoryToFile;
use Phoenix\Http\Requests\Unit\File\ServiceHistory\RemoveServiceHistoryToFile;
use Phoenix\Http\Requests\Unit\File\UpdateFile;
use Phoenix\Models\Unit\File\Award;
use Phoenix\Models\Unit\File\File;
use Phoenix\Models\Unit\File\ServiceHistory;
use Phoenix\Models\User;

/**
 * Class FileController
 * @package Phoenix\Http\Controllers\Frontend\API\Unit\File
 */
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


    /**
     * Add an Award to a File
     *
     * @param File $file
     * @param Award $award
     * @param AddAwardToFile $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addAward(File $file, Award $award, AddAwardToFile $request)
    {
        $file->awards()->attach($award->id, ['reason' => $request->reason, 'date_awarded' => $request->date_awarded]);
        return response()->json(['message' => 'Award Added Successfully']);
    }


    /**
     * Remove an Award from a File
     *
     * @param File $file
     * @param Award $award
     * @param RemoveAwardToFile $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeAward(File $file, Award $award, RemoveAwardToFile $request)
    {
        $file->awards()->detach($award->id);
        return response()->json(['message' => 'Award Removed Successfully']);
    }

    /**
     * Adds Service History to a File
     *
     * @param File $file
     * @param AddServiceHistoryToFile $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addServiceHistory(File $file, AddServiceHistoryToFile $request)
    {
        $file->serviceHistory()->create($request->all());
        return response()->json(['message' => 'Service History added Successfully']);
    }

    /**
     * Remove Service History from a File
     *
     * @param File $file
     * @param ServiceHistory $serviceHistory
     * @param RemoveServiceHistoryToFile $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeServiceHistory(File $file, ServiceHistory $serviceHistory, RemoveServiceHistoryToFile $request)
    {
        if($serviceHistory->delete())
        {
            return response()->json(['message' => 'Service History deleted successfully']);
        } else {
            return response()->setStatusCode(500)->json(['message' => 'Unable to delete service history entree, try again later.']);
        }

    }


}
