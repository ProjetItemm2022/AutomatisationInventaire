<?php


use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Exécutez les migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('prenom');
            $table->string('nom');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('privilege_id')->constrained();
        });

        User::upsert([
        [   'prenom'=>'bidochon',
            'nom'=>'bidon',
            'email'=>'bidon@gmail.fr',
            'password' => bcrypt('Bidon1234'),
            'privilege_id' => 1,
        ],
        [
            'prenom'=>'Dorian',
            'nom'=>'Blanchet',
            'email'=>'informatique@itemm.fr',
            'password' => bcrypt('Dorian1&'),
            'privilege_id' => 1,
        ],
        [
            'prenom'=>'Nathalie',
            'nom'=>'Fischer',
            'email'=>'nathalie.fischer@itemm.fr',
            'password' => bcrypt('Nathalie1&'),
            'privilege_id' => 1,
        ]],['prenom','nom','email','password','privilege_id']);


    }

    /**
     * Inversez les migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');

    }
}
