<?php
/**
 * Modelo para la gestión de usuarios.
 *
 * Este modelo representa la tabla 'users' en la base de datos 
 * y proporciona métodos para interactuar con ella.
 *
 * @category Models
 * @package  App\Models
 * @author   Tu Nombre <tu.email@example.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://example.com/docs/users-model
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Modelo para la gestión de usuarios.
 *
 * Este modelo representa la tabla 'users' en la base de datos 
 * y proporciona métodos para interactuar con ella.
 *
 * @category Models
 * @package  App\Models
 * @author   Tu Nombre <tu.email@example.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://example.com/docs/users-model
 */
class Users extends Model
{
    /**
     * @var string Nombre de la tabla asociada al modelo.
     */
    protected $table = 'users';

    /**
     * @var array Atributos que son asignables masivamente.
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * Obtiene todos los usuarios.
     *
     * @return Collection Colección de todos los usuarios.
     */
    public static function allUsers(): Collection
    {
        return self::all();
    }
}