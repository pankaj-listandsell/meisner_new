<?php

namespace Custom\Helpers\Exporter\Locale;

use Illuminate\Support\Facades\Cache;

class LocaleExporter
{

    public static function getLocaleInArray(): array
    {
        return require 'messages.php';
    }


    protected static function getLocale(): array
    {
        $path = resource_path('lang');

        // Loop through directories
        $dirIterator = new \RecursiveDirectoryIterator($path, \RecursiveDirectoryIterator::SKIP_DOTS);
        $recIterator = new \RecursiveIteratorIterator($dirIterator);


        $jsonFiles = array_values(
            array_map('current',
                iterator_to_array(
                    new \RegexIterator($recIterator, '/^.+\.json$/i', \RecursiveRegexIterator::GET_MATCH)
                )
            )
        );

        // Sort array by filepath
        sort($jsonFiles);


        // Fetch .json files from filtered files
        $jsonFiles = array_filter($jsonFiles, function ($file) {
            return strpos($file, '.json') !== false;
        });

        $messages = [];
        foreach ($jsonFiles as $jsonFile) {
            $language = basename($jsonFile, '.json');
            $fileContents = json_decode(file_get_contents($jsonFile), 1);
            $messages[$language] = $fileContents;
        }

        return $messages;
    }

}
