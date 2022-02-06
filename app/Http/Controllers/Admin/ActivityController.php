<?php

namespace App\Http\Controllers\Admin;

use App\Facades\JRpcClient;
use App\Http\Controllers\Controller;
use Datto\JsonRpc\Http\Exceptions\HttpException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class ActivityController extends Controller
{
    /**
     * @throws HttpException
     * @throws \ErrorException
     */
    public function index(Request $request): Factory|View|Application
    {
        $activities = [];
        JRpcClient::client()
            ->query(
                'getImpressions',
                [
                    'per_page' => $request->input('per_page') ?? 1,
                    'page' => $request->input('page') ?? 1],
                $activities
            )
            ->send();

        return view('activity', compact('activities'));

    }

}
