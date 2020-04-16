<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorieSeeder extends Seeder
{

	private $categories = [
		'Entretenimiento',
		'Noticias',
		'Educación',
		'Otros'
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach ($this->categories as $cat) {
	        DB::table('categories')->insert([
	            'title' => $cat,
	            'url_clean' => Str::of($cat)->slug('-')
	        ]);
    	}
    }
}
