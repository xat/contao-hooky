# Hooky: triggering contao callbacks like a boss!

The way you are used to trigger callbacks in contao:

```php
if (isset($GLOBALS['TL_HOOKS']['whatever']) && is_array($GLOBALS['TL_HOOKS']['whatever']))
{
  foreach ($GLOBALS['TL_HOOKS']['whatever'] as $callback)
  {
    $this->import($callback[0]);
    $this->$callback[0]->$callback[1]($foo, $bar);
  }
}
```

Doing the same with Hooky:

```php
\Hooky::trigger('whatever', $foo, $bar);
```

## License
Copyright (c) 2013 Simon Kusterer
Licensed under the LGPL license.