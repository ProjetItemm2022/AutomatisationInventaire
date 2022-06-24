<?php

use App\Models\Produit;
use App\Models\Zone;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('boites', function (Blueprint $table) {
        $table->id();
        $table->integer('quantite',false,true);
        $table->foreignIdFor(Zone::class)->constrained();
        $table->foreignIdFor(Produit::class)->constrained();
        $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     *
     */
    public function down()
    {
        Schema::dropIfExists('emplacement');
        Schema::dropIfExists('produits');
    }
}
