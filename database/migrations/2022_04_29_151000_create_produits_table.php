<?php
use App\Models\NumFournisseur;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string("nom",150);
            $table->integer("quantite",false,true);
            $table->integer("seuilMin",false,true)->nullable();
            $table->integer("seuilAlerte",false,true)->nullable();
            $table->string("ref",60)->nullable();
            $table->text("description")->nullable();
            $table->string("numBon",50)->nullable();
            $table->softDeletes();
            $table->string("cheminImage",150)->default("images/produits/default.png");
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->foreignId("categorie_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
