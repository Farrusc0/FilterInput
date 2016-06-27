<?php include "header.php"; ?>

<!-- -->

<section id="getting-started">
    <h1>Getting Started</h1>
    <p>FilterInput is a small extension of filter_input function with predefined filters and support to compare values, length , range and much more.</p>
    <p>See filter_input explanation on <a target="_blank" href="http://php.net/manual/en/function.filter-input.php"> php.net </a>.</p>

    <?php ?>

    <h3>Include FilterInput</h3>
    <p>
        Include FilterInput on the very top of your page.
    </p>
    <div class="self-code"><?prettify lang=php?>
        <pre>
<code>include "path/FilterInput.php"</code>
        </pre>
    </div>

    <?php ?>

    <h3>Simple usage</h3>
    <p>Simple usage to validate if a "string" received from a "input" , is strictly alphanumeric using regex!</p>
    <div class="self-code"><?prettify lang=php?>
        <pre>
<code>$filter_regexp = FilterInput::regexp("post" , "input_regexp");

if ($filter_regexp->isValid()){
    echo "valid";
}
else{
    echo "not valid";
}</code>
        </pre>
    </div>
    <p>to filter values from GET, only change the 1º parameter to "get"</p>
    <div class="self-code"><?prettify lang=php?>
        <pre>
<code>$filter_regexp = FilterInput::regexp("get" , "input_regexp");</code>
        </pre>
    </div>
    <p>to retrieve the value received use <code>->inputValue</code></p>
    <div class="self-code"><?prettify lang=php?>
        <pre>
<code>$filter_regexp->inputValue</code>
        </pre>
    </div>
    <div class="bs-callout bs-callout-danger" id="callout-overview-not-both"> 
        <h4>Important</h4> 
        <p>Always validate the input before use <code>->inputValue</code> otherwise FilterInput will return <code>FALSE</code></p>
    </div>

    <?php ?>

    <h3>Predefined Filters</h3>
    <p>There are 6 predefined filters</p>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Filter</th>
                <th>Validate</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <code>FilterInput::regexp();</code>
                </td>
                <td>
                    string, text, passwords
                </td>
            </tr>
            <tr>
                <td>
                    <code>FilterInput::int();</code>
                </td>
                <td>
                    numbers
                </td>
            </tr>
            <tr>
                <td>
                    <code>FilterInput::bool();</code>
                </td>
                <td>
                    True or False
                </td>
            </tr>
            <tr>
                <td>
                    <code>FilterInput::url();</code>
                </td>
                <td>
                    urls
                </td>
            </tr>
            <tr>
                <td>
                    <code>FilterInput::custom();</code>
                </td>
                <td>
                    add you custom filter, avaible <a target="_blank" href="http://php.net/manual/en/filter.filters.validate.php"> FILTERS </a>

                </td>
            </tr>
            <tr>
                <td>
                    <code>FilterInput::keyExist();</code>
                </td>
                <td>
                    Check if a key exist. It’s most used to verify if a button has been clicked
                </td>
            </tr>
        </tbody>
    </table>

    <?php ?>

    <h1>Options/ExtraOptions/Flags</h1>
    <p>All predefined filters can be configured with options, flags and extra-options.</p>
    <p>This will save you to write a lot of code (comparing values, lenght, ranges , and so one)</p>

    <?php ?>

    <h3>New Option</h3>
    <p>Before applying or change an option, you need to check the existing options for each filter at <a target="_blank" href="http://php.net/manual/en/filter.filters.validate.php"> php.net </a>
    <p>how to change the option of a filter?</p>
    <div class="self-code"><?prettify lang=php?>
        <pre>
<code>$filter_regexp->options(Array("regexp" => "/^[a-zA-Z0-9_]+$/"));</code>
        </pre>
    </div>

    <?php ?>

    <h3>Compare value(s)</h3>
    <p>To compare a single value.</p>
    <div class="self-code"><?prettify lang=php?>
        <pre>
<code>$filter_regexp->extraOptions(Array(
    "val_compare" => "demo"
));</code>
        </pre>
    </div>
    <p>For multiples values use an array of strings.</p>
    <div class="self-code"><?prettify lang=php?>
        <pre>
<code>$filter_regexp->extraOptions(Array(
    "val_compare" => Array("demo","demo2","demo3")
));</code>
        </pre>
    </div>

    <?php ?>

    <h3>Check Length</h3>
    <p>You can check the length of a value received from an input</p>
    <div class="self-code"><?prettify lang=php?>
        <pre>
<code>$filter_regexp->extraOptions(Array(
    "min_length" => 0 ,
    "max_length" => 20
));</code>
        </pre>
    </div>

    <?php ?>

    <h3>Set a new Flag</h3>
    <div class="self-code"><?prettify lang=php?>
        <pre>
<code>$filter_regexp->flags("FILTER_NULL_ON_FAILURE");</code>
        </pre>
    </div>

    <?php ?>

    <h1>filter_var</h1>
    <p>It is possible to filter vars using all resource of FilterInput class.</p> 
    <p>On this case you just need to parse the input value</p>
    <p>On this case use <code>FilterVar::</code> instead <code>FilterInput::</code> and parse the value</p>
    <div class="self-code"><?prettify lang=php?>
        <pre>
<code>$filter_var_regexp = FilterVar::regexp("Demo");</code>
        </pre>
    </div>
</section>


<?php include "footer.php"; ?>



