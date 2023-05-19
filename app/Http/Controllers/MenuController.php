<?php

namespace App\Http\Controllers;

use App\Contracts\MenuRepositoryContract;
use App\Http\Requests\MenuRequest;
use App\Http\Resources\MenuResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    private MenuRepositoryContract $menuRepository;

    public function __construct(MenuRepositoryContract $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return MenuResource::collection($this->menuRepository->index(Auth::id()));
    }

    public function store(MenuRequest $request): MenuResource
    {
        $menuRequest = array_merge($request->validated(), ['user_id' => Auth::id()]);

        return new MenuResource($this->menuRepository->store($menuRequest));
    }

    public function show(string $slug): MenuResource
    {
        return new MenuResource($this->menuRepository->find($slug));
    }

    public function update(MenuRequest $request, string $id): Response
    {
        $this->menuRepository->update($id, $request->validated());

        return response()->noContent();
    }

    public function destroy(string $id): Response
    {
        $this->menuRepository->destroy($id);

        return response()->noContent();
    }
}
