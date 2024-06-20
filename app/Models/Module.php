<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * 
 * @OA\Schema(
 *      required={"name","description"},
 *      @OA\Xml(name="Module"),
 *      @OA\Property(property="name", type="string", example="pwes"),
 *      @OA\Property(property="description", type="string", example="Programacion Web Entorno Servidor"),
 * )
 **/
class Module extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_modules');
    }
}
