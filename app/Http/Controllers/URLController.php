<?php

namespace App\Http\Controllers;

use App\Http\Requests\URLRequest;
use App\Services\URLService;
use App\Http\Resources\Link as LinkResource;

class UrlController extends Controller
{
    /**
     * @var URLService
     */
    protected $URLService;

    public function __construct(URLService $URLService)
    {
        $this->URLService = $URLService;
    }

    public function store(URLRequest $request)
    {
        $link = $this->URLService->create($request->url);

        return new LinkResource($link);
    }
}
