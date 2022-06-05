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
        $genres = [];
        {
            // Create plans
            $proPlan = Plan::factory()->state([
                "name" => "Pro plan",
                "slug" => "pro-plan",
                "price_monthly_id" => 'price_1L6YAeDvJjMMwBvKlcq9t1yv',
                "price_yearly_id" => 'price_1L6YAeDvJjMMwBvKzOFTmzx9',
            ])->create();

            $basicPlan = Plan::factory()->state([
                "name" => "Basic plan",
                "slug" => "basic-plan",
                "price_monthly_id" => 'price_1L6Y9GDvJjMMwBvKNeLwM3WO',
                "price_yearly_id" => 'price_1L6Y9GDvJjMMwBvKPWZBlUFs',
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


        // watched movies
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

//            $fav_list = Playlist::factory()->favourites()->for($user)->create();
//            $user->favourites_id = $fav_list->id;
//            $ignore_list = Playlist::factory()->ignored()->for($user)->create();
//            $user->ignored_id = $ignore_list->id;
//            $user->updateOrFail();
        }

        // unwatched movies
        for ($i = 0; $i < 10; $i++)
            Movie::factory()
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
