<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Slugger {
    public static function getSlug($text) {
        // generare lo slug base
        $slugBase = Str::slug($text);
        $slug = $slugBase;
        $i = 1;

        // trovo il primo slug non usato
        while(self::where('slug', $slug)->first()) {
            $slug = $slugBase . '-' . $i;
            $i++;
        }

        // ritorno lo slug generato
        return $slug;
    }
}
