# FilterInput
FilterInput is a small extension of filter_input function with predefined filters and support to compare values, length , range and much more.

## Simple usage
>Simple usage to validate if a "string" received from a "input" , is strictly alphanumeric using regex!

```php
$filter_regexp = FilterInput::regexp("post" , "input_regexp");

if ($filter_regexp->isValid()){
    echo "valid";
}
else{
    echo "not valid";
}
```
> to retrieve the value received use `->inputValue`

```php
$filter_regexp->inputValue
```

## Predefined Filters

| Filter  | Validate |
| ------------- | ------------- |
| `FilterInput::regexp()`  | string, text, passwords  |
| `FilterInput::int()`  | numbers |
| `FilterInput::bool()`  | True or False  |
| `FilterInput::url()`  | urls  |
| `FilterInput::custom()`  | add you custom filter, [Avaible Filters](http://php.net/manual/en/filter.filters.validate.php). |
| `FilterInput::keyExist()`  | Check if a key exist. It’s most used to verify if a button has been clicked  |

#Options/ExtraOptions/Flags
All predefined filters can be configured with options, flags and extra-options.
This will save you to write a lot of code (comparing values, lenght, ranges , and so one)

##New Option
Before applying or change an option, you need to check the existing options for each filter at [php.net](http://php.net/manual/en/filter.filters.validate.php)

>how to change the option of a filter?

```php
$filter_regexp->options(Array("regexp" => "/^[a-zA-Z0-9_]+$/"));
```
## Compare value(s)
>To compare a single value.

```php
$filter_regexp->options(Array("regexp" => "/^[a-zA-Z0-9_]+$/"));
```
>For multiples values use an array of strings.

```php
$filter_regexp->extraOptions(Array(
    "val_compare" => Array("demo","demo2","demo3")
));
```
## Set a new Flag

```php
$filter_regexp->flags("FILTER_NULL_ON_FAILURE");
```

