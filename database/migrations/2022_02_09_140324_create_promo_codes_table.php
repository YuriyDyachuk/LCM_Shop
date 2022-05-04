<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->unsignedSmallInteger('amount');
            $table->string('description')->nullable();
            $table->timestamp('expiry_date_at')->nullable();
            $table->boolean('is_active')->default(0);
            $table->unsignedBigInteger('used_user_id')->nullable();
            $table->timestamps();

            $table->unique('code');

            $table->foreign('used_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promo_codes');
    }
}
