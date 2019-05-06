<?php

namespace nhujanen\EditorPHP\Block;

use nhujanen\EditorPHP\Block;

class TableBlock extends Block
{
    public function generate(array $data = []): \DOMElement
    {
        $table = $this->document->createElement('table');

        foreach ($data['content'] ?? [] as $row) {
            $tr = $this->document->createElement('tr');
            foreach ($row ?? [] as $cell) {
                $td = $this->document->createElement('td', $cell);
                $tr->appendChild($td);
            }
            $table->appendChild($tr);
        }

        return $table;
    }
}