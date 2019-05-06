<?php

namespace nhujanen\EditorPHP;
 
class Renderer
{
    protected   $container;
    protected   $template;

    protected   $renderers;

    public function __construct(string $filename, string $container)
    {
        $this->renderers = [
            'header'        => \nhujanen\EditorPHP\Block\HeaderBlock::class,
            'paragraph'     => \nhujanen\EditorPHP\Block\ParagraphBlock::class,
            'list'          => \nhujanen\EditorPHP\Block\ListBlock::class,
            'image'         => \nhujanen\EditorPHP\Block\ImageBlock::class,
            'code'          => \nhujanen\EditorPHP\Block\CodeBlock::class,
            'table'         => \nhujanen\EditorPHP\Block\TableBlock::class,
        ];

        if (!file_exists($filename))
            throw new \UnexpectedValueException("Template '{$filename}' not found.");

        $this->template     = new \DOMDocument();
        $this->container    = $container;

        $this->template->loadHTMLFile($filename);
    }

    public function registerRenderer($name, $class): void
    {
        $this->renderers[$name] = $class;
    }

    public function getBlock($blockName): Block
    {
        if (!array_key_exists($blockName, $this->renderers))
            throw new \InvalidArgumentException("Unknown renderer: '{$blockName}'");

        return new $this->renderers[$blockName]($this->template);
    }

    public function add(Block $block, array $data = []): Renderer
    {
        $node = $this->template->getElementById($this->container);

        $node->appendChild( $block->generate($data) );

        return $this;
    }

    public function clear(): Renderer
    {
        $parent = $this->template->getElementById($this->container);

        while ($element = $parent->childNodes->item(0)) {
            $parent->removeChild($element);
        }

        return $this;
    }

    public function render(): string
    {
        return $this->template->saveHTML();
    }
}