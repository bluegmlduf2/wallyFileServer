<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id'); 
            // 1.file테이블의 id컬럼 뒤에 user_id라는 외래키 컬럼추가 
            // 2.model에 정의한 연관관계 user_id에 대한 reloation을 정의했기때문에 여기서 따로 relation정의하지않는다 
            // 3.model에 $this->belongsTo(User::class)의 belongsTo에 인수에 지정을 안하면 자동으로 user_id로 들어간다 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('user_id');
            // 1.php artisan migtate:rollback로 되돌렸을때 해당 명령어를 실행해서 되돌림
        });
    }
};
