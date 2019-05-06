# EditorPHP

PHP renderer for EditorJS

# Requirements

PHP 7.x

# Usage

```php
require_once 'vendor/autoload.php';

$editor = new EditorPHP('test.html', 'editor-me', true);

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
    ],
]);
```

# Register custom renderers
```php
require_once 'vendor/autoload.php';

class Fooler extends Block
{
    public function generate(array $data = []): \DOMElement
    {
        return $this->document->createElement('strong', 'FOO FAA SNG');
    }
}

$editor = new EditorPHP('test.html', 'editor-me', true);
$editor->registerRenderer('foo', Fooler::class);

echo $editor->render([
    'time'      => 1550476186479,
    'version'   => '1.8.2',
    'blocks'    => [
        [
            'type' => 'foo',
            'data' => [],
        ],
    ],
]);
```

# License
MIT