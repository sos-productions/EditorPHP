<?php

namespace nhujanen\EditorPHP\Block;

use nhujanen\EditorPHP\Block;

class CodeBlock extends Block
{
    public function generate(array $data = []): \DOMElement
    {
        return $this->document->createElement("code", htmlspecialchars(str_replace('\n', "\n", $data['code'] ?? '')));
    }
}