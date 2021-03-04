<?php

namespace App\Http\Controllers;

use App\Http\Requests\URLRequest;
use App\Services\URLService;
use App\Http\Resources\Link as LinkResource;
use Illuminate\Http\Request;

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

    public function redirectToLink(Request $request, $code)
    {
        $link = $this->URLService->findCode($code);
        try {
            throw_if(! $link, \Exception::class, 'Not found link');
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }

        return new LinkResource($link);
    }
}
