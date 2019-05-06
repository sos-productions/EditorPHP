<?php

namespace nhujanen\EditorPHP\Block;

use nhujanen\EditorPHP\Block;

class HeaderBlock extends Block
{
    public function generate(array $data = []): \DOMElement
    {
        $level = max(min($data['level'] ?? 1, 6), 1);

        return $this->document->createElement("h{$level}", $data['text']);
    }
}