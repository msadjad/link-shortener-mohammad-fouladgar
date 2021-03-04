<?php

namespace App\Support;

// you can use a interface for this.
class Hasher
{
    protected $length = 5; // we can get this from config
    protected $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-_';

    public function setLength(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function generate(): string
    {
        return substr(str_shuffle($this->characters), 0, $this->length);
    }
}
