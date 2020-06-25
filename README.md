## Ide-Helper
You can generate PHP Documentation to avoid PhpStorm warnings on magic calls:
```php
    $model = Model::findOrFail($id);
```
Just do:
- [`php artisan ide-helper:generate`]
- [`php artisan ide-helper:models`]
- [`php artisan ide-helper:meta`]
