<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Task;

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
| The web.php file contains the routes that define the URLs and their
| corresponding callback functions or closures. These routes determine how
| the application responds to incoming requests.
|
| Previously, there was a "Task" class defined in the application, which
| served as the model for the task list app. However, it has been removed,
| and now the tasks are loaded from a MySQL database using the Task model.
| This model interacts with the database to provide the task-related
| functionality.
|
| The routes have been updated accordingly. The 'tasks.index' route now
| retrieves the tasks from the database using the `latest()->get()` method
| and passes them to the 'index' view.
|
| Similarly, the 'tasks.show' route fetches a specific task from the
| database using the `findOrFail($id)` method and passes it to the 'show'
| view.
|
| The routes establish relationships between URLs and views, connecting the
| requested URLs with the appropriate Blade views. By returning a view from
| a route, dynamic HTML can be rendered using the Blade templating engine,
| where we can access and display the task data.
|
| The main purpose of the code in web.php is to define the routes that
| determine how the application handles certain URLs, retrieves the required
| task data from the MySQL database using the Task model, performs any
| necessary logic, and returns the appropriate views or responses to the
| user.
|
| As the application evolves and introduces more features, these routes
| may be expanded or modified to accommodate new functionality or interact
| with additional models and database tables.
|
*/

/*
|--------------------------------------------------------------------------
| Route definition for the home page
|--------------------------------------------------------------------------
|
| Defines the route '/' with a callback function that returns the 'index'
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
| Defines the route '/tasks' with a callback function that returns the
| 'index' view and passes an array containing the 'tasks' variable obtained
| from the Task model. This enables us to load the task data from the MySQL
| database and pass it to the Blade view.
|
*/

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->get()
    ]);
})->name('tasks.index');

/*
|--------------------------------------------------------------------------
| Route definition for the create task page
|--------------------------------------------------------------------------
|
| Defines the route '/tasks/create' with the view method and the 'create'
| parameter. This returns the 'create' view, which displays the form for
| creating a new task. This route is named 'tasks.create' for convenience
| and consistency.
|
*/

Route::view('/tasks/create', 'create')
    ->name('tasks.create');

/*
|--------------------------------------------------------------------------
| Route definition for showing a specific task
|--------------------------------------------------------------------------
|
| This route defines a URL pattern '/tasks/{id}' that maps to a callback
| function. The callback function retrieves a specific task from the
| database using the provided 'id' parameter. If the task is not found,
| it returns a 404 page. Otherwise, it returns the 'show' view and passes
| the retrieved task as a variable.
|
*/

Route::get('/tasks/{id}', function ($id) {
    return view('show', [
        'task' => Task::findOrFail($id)
    ]);
})->name('tasks.show');


/*
|--------------------------------------------------------------------------
| Route definition for creating a new task and storing it in the database
|--------------------------------------------------------------------------
|
| Defines the route '/tasks' with the POST method and a callback function
| that validates the request data, creates a new task using the Task model,
| and redirects to the 'tasks.show' route with the 'id' parameter.
| This enables us to store a new task in the database and display it on the
| web page.
|
*/

Route::post('/tasks', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();

    return redirect()->route('tasks.show', ['id' => $task->id])
        ->with('success', 'Task create successfully!');
})->name('tasks.store');

/*
|--------------------------------------------------------------------------
| Route definition for displaying a simple greeting
|--------------------------------------------------------------------------
|
| This route responds to the '/xxx' URL and returns a simple greeting text.
|
*/

// Route::get('/xxx', function () {
//     return 'Hello';
// })->name('hello');

/*
|--------------------------------------------------------------------------
| Route definition for redirecting to the 'hello' route
|--------------------------------------------------------------------------
|
| This route responds to the '/hallo' URL and redirects to the 'hello' route,
| which is defined above.
|
*/

// Route::get('/hallo', function () {
//     return redirect()->route('hello');
// });

/*
|--------------------------------------------------------------------------
| Route definition for greeting a specific name
|--------------------------------------------------------------------------
|
| This route responds to the '/greet/{name}' URL pattern and returns a 
| personalized greeting using the provided 'name' parameter.
|
*/

// Route::get('/greet/{name}', function ($name) {
//     return 'Hello ' . $name . '!';
// });

/*
|--------------------------------------------------------------------------
| Fallback route definition
|--------------------------------------------------------------------------
|
| This route is a fallback for any routes that are not defined in the
| application. It will be triggered when no other routes match the
| requested URL. It returns a generic "Still got somewhere!" message.
|
*/

Route::fallback(function () {
    return 'Still got somewhere!';
});
