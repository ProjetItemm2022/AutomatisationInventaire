<?php

namespace Database\Seeders;

use App\Models\Fournisseur;
use App\Models\Produit;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Produit::factory()->count(50)->create();
    }
}
