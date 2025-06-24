<?php

/**
 * Rutas para la aplicación de gestión de tareas.
 *
 * Este archivo define las rutas para la aplicación, incluyendo rutas para la vista principal,
 * el panel de administración, el panel de usuario, el historial de tareas y las operaciones CRUD.
 *
 * @category Routes
 * @package  App\Routes
 * @author   Tu Nombre <tu.email@example.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://example.com/docs/routes
 */

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

Route::get(
    '/',
    function (): View {
        return view('home');
    }
)->name('home');

Route::get(
    '/admin',
    function (): View {
        return TaskController::listTaskAdmin();
    }
)->name('admin');

Route::get(
    '/user',
    function (): View {
        return TaskController::listTaskUser();
    }
)->name('user');

Route::get(
    '/history',
    function (): View {
        return TaskController::listTaskHistoy();
    }
)->name('history');

Route::post(
    '/addTask',
    function (): RedirectResponse {
        return TaskController::addTask();
    }
)->name('addTask');

Route::post(
    '/editTask',
    function (): RedirectResponse {
        return TaskController::editTask();
    }
)->name('editTask');

Route::get(
    '/deleteTask/{id}',
    function (int $id): RedirectResponse {
        return TaskController::deleteTask($id);
    }
)->name('deleteTask');

Route::get(
    '/startTask/{id}',
    function (int $id): RedirectResponse {
        return TaskController::startTask($id);
    }
)->name('startTask');

Route::get(
    '/endTask/{id}',
    function (int $id): RedirectResponse {
        return TaskController::endTask($id);
    }
)->name('endTask');