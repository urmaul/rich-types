# rich-types

Yet another rich types library. Designed to use fluent interaces with base PHP types.

No comments, <del>no tests,</del> no release planned. Use it only if you are me.

While major version is 0 minor version change means backwards incompatible changes.

## Example

```php
use rich\collections\Strings;

$words = Strings::split(' ', $text)->lower()->unique()->values();
```

## Supported types

### Collections

#### Variables

Base collection class. Can be passed to `foreach` and `count()`.

* **static from($array)** - creates new collection instance.
* **map($callback)** - performs `array_map` to each item in collection.
* **mapKeys($callback)**  - performs `array_map` to each item key in collection.
* **filter($callback = null)** - performs `array_filter` to each item in collection.
* **unique()** - performs `array_unique` to collection.
* **merge($array)** - merges another array to collection.
* **find($callback)** - finds an item by callback function. Returns it's value.
* **reduce($callback, $initial = null)** - performs `array_reduce` to collection. Returns resulting value.
* **count()** - returns items count.
* **value()** - returns collection items as array.
* **values()** - returns collection items as array and indexes the array numerically.
* **asVariables()** - converts collection to `Variables`. Can be used to clone collection.
* **asNumbers()** - converts collection to `Numbers`. Can be used to clone collection.
* **asStrings()** - converts collection to `Strings`. Can be used to clone collection.
* **asObjects()** - converts collection to `Objects`. Can be used to clone collection.

#### Strings

* **static split($delimiter, $string)** - creates new collection instance by splitting text like `explode` does.
* **static splitList($string)** - creates new collection instance by splitting text wtih comma-separated values.
* **lower()** - makes every string in collection lowercase.
* **trim()** - performs `trim` to each item in collection.
* **replace($search, $replace)** - performs `str_replace` to each item in collection.

#### Numbers

* **sum()** - returns collection items sum.

#### Objects

* **property($property)** - cleates new collection with items picked from objects property.
