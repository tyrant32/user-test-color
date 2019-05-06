<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateFavoriteColorUserTable
 */
class CreateFavoriteColorUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_color_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('favorite_color_id');
            
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            
            $table->foreign('favorite_color_id')
                ->references('id')
                ->on('favorite_colors');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite_color_user');
    }
}
