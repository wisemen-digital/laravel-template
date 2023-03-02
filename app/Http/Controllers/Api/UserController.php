<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me()
    {
        $user = auth()->user();

        return fractal()->item($user, new UserTransformer());
    }

    public function index(Request $request)
    {
        $query = User::query()
            ->with([]);

        if ($request->has('role')) {
            $query->where('role', $request->role);
        }

        return fractal()->collection($query->paginate($request->get('per_page', 50)), new UserTransformer());
    }

    public function show(User $user)
    {
        $user->load([]);

        return fractal()->item($user, new UserTransformer())
            ->parseIncludes([]);
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create($request->validated());

        return $this->show($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return $this->show($user->fresh());
    }
}
