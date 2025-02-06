<?php
session_start();

require_once ('../core/BaseController.php');
require_once '../core/Router.php';
require_once '../core/Route.php';
require_once '../app/controllers/HomeController.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/AdminController.php';
require_once '../app/controllers/ApprenantController.php';
require_once '../app/config/db.php';


$router = new Router();
Route::setRouter($router);

// Home Routes

Route::get('/', [HomeController::class, 'showHome']);
Route::get('/courses', [HomeController::class, 'ShowCours']);
Route::post("/details" , [HomeController::class, 'coursDetails']);
Route::post("/enrollement" , [HomeController::class, 'coursEroll']);
Route::get("/mescours" , [HomeController::class, 'mesCours']);
Route::post("/cours_content" , [HomeController::class, 'coursContent']);

// auth routes 
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'handleRegister']);
Route::get('/login', [AuthController::class, 'showleLogin']);
Route::post('/login', [AuthController::class, 'handleLogin']);
Route::post('/logout', [AuthController::class, 'logout']);

// Admin Routes 

Route::get('/dashboard', [AdminController::class, 'showDashboard']);
Route::get('/dashboard/users', [AdminController::class, 'showUsers']);
Route::get('/dashboard/sujet', [AdminController::class, 'showSujet']);
Route::get('/dashboard/presentations', [AdminController::class, 'showPresentations']);
Route::get('/dashboard/tags', [AdminController::class, 'showTags']);

Route::post('/delete-user', [AdminController::class, 'deleteUser']);
Route::post('/update-status', [AdminController::class, 'updateUserStatus']);
Route::post('/add-category', [AdminController::class, 'addCategory']);
Route::post('/delete-category', [AdminController::class, 'deleteCategory']);
Route::post('/add-tag', [AdminController::class, 'addTag']);
Route::post('/delete-tag', [AdminController::class, 'deleteTag']);

// Ajout des nouvelles routes pour la gestion des sujets
Route::post('/update-sujet-status', [AdminController::class, 'updateSujetStatus']);
Route::post('/delete-sujet', [AdminController::class, 'deleteSujet']);

// Etudiant Routes ---------------------------- 

Route::get('/dashboard/etudiant' , [ApprenantController::class , "showTeacherDashboard"]);
Route::get('/dashboard/etudiant/sujet' , [ApprenantController::class , "showEtudiantSujet"]);
Route::post('/add-sujet', [ApprenantController::class, 'addSujet']);
Route::post('/delete-sujet', [ApprenantController::class, 'deleteSujet']);
Route::post('/dashboard/teacher/cours/add-cours', [ApprenantController::class, 'addCours']);
Route::post('/dashboard/teacher/cours/delete', [ApprenantController::class, 'deleteCours']);
Route::post('/dashboard/teacher/cours/edit', [ApprenantController::class, 'editCours']);
Route::post('/dashboard/teacher/cours/update', [ApprenantController::class, 'updateCours']);
Route::get('/dashboard/teacher/etudiants', [ApprenantController::class, 'showTeacherEtudiant']);

// ... existing routes ...
Route::post('/assign-students', [AdminController::class, 'assignStudentsToSujet']);

//Route::post('/logout', [AuthController::class, 'logout']);

// admin routers

// Route::get('/admin', [AdminController::class, 'index']);
// Route::get('/admin/users', [AdminController::class, 'handleUsers']);
// Route::get('/admin/categories', [AdminController::class, 'categories']);
// Route::get('/admin/testimonials', [AdminController::class, 'testimonials']);
// Route::get('/admin/projects', [AdminController::class, 'projects']);



// end admin routes 

// client Routes 
// Route::get('/client/dashboard', [ClientController::class, 'index']);



// Dispatch the request
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);





