<?php

namespace nhujanen;

use nhujanen\EditorPHP\Configuration;
use nhujanen\EditorPHP\Renderer;
use nhujanen\EditorPHP\Block;

class EditorPHP
{
    protected   $renderer   = null;
    protected   $strict;

    public function __construct(string $filename, string $container, bool $strict = true)
    {
        $this->strict   = $strict;
        $this->renderer = new Renderer($filename, $container);
    }

    public function render(array $data = []): string
    {
        $this->renderer->clear();

        foreach ($data['blocks'] ?? [] as $blockData) {
            try {
                $block = $this->renderer->getBlock($blockData['type']);
                $this->renderer->add($block, $blockData['data']);
            } catch (\Exception $e) {
                if ($this->strict) 
                    throw $e;
            }
        }

        return $this->renderer->render();
    }

    public function registerRenderer($name, $class): void
    {
        try {
            $this->renderer->registerRenderer($name, $class);
        } catch (\Exception $e) {
            if ($this->strict)
                throw $e;
        }
    }
}