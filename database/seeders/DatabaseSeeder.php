<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Image;
use App\Models\Keyword;
use App\Models\Movie;
use App\Models\Plan;
use App\Models\Playlist;
use App\Models\User;
use App\Models\WatchStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {

        $songs = [
            'AbPED9bisSc',
            '6BTjG-dhf5s',
            '8WYHDfJDPDc',
            'RqpKDkVzlqU',
            'AgFeZr5ptV8',
            'SDTZ7iX4vTQ',
            '7-7knsP2n5w',
            'vjW8wmF5VWc',
            '9BMwcO6_hyA',
            '1G4isv_Fylg',
            '12CeaxLiMgE',
            'CGyEd0aKWZE',
            'k4YRWT_Aldo',
            'FOjdXSrtUxA',
            'UqyT8IEBkvY',
            'fJ9rUzIMcZQ',
            'L3wKzyIN1yk',
            'Pw-0pbY9JeU',
            'tvTRZJ-4EyI',
            'uxpDa-c-4Mc',
            '_I_D_8Z4sJE',
            'ffxKSjUwKdU',
            'pB-5XG-DbAA',
            'xFutjZEBTXs',
            '4NNRy_Wz16k',
            '2zNSgSzhBfM',
            'kLpH1nSLJSs',
            '9Sc-ir2UwGU',
            'foE1mO2yM04',
            'NGLxoKOvzu4',
            'J_ub7Etch2U',
            'yyDUC1LUXSU',
            'QJO3ROT-A4E',
            'KlyXNRrsk4A',
            'TR3Vdo5etCQ',
            '0yr75-gxVtM',
            'wzMrK-aGCug',
            'm-M1AtrxztU',
            'Ey_hgKCCYU4',
            'rYEDA3JcQqw',
            'iQEVguV71sI',
            'C_3d6GntKbk',
            '60ItHLz5WEA',
            '7F37r50VUTQ',
            'RSyUWjftHrs',
            'VuNIsY6JdUw',
            'kTHNpusq654',
            'Bznxx12Ptl0',
            'EHkozMIXZ8w',
            'fV4DiAyExN0',
            'mWRsgZuwf_8',
            'ShlW5plD_40',
            'DUT5rEU6pqM',
            '5anLPw0Efmo',
            'S-sJp1FfG7Q',
            'PIb6AZdTr-A',
            'EPo5wWmKEaI',
            'hLQl3WQQoQ0',
            'vJwKKKd2ZYE',
            'JWESLtAKKlU',
            '_kxz7WX4mLU',
            'W-w3WfgpcGg',
            '3tmd-ClpJxA',
            'PEGccV-NOm8',
            '9bZkp7q19f0',
            'PMivT7MJ41M',
            'LDZX4ooRsWs',
            'O-zpOMYRi0w',
            'qDc_5zpBj7s',
            'Um7pMggPnug',
            'xwtdhWltSIg',
            '1ekZEVeXwek',
            'aPxVSCfoYnU',
            'nlcIKh6sBtc',
            '7zp1TbLFPp8',
            'V_MXGdSBbAI',
            'CevxZvSJLk8',
            'ALZHF5UqnU4',
            '9jK-NcRmVcw',
            'ypPSrRYOAj4',
            'WA4iX5D9Z64',
            '6ACl8s_tBzE',
            'tg00YEETFzg',
            'DK_0jXPuIr0',
            'CfihYWRWRTQ',
            '_CL6n0FJZpk',
            'U0CGsw6h60k',
            'fk4BbF7B29w',
            '8SbUC-UaAxE',
            'W-TE_Ys4iwM',
            'ixkoVwKQaJg',
            '7RMQksXpQSk',
            'kdemFfbS5H0',
        ];

        $genres = [];
        // Create plans
        {
            $proPlan = Plan::factory()->state([
                "name" => "Pro plan",
                // "slug" => "pro-plan",
                // "price_monthly_id" => 'price_1L6YAeDvJjMMwBvKlcq9t1yv',
                // "price_yearly_id" => 'price_1L6YAeDvJjMMwBvKzOFTmzx9',
                "stripe_product_id" => "prod_LoAVFfDYT2M9aS",
            ])->create();

            $basicPlan = Plan::factory()->state([
                "name" => "Basic plan",
                // "slug" => "basic-plan",
                // "price_monthly_id" => 'price_1L6Y9GDvJjMMwBvKNeLwM3WO',
                // "price_yearly_id" => 'price_1L6Y9GDvJjMMwBvKPWZBlUFs',
                "stripe_product_id" => "prod_LoAUF1JkLLk2GY",
            ])->create();
        }

        // Create genres
        {

            $genre_names = [
                'Adventure',
                'Fantasy',
                'Animation',
                'Drama',
                'Horror',
                'Action',
                'Comedy',
                'History',
                'Western',
                'Thriller',
                'Crime',
                'Documentary',
                'Science Fiction',
                'Mystery',
                'Music',
                'Romance',
                'Family',
                'War',
                'Foreign',
                'TV Movie'
            ];

            foreach ($genre_names as $genre) {
                $g = Genre::factory()->make([
                    "name" => $genre
                ]);

                $genres[] = $g;
                $g->saveOrFail();
            }
        }


        // users watched movies
        for ($i = 0; $i < 20; $i++) {
            $user = User::factory()
                ->for(
                    Playlist::factory()
                        ->favourites(),
                    'favourites'
                )
                ->for(
                    Playlist::factory()
                        ->ignored(),
                    'ignored'
                )
                ->has(
                    WatchStatus::factory()
                        ->for(
                            Movie::factory()
                                ->state([
                                    'video' => 'yt:' . Arr::random($songs)
                                ])
                                ->has(
                                    Image::factory()
                                )
                                ->has(
                                    Keyword::factory()
                                        ->count(random_int(0, 4))
                                )
                                ->for(
                                    Arr::random($genres)
                                )
                        )
                )
                ->create();
        }



        // Admin user
        User::factory()
            ->for(
                Playlist::factory()
                    ->favourites(),
                'favourites'
            )
            ->for(
                Playlist::factory()
                    ->ignored(),
                'ignored'
            )
            ->create([
                'is_admin' => true,
                'email' => "admin@admin.com",
                'password' => \Illuminate\Support\Facades\Hash::make('admin'),
            ]);

        // unwatched movies
        for ($i = 0; $i < 250-20; $i++)
            Movie::factory()
                ->state([
                    'video' => 'yt:' . Arr::random($songs)
                ])
                ->has(
                    Image::factory()
                )
                ->has(
                    Keyword::factory()
                        ->count(random_int(0, 4))
                )
                ->for(
                    Arr::random($genres)
                )
                ->create();
    }
}
