<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Category;
class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });
        $bebida = new Category;
        $bebida->title = 'Bebida';
        $bebida->save();

        $golosina = new Category;
        $golosina->title= 'Golosina';
        $golosina->save();

        $cigarro = new Category;
        $cigarro->title = 'Cigarro';
        $cigarro->save();

        $comida= new Category;
        $comida->title = 'Comida';
        $comida->save();

        $galleta= new Category;
        $galleta->title = 'Galleta';
        $galleta->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
