<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexNewsRequest;
use App\Http\Requests\UpdateNewsStatusRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Repositories\NewsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class NewsController extends Controller
{
    public function __construct(private readonly NewsRepository $newsRepository)
    {
    }

    public function index(IndexNewsRequest $request): JsonResponse
    {
        $params = $request->all();
        $newsQuery = $this->newsRepository->getNewsItemsOverview($params);
        $newsCount = $this->newsRepository->getFilteredModelCount();

        return response()->json([
            'news' => NewsResource::collection($newsQuery->get()),
            'newsCount' => $newsCount,
        ], Response::HTTP_OK);
    }

    public function show(News $news): JsonResponse
    {
        return response()->json([
            'news' => NewsResource::make($news)->withDescription()
        ], Response::HTTP_OK);
    }

    public function updateStatus(UpdateNewsStatusRequest $request): JsonResponse
    {
        $this->newsRepository->updateStatus($request->get('id'), $request->get('status'));

        return response()->json([], Response::HTTP_OK);
    }
}
