<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOpportunities extends Migration
{

    public function up()
    {
        $tab = 'opportunities';
        if (!Schema::hasTable($tab)) {
            Schema::create($tab, function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('title', 100);
                $table->text('description');
                $table->string('status', 50);
                $table->string('address', 100);
                $table->decimal('salary', 8, 2);
                $table->uuid('company_id');
                $table->uuid('recruiter_id');
                $table->timestamps();

                $table->foreign('company_id', 'fk_company_id2')
                    ->references('id')
                    ->on('companies');

                $table->foreign('recruiter_id', 'fk_recruiter_id2')
                    ->references('id')
                    ->on('recruiters');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('opportunities');
    }
}
