<?php

namespace App\Services;

use App\Link;
use App\Support\Hasher;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;

class URLService
{
    /**
     * @var Hasher
     */
    protected $hasher;
    /**
     * @var Link
     */
    protected $link;

    public function __construct(Hasher $hasher, Link $link)
    {
        $this->hasher = $hasher;
        $this->link = $link;
    }

    public function create(string $url)
    {
        $data = [
            'url' => $url,
            'code' => $this->hasher->generate(),
        ];

        return tap($this->link, function ($link) use ($data) {
            $link->url = $data['url'];
            $link->code = $data['code'];
            $link->save();
        });
    }

    public function findCode($code)
    {
        return $this->link->where('code', $code)->first();
    }
}
