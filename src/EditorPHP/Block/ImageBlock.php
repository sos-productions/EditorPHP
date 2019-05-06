<?php

namespace nhujanen\EditorPHP\Block;

use nhujanen\EditorPHP\Block;

class ImageBlock extends Block
{
    public function generate(array $data = []): \DOMElement
    {
        $element = $this->document->createElement('img');
        $element->setAttribute('src', $data['url'] ?? '');
        $element->setAttribute('alt', $data['caption'] ?? '');
        
        return $element;
    }
}