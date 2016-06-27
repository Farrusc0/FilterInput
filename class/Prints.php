<?php

class Prints {

    static public function printR($value, $title = NULL) {
        $title = self::getTitle($title);
        echo '<pre>';
        echo $title;
        echo "<br><br>";
        print_r($value);
        echo '</pre>';
    }

    static public function varDump($value, $title = NULL) {
        $title = self::getTitle($title);
        echo '<pre>';
        echo $title;
        echo "<br><br>";
        var_dump($value);
        echo '</pre>';
    }

    static public function msg($value, $title = NULL , $style = 'primary') {
        $title = self::getTitle($title);
        echo "<p class='bg-".$style."' style='padding: 10px;'>";
        echo "<span style='font-size: 14px; font-weight: bold;'>$title</span>&nbsp&nbsp";
        echo $value;
        echo '</p>';
    }

    private static function getTitle($title) {
        $title = is_null($title) ? $_SERVER['SCRIPT_NAME'] : $title;
        $title = strtoupper($title);
        $title = basename($title, ".php");
        return $title;
    }

}

?>
