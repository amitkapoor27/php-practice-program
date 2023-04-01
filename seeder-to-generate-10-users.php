<?php
    use App\Models\Auth\User;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Seeder;
    class UserTableSeeder extends Seeder{
        public function run()
        {
            factory(User::class,10)->create();
            # code...
        }
    }
?>