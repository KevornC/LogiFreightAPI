<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagedetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packagedetails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained('packages','id');
            $table->bigInteger('quantity')->unsigned();
            $table->float('weight',10,2);
            $table->string('shipper');
            $table->string('shipper_address');
            $table->string('shipper_TN');
            $table->string('Package_TN');
            $table->float('est_cost',10,2);
            $table->string('status');
            $table->string('InvoiceStatus')->default('Invoice Not Generated');
            $table->string('Uploaded_by');
            $table->date('date_uploaded');
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
        Schema::dropIfExists('packagedetails');
    }
}
