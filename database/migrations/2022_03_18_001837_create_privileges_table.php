<?php

use App\Models\Privilege;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privileges', function (Blueprint $table) {
            $table->id();
            $table->string("nom",15);
            $table->timestamps();
        });

        Privilege::upsert(
            [['nom'=> 'Administrateur'],['nom'=> 'Gestionnaire'],
            ['nom'=> 'Consultant']],['nom'],[]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privileges');
    }
}
