<?php
session_start();

require_once ('../core/BaseController.php');
require_once ('../core/Mailer.php');
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
Route::get('/calendrier', [HomeController::class, 'showCalendrier']);

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
Route::get('/dashboard/Calendrier', [AdminController::class, 'showCalendrier']);

Route::post('/delete-user', [AdminController::class, 'deleteUser']);
Route::post('/update-status', [AdminController::class, 'updateUserStatus']);
Route::post('/update-sujet-status', [AdminController::class, 'updateSujetStatus']);
Route::post('/delete-sujet', [AdminController::class, 'deleteSujet']);
Route::post('/assign-students', [AdminController::class, 'assignStudentsToSujet']);
Route::get('/get-presentations', [AdminController::class, 'getPresentations']);
Route::post('/save-presentation', [AdminController::class, 'savePresentation']);
Route::post('/update-presentation-date', [AdminController::class, 'updatePresentationDate']);
Route::post('/update-presentation-status', [AdminController::class, 'updatePresentationStatus']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Etudiant Routes ---------------------------- 

Route::get('/dashboard/etudiant' , [ApprenantController::class , "showTeacherDashboard"]);
Route::get('/dashboard/etudiant/sujet' , [ApprenantController::class , "showEtudiantSujet"]);
Route::get('/dashboard/etudiant/calendrier' , [ApprenantController::class , "showEtudiantCalendrier"]);
Route::get('/dashboard/etudiant/presentation' , [ApprenantController::class , "showEtudiantPresentation"]);
Route::post('/add-sujet', [ApprenantController::class, 'addSujet']);
Route::post('/delete-sujet', [ApprenantController::class, 'deleteSujet']);
Route::get('/get-student-presentations', [ApprenantController::class, 'getStudentPresentations']);
Route::get('/reset-password', [AuthController::class, 'showResetPassword']);    
// Dispatch the request
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);







