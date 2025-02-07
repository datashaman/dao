<?php

namespace App\Support;

class NameGenerator
{
    function generate(bool $addTitle = true): string
    {
        $prefixes = config('name-generator.prefixes');
        $infixes = config('name-generator.infixes');
        $suffixes = config('name-generator.suffixes');
        $titles = config('name-generator.titles');

        $prefix = $prefixes[array_rand($prefixes)];
        $infix = $infixes[array_rand($infixes)];
        $suffix = $suffixes[array_rand($suffixes)];
        $realmName = $prefix . $infix . $suffix;

        // 33% chance to include a title
        if ($addTitle && rand(0, 2) === 1) {
            $title = $titles[array_rand($titles)];
            return $title . " " . $realmName;
        }

        return $realmName;
    }
}
