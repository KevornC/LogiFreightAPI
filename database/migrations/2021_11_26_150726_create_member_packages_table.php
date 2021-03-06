<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members','id');
            $table->integer('total_packages');
            $table->integer('package_transit');
            $table->integer('package_pickup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_packages');
    }
}
