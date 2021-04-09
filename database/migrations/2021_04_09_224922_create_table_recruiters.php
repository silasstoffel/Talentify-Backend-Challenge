<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRecruiters extends Migration
{
    public function up()
    {
        $name = 'recruiters';
        if (!Schema::hasTable($name)) {
            Schema::create($name, function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name', 80);
                $table->string('email', 65)->unique('index_email_unique1');
                $table->uuid('company_id');
                $table->timestamps();

                $table->foreign('company_id', 'fk_company_id1')
                    ->references('id')
                    ->on('companies');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('recruiters');
    }
}
