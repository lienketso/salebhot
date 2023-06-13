<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(UsersSeeder::class);
        for($i=0;$i<=1000;$i++) {
            DB::table('company')->insert([
                'name' => 'Chưa cập nhật',
                'company_code' => $this->generateUniqueCode(),
                'status' => 'disable',
                'password'=>\Illuminate\Support\Facades\Hash::make('baohiemoto')
            ]);
        }
    }

    public function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (\Company\Models\Company::where("company_code", "=", $code)->first());
        return $code;
    }
}
