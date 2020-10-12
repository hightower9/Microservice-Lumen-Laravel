<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * required={"name","gender","country"},
 * @OA\Xml(name="Author"),
 * @OA\Property(property="name", type="string", example="John"),
 * @OA\Property(property="gender", type="string", description="Authors gender", example="male"),
 * @OA\Property(property="country", type="string", description="Your Country", example="United Kingdom")
 * )
 *
 * Class User
 *
 */

class Author extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'gender', 'country'
    ];
}
