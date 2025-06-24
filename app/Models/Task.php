<?php
/**
 * Modelo para la gestión de tareas.
 *
 * Este modelo representa la tabla 'tasks' en la base de datos 
 * y proporciona métodos para interactuar con ella.
 *
 * @category Models
 * @package  App\Models
 * @author   Tu Nombre <tu.email@example.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://example.com/docs/task-model
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Modelo para la gestión de tareas.
 *
 * Este modelo representa la tabla 'tasks' en la base de datos 
 * y proporciona métodos para interactuar con ella.
 *
 * @category Models
 * @package  App\Models
 * @author   Tu Nombre <tu.email@example.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://example.com/docs/task-model
 */
class Task extends Model
{
    /**
     * @var string Nombre de la tabla asociada al modelo.
     */
    protected $table = 'tasks';

    /**
     * @var array Atributos que son asignables masivamente.
     */
    protected $fillable = [
        'name',
        'description',
        'status',
        'user_asigned',
        'priority_id',
        'resolution_date',
        'start_date',
        'end_date',
    ];

    /**
     * Obtiene todas las tareas con información de prioridad y usuario.
     *
     * @return Collection Colección de tareas con información de prioridad y usuario.
     */
    private static function _allTasks(): Collection
    {
        return self::join('priorities', 'tasks.priority_id', '=', 'priorities.id')
            ->join('users', 'tasks.user_asigned', '=', 'users.id')
            ->select('tasks.*', 'priorities.name as priority_name', 'users.name as user_name')
            ->get();
    }

    /**
     * Agrega una nueva tarea.
     *
     * @param array $data Datos de la tarea a agregar.
     *
     * @return Task|null La tarea creada o null en caso de error.
     */
    public static function addTask(array $data)
    {
        return self::create(
            [
                'name' => $data['taskName'],
                'description' => $data['taskDescription'],
                'status' => 'n',
                'user_asigned' => $data['assignedUser'],
                'priority_id' => $data['priority_id'],
                'resolution_date' => $data['resolutionDate'],
            ]
        );
    }

    /**
     * Elimina una tarea por su ID.
     *
     * @param int $id El ID de la tarea a eliminar.
     *
     * @return bool True si la tarea se eliminó correctamente, false en caso contrario.
     */
    public static function deleteTask(int $id): bool
    {
        return self::destroy($id) ? true : false;
    }

    /**
     * Obtiene todas las tareas ordenadas por ID.
     *
     * @return Collection Colección de tareas ordenadas por ID.
     */
    public static function orderID(): Collection
    {
        $tasks = self::_allTasks();
        return $tasks->sortBy('id');
    }

    /**
     * Obtiene las tareas agrupadas por usuario y estado.
     *
     * @return array Array asociativo con las tareas agrupadas por usuario y estado.
     */
    public static function getTasksByUserAndStatus(): array
    {
        $allTasks = self::_allTasks();
        $groupedTasks = $allTasks->groupBy('user_name');

        $tasksByStatus = [];

        foreach ($groupedTasks as $userName => $tasks) {
            $pending = $tasks->where('status', 'n');
            $inProgress = $tasks->where('status', 's');

            if ($pending->isNotEmpty() || $inProgress->isNotEmpty()) {
                $tasksByStatus[$userName] = [
                    'pending' => $pending,
                    'in_progress' => $inProgress,
                ];
            }
        }

        return $tasksByStatus;
    }

    /**
     * Obtiene todas las tareas completadas.
     *
     * @return Collection Colección de tareas completadas.
     */
    public static function getTasksCompleted(): Collection
    {
        $allTasks = self::_allTasks();
        return $allTasks->where('status', 'f');
    }

    /**
     * Inicia una tarea por su ID.
     *
     * @param int $id El ID de la tarea a iniciar.
     *
     * @return bool True si la tarea se inició correctamente, false en caso contrario.
     */
    public static function startTask(int $id): bool
    {
        return self::where('id', $id)
            ->update(
                [
                    'status' => 's',
                    'start_date' => now(),
                ]
            );
    }

    /**
     * Finaliza una tarea por su ID.
     *
     * @param int $id El ID de la tarea a finalizar.
     *
     * @return bool True si la tarea se finalizó correctamente, false en caso contrario.
     */
    public static function endTask(int $id): bool
    {
        return self::where('id', $id)
            ->update(
                [
                    'status' => 'f',
                    'end_date' => now(),
                ]
            );
    }

    /**
     * Encuentra una tarea por su ID.
     *
     * @param int $id El ID de la tarea a encontrar.
     *
     * @return Task La tarea encontrada.
     */
    public static function findTask(int $id): Task
    {
        return self::find($id);
    }

    /**
     * Edita una tarea existente.
     *
     * @param array $data Datos de la tarea a editar.
     *
     * @return bool True si la tarea se editó correctamente, false en caso contrario.
     */
    public static function editTask($data): bool
    {
        $task = Task::findTask($data['taskId']);

        $dataUpdated = [];

        if (isset($data['taskDescription']) && $data['taskDescription'] != $task->description) {
            $dataUpdated['description'] = $data['taskDescription'];
        }

        if (isset($data['priority_id']) && $data['priority_id'] != $task->priority_id) {
            $dataUpdated['priority_id'] = $data['priority_id'];
        }

        if (isset($data['assignedUser']) && $data['assignedUser'] != $task->user_asigned) {
            $dataUpdated['user_asigned'] = $data['assignedUser'];
        }

        if (isset($data['resolutionDate']) && $data['resolutionDate'] != $task->resolution_date) {
            $dataUpdated['resolution_date'] = $data['resolutionDate'];
        }

        if (isset($data['status']) && $data['status'] != $task->status) {
            $dataUpdated['status'] = $data['status'];
        }

        $dataUpdated['end_date'] = $data['endDate'];
        $dataUpdated['start_date'] = $data['startDate'];

        if (!empty($dataUpdated)) {
            return self::where('id', $data['taskId'])
                ->update($dataUpdated);
        }

        return false;
    }
}