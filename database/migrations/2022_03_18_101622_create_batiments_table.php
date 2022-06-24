<?php

use App\Models\Batiment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batiments', function (Blueprint $table) {
            $table->id();
            $table->string("nom",30);
            $table->string("cheminImage",150);
            $table->string("cheminImageDetail",150);
            $table->json("coordPoint")->nullable();
            $table->json("offset")->nullable();
            $table->timestamps();

        });
        Batiment::upsert([
            ['nom'=>'Batiment Central','cheminImageDetail'=> 'images/plan/1rdc.png','cheminImage'=> 'images/plan/0PlanGeneral.png'],
            ['nom'=>'Brahms','cheminImageDetail'=>'images/plan/2Brahms.png',"cheminImage"=> 'images/plan/0PlanGeneral.png'],
            ['nom'=>'Debussy','cheminImageDetail'=>'images/plan/3Debussy.png',"cheminImage"=> 'images/plan/0PlanGeneral.png'],
            ['nom'=>'Gershwin',"cheminImageDetail"=>'images/plan/4Gershwin.png',"cheminImage"=> 'images/plan/0PlanGeneral.png'],
            ['nom'=>'Haendel',"cheminImageDetail"=>'images/plan/5Haendel.png',"cheminImage"=> 'images/plan/0PlanGeneral.png'],
            ['nom'=>'Pape',"cheminImageDetail"=>'images/plan/6Pape.png',"cheminImage"=> 'images/plan/0PlanGeneral.png'],
            ['nom'=>'Sax',"cheminImageDetail"=>'images/plan/7Sax.png',"cheminImage"=> 'images/plan/0PlanGeneral.png'],
            ['nom'=>'Torres',"cheminImageDetail"=>'images/plan/8Torres.png',"cheminImage"=> 'images/plan/0PlanGeneral.png'],
        ],[]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batiments');
    }
}
