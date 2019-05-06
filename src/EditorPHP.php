<?php

namespace nhujanen;

use nhujanen\EditorPHP\Configuration;
use nhujanen\EditorPHP\Renderer;
use nhujanen\EditorPHP\Block;

class EditorPHP
{
    protected   $filename;
    protected   $container;
    protected   $renderer;
    protected   $strict;

    protected   $cache      = null;
    protected   $ttl;

    public function __construct(string $filename, string $container, bool $strict = true)
    {
        $this->filename     = $filename;
        $this->container    = $container;
        $this->strict       = $strict;
        $this->renderer     = new Renderer($filename, $container);
    }

    public function setCache(\Psr\SimpleCache\CacheInterface $cache, int $ttl = 60): void
    {
        $this->cache    = $cache;
        $this->ttl      = $ttl;
    }

    public function render(array $data = []): string
    {
        if (null !== $this->cache) {
            $cacheHash = sha1(implode('/', [
                $this->filename,
                filemtime($this->filename),
                $this->container,
                serialize($data)
            ]));

            if ($this->cache->has($cacheHash)) {
                return $this->cache->get($cacheHash);
            }
        }

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

        $html = $this->renderer->render();

        if (null !== $this->cache) {
            $this->cache->set($cacheHash, $html, $this->ttl);
        }

        return $html;
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