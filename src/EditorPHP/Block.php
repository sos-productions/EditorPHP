<?php

namespace nhujanen\EditorPHP;

abstract class Block
{
    protected $document;

    public function __construct(\DOMDocument $document)
    {
        $this->document = $document;
    }

    abstract public function generate(array $data = []): \DOMElement;
}