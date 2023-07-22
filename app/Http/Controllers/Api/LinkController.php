<?php

namespace App\Http\Controllers\Api;

use App\Http\Constants\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\Link;
use Illuminate\Http\JsonResponse;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Link $link
     * @return JsonResponse
     */
    public function index(Link $link): JsonResponse
    {
        return Crud::index($link);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreLinkRequest $request
     * @param Link $link
     * @return JsonResponse
     */
    public function store(StoreLinkRequest $request, Link $link): JsonResponse
    {
        return Crud::store($request->toArray(),$link);
    }

    /**
     * Display the specified resource.
     * @param Link $link
     * @return JsonResponse
     */
    public function show(Link $link): JsonResponse
    {
        return Crud::show($link);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateLinkRequest $request
     * @param Link $link
     * @return JsonResponse
     */
    public function update(UpdateLinkRequest $request, Link $link): JsonResponse
    {
        return Crud::update($request->toArray(),$link);
    }

    /**
     * Remove the specified resource from storage.
     * @param Link $link
     * @return JsonResponse
     */
    public function destroy(Link $link): JsonResponse
    {
        return Crud::destroy($link);
    }
}
