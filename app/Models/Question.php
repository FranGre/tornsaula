<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Scout\Searchable;

/**
 *
 * @OA\Schema(
 * required={"user_id","module_id","title","description"},
 * @OA\Xml(name="Question"),
 * @OA\Property(property="user_id", type="integer", example="1"),
 * @OA\Property(property="module_id", type="integer", description="1"),
 * @OA\Property(property="title", type="string", description="question title"),
 * @OA\Property(property="description", type="string", description="questions description"),
 * @OA\Property(property="photo", type="img", example="pepito.img"),
 * )
 **/
class Question extends Model
{
    use HasFactory;
    use Searchable;


    protected $guarded = [
        'id'
    ];

    public function answer(): HasOne
    {
        return $this->hasOne(Answer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class)->withDefault();
    }
}
