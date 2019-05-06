<?php

require '../src/EditorPHP.php';
require '../src/EditorPHP/Renderer.php';
require '../src/EditorPHP/Block.php';
require '../src/EditorPHP/Block/Header.php';
require '../src/EditorPHP/Block/Paragraph.php';
require '../src/EditorPHP/Block/List.php';

class Fooler extends \nhujanen\EditorPHP\Block
{
    public function generate(array $data = []): \DOMElement
    {
        return $this->document->createElement('strong', 'FOO FAA SNG');
    }
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

use nhujanen\EditorPHP;

$editor = new EditorPHP('test.html', 'editor-me', true);

$editor->registerRenderer('foo', Fooler::class);

echo $editor->render([
    'time'      => 1550476186479,
    'version'   => '1.8.2',
    'blocks'    => [
        [
            'type' => 'header',
            'data' => [
                'text' => 'Testing header',
                'level' => 2,
            ],
        ],
        [
            'type' => 'paragraph',
            'data' => [
                'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis cursus ultricies pellentesque. Nam at lorem tincidunt ex hendrerit euismod id sed elit. Etiam lorem nunc, suscipit eu aliquam sed, gravida tincidunt arcu. Maecenas vulputate pretium facilisis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
            ],
        ],
        [
            'type' => 'list',
            'data' => [
                'style' => 'ordered',
                'items' => [
                    'First list item',
                    'Second list item',
                    'Last list item',
                ],
            ],
        ],
        [
            'type' => 'foo',
            'data' => [],
        ]
    ]
]);