<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\FlareClient\Http\Exceptions\NotFound;
use Vinkla\Hashids\Facades\Hashids;


/**
 * @property int $id
 * @property string $imdb_id
 * @property string $title
 * @property int $year
 * @property double $rating
 * @property int $rating_count
 * @property string $description
 *
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Movie extends Model
{

    static $HASHIDS_NUMBER = 1;


    use HasFactory, \App\Traits\Hashids;

    protected $fillable = [
        "imdb_id",
        "title",
        "year",
        "rating",
        "rating_count",
        "description",
        "video"
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function keywords()
    {
        return $this->belongsToMany(Keyword::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function toPageValue()
    {
        $data = $this->toArray();
        $data['hashid'] = $this->hashid();
        return $data;
    }

    public function getThumbnailUrl()
    {
        return $this->image->filename;
    }
}
