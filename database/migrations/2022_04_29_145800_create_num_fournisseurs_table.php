<?php
use App\Models\Fournisseur;
use App\Models\Produit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNumfournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('num_fournisseurs', function (Blueprint $table) {
        $table->id();
        $table->foreignIdFor(Fournisseur::class)->constrained();
        $table->foreignIdFor(Produit::class)->constrained();

    });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::dropIfExists('fournisseurs');
        Schema::dropIfExists('produits');
    }


}


