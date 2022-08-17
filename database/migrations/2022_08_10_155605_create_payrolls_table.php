<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emp_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreignId('mp_id')->references('id')->on('mainpayrolls')->onDelete('cascade');
            $table->string('attendance');
            $table->string('salary');
            $table->string('total');
            $table->string('pag_ibig');
            $table->string('sss');
            $table->string('payroll_date');
            $table->boolean('type')->default(0);
            $table->string('created_at');

      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payrolls');
    }
}
