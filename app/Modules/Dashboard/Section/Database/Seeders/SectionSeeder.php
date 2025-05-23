<?php
namespace App\Modules\Dashboard\Section\Database\Seeders;

use App\Modules\Dashboard\Section\Entities\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        Model::unguard();
        Section::create([

        ]);
        DB::commit();
    }
}
