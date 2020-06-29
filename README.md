## About
I am currently developing StockSoftware exclusively for learning purposes.
StockSoftware is a warehouse manager for medium-sized and large warehouses.

## Ide-Helper
You can generate PHP Documentation to avoid Ide warnings on magic calls:
```php
    // Example
    $model = Model::findOrFail($id);
```
Without the Ide helper, there would be a warning on ***findOrFail***.

***Ide-Helper*** Commands:
- [`php artisan ide-helper:generate`]
- [`php artisan ide-helper:models`]
- [`php artisan ide-helper:meta`]
