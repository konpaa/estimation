<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StatisticRequest;
use App\Services\StatisticService;

class StatisticController extends Controller
{
    public function index(StatisticRequest $request, StatisticService $statisticService)
    {
        return $statisticService->getResponse($request->getDto());
    }
}
