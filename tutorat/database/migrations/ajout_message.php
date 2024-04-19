<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('message',function(Blueprint $table){
            $table -> increments('id');
            $table -> integer('from_id') -> unsigned();
            $table -> integer('to_id') -> unsigned();
            $table ->foreign('from_id','from')->references('id')->on('users')->onDelete('cascade');
            $table ->foreign('to_id','to')->references('id')->on('users')->onDelete('cascade');
            $table ->text('content');
            $table ->timestamp('created_at') ->useCurrent();
            $table -> dateTime('read_at') -> nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('message');
    }
};
