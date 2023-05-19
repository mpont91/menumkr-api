<?php

namespace App\Http\Controllers;

use App\Contracts\MenuRepositoryContract;
use App\Http\Resources\MenuResource;
use Illuminate\Http\Request;
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

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return MenuResource::collection($this->menuRepository->index(Auth::id()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug): MenuResource
    {
        return new MenuResource($this->menuRepository->find($slug));
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
    public function destroy(string $id): Response
    {
        $this->menuRepository->destroy($id);
        return response()->noContent();
    }
}
