<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartureDateToBookingsTable extends Migration
{
    public function up(): void
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->date('departure_date')->nullable();
    });
}

public function down(): void
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->dropColumn('departure_date');
    });
}

}
