<?php

namespace App\Traits;

use Exception;
use phpDocumentor\Reflection\Types\ClassString;
use Spatie\FlareClient\Http\Exceptions\NotFound;

trait Hashids
{

    /**
     * @template T
     * @param string $hash
     * @return T
     */
    public static function fromHashId(string $hash)
    {
        $data = \Vinkla\Hashids\Facades\Hashids::decode($hash);

        if (sizeof($data) == 0) {
            throw new NotFound();
        }

        if (!isset(static::$HASHIDS_NUMBER))
            throw new \Error("HASHIDS_NUMBER not defined on " . parent::class);

        [$magic_number, $id] = $data;

        if ($magic_number !== static::$HASHIDS_NUMBER) {
            dd($magic_number, $id);
            return new \Error("Wrong Magic number");
        }

        try {
            return parent::withTrashed()->findOrFail($id);
        } catch (Exception) {
        }
        return parent::query()->findOrFail($id);
    }

    /**
     * @template T
     * @return string
     */
    public function hashid()
    {
        if (!isset(static::$HASHIDS_NUMBER))
            throw new \Error("HASHIDS_NUMBER not defined on " . parent::class);
        $encode = \Vinkla\Hashids\Facades\Hashids::encode(static::$HASHIDS_NUMBER, $this->id);
        return $encode;
    }


    //    public function getHashidAtribute()
    //    {
    //        return $this->hashid();
    //    }
}
