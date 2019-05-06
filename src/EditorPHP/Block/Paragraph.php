<?php

namespace nhujanen\EditorPHP\Block;

use nhujanen\EditorPHP\Block;

class ParagraphBlock extends Block
{
    public function generate(array $data = []): \DOMElement
    {
        return $this->document->createElement("p", $data['text']);
    }
}