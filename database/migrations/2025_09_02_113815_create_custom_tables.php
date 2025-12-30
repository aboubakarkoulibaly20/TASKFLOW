<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomTables extends Migration
{
    public function up()
    {
        Schema::create('actes_juridiques', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titre');
            $table->date('date');
            $table->text('description')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });

        Schema::create('client_sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->string('category_name', 191);
            $table->timestamps();
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->char('iso', 2);
            $table->string('name', 80);
            $table->string('nicename', 80);
            $table->char('iso3', 3)->nullable();
            $table->smallInteger('numcode')->nullable();
            $table->integer('phonecode');
        });

        Schema::create('situations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id')->nullable();
            $table->string('type_impot')->nullable();
            $table->string('type_sociale')->nullable();
            $table->string('regime')->nullable();
            $table->double('montant', 16, 2)->nullable();
            $table->string('periode', 250)->nullable();
            $table->date('date_paiement')->nullable();
            $table->string('file', 250)->nullable();
            $table->string('status', 191)->nullable();
            $table->integer('created_by');
            $table->timestamps();
        });

        Schema::create('client_cga', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('email')->nullable();
            $table->string('telephone');
            $table->string('ville')->nullable();
            $table->string('entreprise')->nullable();
            $table->string('secteur')->nullable();
            $table->string('statut')->nullable();
            $table->string('effectif')->nullable();
            $table->json('services')->nullable();
            $table->string('nom_commercial')->nullable();
            $table->string('capital')->nullable();
            $table->string('rccm')->nullable();
            $table->string('num_contribuable')->nullable();
            $table->string('idu')->nullable();
            $table->string('code_activite')->nullable();
            $table->string('centre_impots')->nullable();
            $table->string('type_regime')->nullable();
            $table->string('localisation_geo')->nullable();
            $table->string('section')->nullable();
            $table->string('parcelle')->nullable();
            $table->text('siege')->nullable();
            $table->string('boite_postale')->nullable();
            $table->string('chiffre_affaire')->nullable();
            $table->date('debut_activite')->nullable();
            $table->text('activites')->nullable();
            $table->string('representant_legal')->nullable();
            $table->string('qualite_representant')->nullable();
            $table->text('message')->nullable();
            $table->string('attachment')->nullable();
            $table->boolean('newsletter')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_cga');
        Schema::dropIfExists('situations');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('client_sub_categories');
        Schema::dropIfExists('actes_juridiques');
    }
}
