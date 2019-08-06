<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->mediumText('body');
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
        Schema::dropIfExists('posts');
    }
}



// <?php

// use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Database\Migrations\Migration;

// class CreateCommentsTable extends Migration
// {
//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         Schema::create('comments', function (Blueprint $table) {
//             $table->bigIncrements('id');
//             $table->text('content');
//             $table->integer('creator_id');
//             $table->integer('post_id');
//             $table->timestamps();

//             Schema::table('comments', function(Blueprint $table) {
//                 $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
//                 $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
//             });
//         });
//     }

//     /**
//      * Reverse the migrations.
//      *
//      * @return void
//      */
//     public function down()
//     {
//         Schema::dropIfExists('comments');
//         Schema::dropForeign('creator_id');
//         Schema::dropForeign('post_id');
        
//     }
// }
