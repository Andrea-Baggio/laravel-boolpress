<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'php', 'Laravel 7', 'VueJs', 'Cucina moderna', 'Piatti tipici', 'Roma', 'Venezia', 'Emilia Romagna', 'Acqua minerale', 'Valle d\'Aosta',
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'slug'  => Tag::getSlug($tag),
                'name'  => $tag,
            ]);
        }
    }
}
