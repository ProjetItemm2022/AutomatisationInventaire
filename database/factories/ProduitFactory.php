<?php

namespace Database\Factories;

use App\Models\Fournisseur;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'nom'=> $this->faker->word(),
            'quantite'=> $this->faker->randomNumber(4,false),
            'seuilMin'=> $this->faker->randomNumber(2,false),
            'seuilAlerte'=> $this->faker->randomNumber(1,false),
            'ref'=> $this->faker->word(),
            'description'=> $this->faker->text(),
            'numBon'=> $this->faker->randomNumber(5,false),
            'désactivé' =>False,
            'cheminImage' =>$this->faker->url(),
            'ImageQrcode' =>$this->faker->url(),
            'fournisseur_id' =>Fournisseur::factory(),

        ];
    }
}
