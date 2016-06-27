<?php

class FilterInputValidate {

    public $inputValue = NULL;


    private $filterMethod = NULL;


    private $filterValue = NULL;


    private $filterValidate = NULL;


    private $filterOptions = Array();


    private $filterExtraOptions = Array();


    public function __construct($method , $value , $filter_validate) {

        $this->filterMethod = $this->getFilterMethod($method);
        $this->filterValue = $value;
        $this->filterValidate = $filter_validate;
        $this->extraOptions();
    }


    public function isValid($debug = FALSE) {

       
        if ($this->filterMethod === "VAR") {
            if (isset($this->filterValue)) {
                $this->inputValue = filter_var($this->filterValue , constant($this->filterValidate) , $this->filterOptions);
            }
            else {
                return FALSE;
            }
        }
        else {
            $this->inputValue = filter_input(constant($this->filterMethod) , $this->filterValue , constant($this->filterValidate) , $this->filterOptions);
        }

        if ($debug) {
            if (class_exists('Prints')) {
                Prints::varDump(Array(
                    " |- this->inputValue" => $this->inputValue ,
                    " |- this->inputChecklength" => $this->inputChecklength() ,
                    " |- this->inputCompareValue" => $this->inputCompareValue()
                        ) , __METHOD__);
            }
            else{
                var_dump(Array(
                    " |- this->inputValue" => $this->inputValue ,
                    " |- this->inputChecklength" => $this->inputChecklength() ,
                    " |- this->inputCompareValue" => $this->inputCompareValue()
                        ));
            }
        }

        if (is_null($this->inputValue) OR $this->inputValue === FALSE) {
            return FALSE;
        }
        elseif ($this->inputChecklength() && $this->inputCompareValue()) {

            return TRUE;
        }
        else {
            return FALSE;
        }
    }


    public function options($options = Array()) {

        if (isset($options["regexp"])) {
            $this->filterOptions["options"]["regexp"] = $options["regexp"];
        }

        if (isset($options["min_range"])) {
            $this->filterOptions["options"]["min_range"] = $options["min_range"];
        }

        if (isset($options["max_range"])) {
            $this->filterOptions["options"]["max_range"] = $options["max_range"];
        }
    }

    public function extraOptions($extra_options = Array()) {

        if (!isset($extra_options["val_compare"])) {
            $extra_options["val_compare"] = NULL;
        }
        $this->filterExtraOptions["extra_options"]["val_compare"] = $extra_options["val_compare"];


        if (!isset($extra_options["min_length"])) {
            $extra_options["min_length"] = NULL;
        }
        $this->filterExtraOptions["extra_options"]["min_length"] = $extra_options["min_length"];


        if (!isset($extra_options["max_length"])) {
            $extra_options["max_length"] = NULL;
        }
        $this->filterExtraOptions["extra_options"]["max_length"] = $extra_options["max_length"];

        return $this->filterExtraOptions;
    }

    public function flags($flags = NULL) {
        if (!is_null($flags)) {
            $this->filterOptions['flags'] = constant($flags);
        }
    }

    private function inputChecklength() {
        $min_length = $this->filterExtraOptions["extra_options"]["min_length"];
        $max_length = $this->filterExtraOptions["extra_options"]["max_length"];

        if (!is_null($min_length) && !is_null($max_length) && !is_array($this->inputValue)) {
            if (strlen($this->inputValue) < $this->filterExtraOptions["extra_options"]["min_length"]) {
                return FALSE;
            }


            if (strlen($this->inputValue) > $this->filterExtraOptions["extra_options"]["max_length"]) {
                return FALSE;
            }
        }
        return TRUE;
    }


    private function inputCompareValue() {

        if (!is_null($this->filterExtraOptions["extra_options"]["val_compare"])) {

            $val_compare = $this->filterExtraOptions["extra_options"]["val_compare"];

            is_array($val_compare) ? $array = $val_compare : $array[0] = $val_compare;

            if (!in_array($this->inputValue , $array)) {
                return FALSE;
            }
        }

        return TRUE;
    }

    private function getFilterMethod($method) {

        switch (strtoupper($method)) {
            case "GET":
                return "INPUT_GET";
            case "POST":
                return "INPUT_POST";
            case "COOKIE":
                return "INPUT_COOKIE";
            case "SERVER":
                return "INPUT_SERVER";
            case "ENV":
                return "INPUT_ENV";
            case "VAR":
                return "VAR";
        }

        return FALSE;
    }

}

class FilterInput {

    static public function regexp($method , $value) {
        $filter_validate = "FILTER_VALIDATE_REGEXP";
        $options = Array(
            "regexp" => "/^[a-zA-Z0-9_]+$/"
        );

        $extra_options = Array(
            "min_length" => 0 ,
            "max_length" => 20
        );

        $regexp = new FilterInputValidate($method , $value , $filter_validate);
        $regexp->options($options);
        $regexp->extraOptions($extra_options);

        return $regexp;
    }

    static public function int($method , $value) {
        $filter_validate = "FILTER_VALIDATE_INT";
        $options = Array(
            "min_range" => 1 ,
            "max_range" => 999
        );

        $int = new FilterInputValidate($method , $value , $filter_validate);
        $int->options($options);

        return $int;
    }

    static public function bool($method , $value) {

        $filter_validate = "FILTER_VALIDATE_BOOLEAN";

        $bool = new FilterInputValidate($method , $value , $filter_validate);
        return $bool;
    }

    static public function url($method , $value) {
        $filter_validate = "FILTER_VALIDATE_URL";

        $url = new FilterInputValidate($method , $value , $filter_validate);
        return $url;
    }

    static public function custom($method , $value , $filter_validate) {

        $custom = new FilterInputValidate($method , $value , $filter_validate);
        return $custom;
    }

    static public function keyExist($method , $value) {
        $filter_validate = "FILTER_UNSAFE_RAW";
        $extra_options = Array(
            "min_length" => 0 ,
            "max_length" => 0 ,
            "val_compare" => ""
        );


        $key = new FilterInputValidate($method , $value , $filter_validate);
        $key->extraOptions($extra_options);
        return $key->isValid();
    }

}

class FilterVar extends FilterInput {

    static public function regexp($value) {
        return parent::regexp("var" , $value);
    }

    static public function bool($value) {
        return parent::bool("var" , $value);
    }

    static public function int($value) {
        return parent::int("var" , $value);
    }

    static public function custom($value , $filter_validate) {
        return parent::custom("var" , $value , $filter_validate);
    }

}
?> 
