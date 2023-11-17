<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\FormRequestUser;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = $this->userService->getAll((int) $request->get('per_page', 15), $request);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormRequestUser $request)
    {
        $user = $this->userService->createNewUser($request->all());

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        if (!$user = $this->userService->show($uuid)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore(string $id)
    {
        //
    }
}
