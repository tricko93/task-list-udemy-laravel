<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
 |--------------------------------------------------------------------------
 | Code Explanation
 |--------------------------------------------------------------------------
 |
 | There is a "Task" class - which defines the class for the task list app.
 |
 | Additionally, we have created an object called "$tasks" that contains an
 | array of task objects. This serves as a temporary simulation of working
 | with a database model until we integrate a real database into the project.
 |
 | So we would like to pass this data to Blade Views so we can learn something
 | about Blade without having to introduce database concepts.
 |
 */

class Task
{
  public function __construct(
    public int $id,
    public string $title,
    public string $description,
    public ?string $long_description,
    public bool $completed,
    public string $created_at,
    public string $updated_at
  ) {
  }
}

$tasks = [
  new Task(
    1,
    'Buy groceries',
    'Task 1 description',
    'Task 1 long description',
    false,
    '2023-03-01 12:00:00',
    '2023-03-01 12:00:00'
  ),
  new Task(
    2,
    'Sell old stuff',
    'Task 2 description',
    null,
    false,
    '2023-03-02 12:00:00',
    '2023-03-02 12:00:00'
  ),
  new Task(
    3,
    'Learn programming',
    'Task 3 description',
    'Task 3 long description',
    true,
    '2023-03-03 12:00:00',
    '2023-03-03 12:00:00'
  ),
  new Task(
    4,
    'Take dogs for a walk',
    'Task 4 description',
    null,
    false,
    '2023-03-04 12:00:00',
    '2023-03-04 12:00:00'
  ),
];

/*
|--------------------------------------------------------------------------
| Route definition for the home page
|--------------------------------------------------------------------------
|
| Defines the route '/' with callback function that returns the 'index'
| view.
|
*/

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

/*
|--------------------------------------------------------------------------
| Route definition for the tasks page
|--------------------------------------------------------------------------
|
| Defines the route '/tasks' with callback function that returns the
| 'index' view and passes an array containing the 'tasks' variable obtained
| from the $tasks array passed as a parameter to the closure. This enables
| us to pass the task data to the Blade view.
|
*/

Route::get('/tasks', function () use($tasks) {
    return view('index', [
        'tasks' => $tasks
    ]);
})->name('tasks.index');

/*
|--------------------------------------------------------------------------
| Route definition for displaying a single task
|--------------------------------------------------------------------------
|
| Defines a route with a parameterized URL pattern '/tasks/{id}' that
| points to a callback function. The callback function returns the string
| 'One single task'. The 'name' method is used to give the route a name
| 'task.show', which can be referenced elsewhere in the application.
|
*/

Route::get('/tasks/{id}', function ($id) {
  return 'One single task';
})->name('tasks.show');

// Route::get('/xxx', function () {
//     return 'Hello';
// })->name('hello');

// Route::get('/hallo', function () {
//     return redirect()->route('hello');
// });

// Route::get('/greet/{name}', function ($name) {
//     return 'Hello ' . $name . '!';
// });

Route::fallback(function () {
    return 'Still got somewhere!';
});
