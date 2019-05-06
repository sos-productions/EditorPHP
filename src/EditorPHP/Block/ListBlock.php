<?php

namespace nhujanen\EditorPHP\Block;

use nhujanen\EditorPHP\Block;

class ListBlock extends Block
{
    public function generate(array $data = []): \DOMElement
    {
        $listTag = (($data['style'] ?? 'unordered') === 'ordered') ? 'ol' : 'ul';

        $list = $this->document->createElement($listTag);

        foreach ($data['items'] as $item) {
            $list->appendChild( $this->document->createElement('li', $item) );
        }
        
        return $list;
    }
}