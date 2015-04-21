# rich-types

Yet another rich types library. Designed to use fluent interaces with base PHP types.

<del>No</del> Not enough comments, <del>no tests,</del> no release planned. Use it only if you are <del>me</del> brave enough.

While major version is 0 minor version change means backwards incompatible changes.

[![Build Status](https://travis-ci.org/urmaul/rich-types.svg)](https://travis-ci.org/urmaul/rich-types)

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

#### Arrays

* **column($columnKey, $indexKey = null)** - returns the values from a single column of the array, identified by the column_key. Optionally, you may provide an index_key to index the values in the returned array by the values from the index_key column in the input array.
    Performs `[array_column](http://php.net/manual/en/function.array-column.php)` to collection. If php version is lower than 5.5, [ramsey/array_column](https://github.com/ramsey/array_column) is used.
