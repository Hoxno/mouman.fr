<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * La table profiles n'a jamais ete utilisee : aucun code ne l'a
     * lue ni ecrite, ses colonnes doublonnaient celles de users, et
     * HomeController s'appuie sur le modele User.
     */
    public function up(): void
    {
        Schema::dropIfExists('profiles');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('jobtitle');
            $table->longText('description');
            $table->string('src');
            $table->timestamps();
        });
    }
};
