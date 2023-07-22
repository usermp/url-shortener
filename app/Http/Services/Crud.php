<?php

namespace App\Http\Constants;

use App\Http\Services\Response;
use Illuminate\Http\JsonResponse;

class Crud
{
    public static function index($model, $customSetting = null): JsonResponse
    {
        $resource = func_num_args() > 1 ? $customSetting : $model::all();
        return Response::success(Constants::SUCCESS,$resource);
    }

    public static function store(array $fields, $model): JsonResponse
    {
        try {

            $response = $model::create($fields);
            return Response::success(Constants::SUCCESS, $response);

        } catch (\Exception $exception) {
            return Response::error($exception->getMessage());
        }
    }

    public static function show($model, $customSetting = null): JsonResponse
    {
        try {
            $resource = func_num_args() > 1 ? $customSetting : $model;
            return Response::success(Constants::SUCCESS, $resource);
        } catch (\Exception $exception) {
            return Response::error($exception->getMessage());
        }
    }

    public static function update(array $fields, $model): JsonResponse
    {
        try {
            $model->update($fields);
            return Response::success(Constants::SUCCESS_UPDATE, $model);
        } catch (\Exception $exception) {
            return Response::error($exception->getMessage());
        }
    }

    public static function destroy($model): JsonResponse
    {
        try {
            $model->delete();
            return Response::success(Constants::SUCCESS_DELETE, $model);
        } catch (\Exception $exception) {
            return Response::error($exception->getMessage());
        }
    }
}
