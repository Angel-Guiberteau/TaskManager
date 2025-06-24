<?php
/**
 * Modelo para la gestión de prioridades de tareas.
 *
 * Este modelo representa la tabla 'priorities' en la base de datos 
 * y proporciona métodos para interactuar con ella.
 *
 * @category Models
 * @package  App\Models
 * @author   Tu Nombre <tu.email@example.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://example.com/docs/priority-model
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Modelo para la gestión de prioridades de tareas.
 *
 * Este modelo representa la tabla 'priorities' en la base de datos 
 * y proporciona métodos para interactuar con ella.
 *
 * @category Models
 * @package  App\Models
 * @author   Tu Nombre <tu.email@example.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://example.com/docs/priority-model
 */
class Priority extends Model
{
    /**
     * @var string Nombre de la tabla asociada al modelo.
     */
    protected $table = 'priorities';

    /**
     * @var array Atributos que son asignables masivamente.
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Obtiene todas las prioridades de tareas.
     *
     * @return Collection Colección de todas las prioridades.
     */
    public static function allPriorities(): Collection
    {
        return self::all();
    }
}