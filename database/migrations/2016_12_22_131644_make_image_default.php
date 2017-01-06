<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeImageDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $logo = new \Illuminate\Http\UploadedFile(storage_path('app/files/images/no-image.png'), 'no-image.png');
        $name = env('IMAGE_DEFAULT');
        $destFile = \FinancialSystem\Models\Bank::logosDir();

        \Storage::disk('public')->putFileAs($destFile, $logo, $name);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Storage::disk('public')->delete(\FinancialSystem\Models\Bank::logosDir().'/'.env('IMAGE_DEFAULT'));
    }
}
