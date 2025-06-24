<?php

/**
 * Controlador para la gestión de tareas.
 *
 * Este controlador maneja las operaciones relacionadas con las tareas, incluyendo la visualización,
 * creación, edición y eliminación de tareas.
 *
 * @category Controllers
 * @package  App\Http\Controllers
 * @author   Tu Nombre <tu.email@example.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://example.com/docs/task-controller
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Users;
use App\Models\Priority;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/**
 * Controlador para la gestión de tareas.
 *
 * Este controlador maneja las operaciones relacionadas con las tareas, incluyendo la visualización,
 * creación, edición y eliminación de tareas.
 *
 * @category Controllers
 * @package  App\Http\Controllers
 * @author   Tu Nombre <tu.email@example.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://example.com/docs/task-controller
 */
class TaskController extends Controller
{
    /**
     * Lista todas las tareas para el panel de administración.
     *
     * Obtiene todas las tareas, prioridades y usuarios, y las pasa a la vista del panel de administración.
     *
     * @return View La vista del panel de administración con las tareas, prioridades y usuarios.
     */
    public static function listTaskAdmin(): View
    {
        $priority = Priority::allPriorities();
        $users = Users::allUsers();

        $allTasks = Task::orderID();

        return view('adminPanel.admin')->with('allTasks', $allTasks)
            ->with('priority', $priority)
            ->with('users', $users);
    }

    /**
     * Lista las tareas asignadas al usuario actual y su estado.
     *
     * Obtiene las tareas por usuario y estado, prioridades y usuarios, y las pasa a la vista del panel de usuario.
     *
     * @return View La vista del panel de usuario con las tareas, prioridades y usuarios.
     */
    public static function listTaskUser(): View
    {
        $priority = Priority::allPriorities();
        $users = Users::allUsers();

        $tasksByStatus = Task::getTasksByUserAndStatus();

        return view('userPanel.user')->with('tasksByStatus', $tasksByStatus)
            ->with('priority', $priority)
            ->with('users', $users);
    }

    /**
     * Lista el historial de tareas completadas.
     *
     * Obtiene las tareas completadas, prioridades y usuarios, y las pasa a la vista del historial.
     *
     * @return View La vista del historial con las tareas completadas, prioridades y usuarios.
     */
    public static function listTaskHistoy(): View
    {
        $priority = Priority::allPriorities();
        $users = Users::allUsers();

        $tasksCompleted = Task::getTasksCompleted();

        return view('historic.history')->with('tasksCompleted', $tasksCompleted)
            ->with('priority', $priority)
            ->with('users', $users);
    }

    /**
     * Agrega una nueva tarea.
     *
     * Valida los datos de la solicitud y crea una nueva tarea. Redirige al panel de administración con un mensaje de éxito o error.
     *
     * @return RedirectResponse Redirige al panel de administración.
     */
    public static function addTask(): RedirectResponse
    {
        $request = request();

        $validated = $request->validate(
            [
                'taskName' => 'required|string',
                'taskDescription' => 'required|string',
                'priority_id' => 'required|integer|exists:priorities,id',
                'assignedUser' => 'required|integer|exists:users,id',
                'resolutionDate' => 'required|date',
            ]
        );

        $task = Task::addTask($validated);

        if ($task) {
            return redirect()->route('admin')->with('success', 'Task added successfully');
        }

        return redirect()->route('admin')->with('error', 'Error adding task!');
    }

    /**
     * Edita una tarea existente.
     *
     * Valida los datos de la solicitud y actualiza la tarea. Redirige al panel de administración con un mensaje de éxito o error.
     *
     * @return RedirectResponse Redirige al panel de administración.
     */
    public static function editTask(): RedirectResponse
    {
        $request = request();

        $validate = self::validateData($request);

        $editedTask = Task::editTask($validate);

        if ($editedTask) {
            return redirect()->route('admin')->with('success', 'Task updated successfully!');
        } else {
            return redirect()->route('admin')->with('error', 'Task update failed!');
        }
    }

    /**
     * Valida los datos de la solicitud para la edición de tareas.
     *
     * @param Request $request La solicitud HTTP.
     * @return array Los datos validados.
     */
    private static function validateData($request): array
    {
        $validate = $request->validate(
            [
                'taskId' => 'required|integer',
                'taskDescription' => 'required|string',
                'assignedUser' => 'required|integer',
                'priority_id' => 'required|integer',
                'resolutionDate' => 'required|date',
                'status' => 'required|string|in:n,s,f',
            ]
        );

        $validate['startDate'] = $validate['status'] == 's' ? now() : ($validate['status'] == 'f' ? now() : null);

        $validate['endDate'] = $validate['status'] == 'f' ? now() : null;

        return $validate;
    }

    /**
     * Elimina una tarea por su ID.
     *
     * @param int $id El ID de la tarea a eliminar.
     * @return RedirectResponse Redirige al panel de administración con un mensaje de éxito o error.
     */
    public static function deleteTask($id): RedirectResponse
    {
        $task = Task::deleteTask($id);

        if ($task) {
            return redirect()->route('admin')->with('success', 'Task deleted successfully');
        }

        return redirect()->route('admin')->with('error', 'Error deleting task');
    }

    /**
     * Inicia una tarea por su ID.
     *
     * @param int $id El ID de la tarea a iniciar.
     * @return RedirectResponse Redirige al panel de usuario con un mensaje de éxito o error.
     */
    public static function startTask(int $id): RedirectResponse
    {
        $task = Task::startTask($id);

        if ($task) {
            return redirect()->route('user')->with('success', 'Task started successfully');
        }

        return redirect()->route('user')->with('error', 'Error starting task');
    }

    /**
     * Finaliza una tarea por su ID.
     *
     * @param int $id El ID de la tarea a finalizar.
     * @return RedirectResponse Redirige al panel de usuario con un mensaje de éxito o error.
     */
    public static function endTask(int $id): RedirectResponse
    {
        $task = Task::endTask($id);

        if ($task) {
            return redirect()->route('user')->with('success', 'Task finished successfully');
        }

        return redirect()->route('user')->with('error', 'Error finishing task');
    }
}