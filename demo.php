<?php include "header.php"; ?>
<?php
if (FilterInput::keyExist("post" , "submit")) {

    //=========================================================
    // FILTERS
    //=========================================================
    // Name Filter
    $name = FilterInput::regexp("post" , "name");
    $name->options(Array("regexp" => "/^[a-zA-Z]+$/"));
    $name->extraOptions(Array("min_length" => 4 , "max_length" => 15));

    // Age Filter
    $age = FilterInput::int("post" , "age");
    $age->options(Array("min_range" => 18 , "max_range" => 75));

    // E-Mail Filter
    $email = FilterInput::custom("post" , "email" , "FILTER_VALIDATE_EMAIL");

    // Site Filter
    $site = FilterInput::url("post" , "site");
    $site->flags("FILTER_FLAG_HOST_REQUIRED");

    // Security Bot Filter
    $securityBot = FilterInput::regexp("post" , "securityBot");
    $securityBot->extraOptions(Array("val_compare" => Array("Fanwik" , "chuavas")));

    // Radio Human Filter
    $radioHuman = FilterInput::bool("post" , "radioHuman");

    //=========================================================
    // VALIDATIONS
    //=========================================================

    if ($name->isValid() === FALSE) {
        Prints::msg("Your name should be between 4 and 15 characters and may only contain letters" , "Public Msg" , "danger");
    }
    elseif ($age->isValid() === FALSE) {
        Prints::msg("Your age should be between 18 and 75 " , "Public Msg" , "danger");
    }
    elseif ($email->isValid() === FALSE) {
        Prints::msg("This email is ivalid" , "Public Msg" , "danger");
    }
    elseif ($site->isValid() === FALSE) {
        Prints::msg("website must include host name (like http://www.example.com)" , "Public Msg" , "danger");
    }
    elseif ($securityBot->isValid() === FALSE) {
        Prints::msg("Please type the following word  'Fanwik' OR 'chuavas'" , "Public Msg" , "danger");
    }
    elseif ($radioHuman->isValid() === FALSE) {
        Prints::msg("Your ara a robot" , "Public Msg" , "danger");
    }
    else {
        Prints::msg(
                "<br><br><b>Your name</b> : " . $name->inputValue
                . "<br><b>Your age</b> : " . $age->inputValue
                . "<br><b>Your E-Mail</b> : " . $email->inputValue
                . "<br><b>Your Web Site</b> : " . $site->inputValue
                . "<br><b>Are you human?</b> : " . $radioHuman->inputValue
                . "<br><b>Security Bot</b> : " . $securityBot->inputValue
                , "All inputs are OK" , "success");
    }
}
?>
<div>
    <h1>DEMO</h1>
    <form class="form" method="post" action="<?php $_SERVER["PHP_SELF"] ?>">

        <div class="form-group">
            <label for="name">Your name</label>
            <input type="text" class="form-control" name="name" placeholder="Name" >
            <p class="help-block">Your name should be between 4 and 15 characters and may only contain letters</p>
        </div>

        <div class="form-group">
            <label for="age">Your Age</label>
            <input type="text" class="form-control" name="age" placeholder="Age">
            <p class="help-block">Your age should be between 18 and 75 </p>
        </div>

        <div class="form-group">
            <label for="email">Your E-Mail</label>
            <input type="text" class="form-control" name="email" placeholder="email">
            <p class="help-block"> email must should be like example@host.com </p>
        </div>

        <div class="form-group">
            <label for="site">Your website</label>
            <input type="text" class="form-control" name="site" placeholder="site">
            <p class="help-block"> website must include host name (like http://www.example.com)</p>
        </div>

        <div class="form-group">
            <label for="securityBot">Security Bot</label>
            <input type="text" class="form-control" name="securityBot" placeholder="Fanwik OR chuavas">
            <p class="help-block">Please type the following word  "Fanwik" OR "chuavas"</p>
        </div>

        <div class="form-group">
            <label for="radioHuman">Are you Human?</label>
            <label class="radio-inline">
                <input type="radio" name="radioHuman"  value="true"> Yes
            </label>
            <label class="radio-inline">
                <input type="radio" name="radioHuman" checked="checked" value="false"> No
            </label>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    <div class="self-code"><?prettify lang=php?>
        <pre>
<code>if (FilterInput::keyExist("post" , "submit")) {

    //=========================================================
    // FILTERS
    //=========================================================
    
    // Name Filter
    $name = FilterInput::regexp("post" , "name");
    $name->options(Array("regexp" => "/^[a-zA-Z]+$/"));
    $name->extraOptions(Array("min_length" => 4 , "max_length" => 15));

    // Age Filter
    $age = FilterInput::int("post" , "age");
    $age->options(Array("min_range" => 18 , "max_range" => 75));

    // E-Mail Filter
    $email = FilterInput::custom("post" , "email" , "FILTER_VALIDATE_EMAIL");

    // Site Filter
    $site = FilterInput::url("post" , "site");
    $site->flags("FILTER_FLAG_HOST_REQUIRED");

    // Security Bot Filter
    $securityBot = FilterInput::regexp("post" , "securityBot");
    $securityBot->extraOptions(Array("val_compare" => Array("Fanwik" , "chuavas")));

    // Radio Human Filter
    $radioHuman = FilterInput::bool("post" , "radioHuman");

    //=========================================================
    // VALIDATIONS
    //=========================================================

    if ($name->isValid() === FALSE) {
        Prints::msg("Your name should be between 4 and 15 characters and may only contain letters" , "Public Msg" , "danger");
    }
    elseif ($age->isValid() === FALSE) {
        Prints::msg("Your age should be between 18 and 75 " , "Public Msg" , "danger");
    }
    elseif ($email->isValid() === FALSE) {
        Prints::msg("This email is ivalid" , "Public Msg" , "danger");
    }
    elseif ($site->isValid() === FALSE) {
        Prints::msg("website must include host name (like http://www.example.com)" , "Public Msg" , "danger");
    }
    elseif ($securityBot->isValid() === FALSE) {
        Prints::msg("Please type the following word  'Fanwik' OR 'chuavas'" , "Public Msg" , "danger");
    }
    elseif ($radioHuman->isValid() === FALSE) {
        Prints::msg("Your ara a robot" , "Public Msg" , "danger");
    }
    else {
        Prints::msg(
                "&lt;br&gt;&lt;br&gt;&lt;b&gt;Your name&lt;b&gt; : " . $name->inputValue
                . "&lt;br&gt;&lt;br&gt;&lt;b&gt;Your age&lt;b&gt; : " . $age->inputValue
                . "&lt;br&gt;&lt;br&gt;&lt;b&gt;Your E-Mail&lt;b&gt; : " . $email->inputValue
                . "&lt;br&gt;&lt;br&gt;&lt;b&gt;Your Web Site&lt;b&gt; : " . $site->inputValue
                . "&lt;br&gt;&lt;br&gt;&lt;b&gt;Are you human?&lt;b&gt; : " . $radioHuman->inputValue
                . "&lt;br&gt;&lt;br&gt;&lt;b&gt;Security Bot&lt;b&gt; : " . $securityBot->inputValue
                , "All inputs are OK" , "success");
    }
}</code>
        </pre>
    </div>


</div>








<?php include "footer.php"; ?>



