<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacultyController;
use App\Models\CloudinaryUpload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return Auth::user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/upload', function (Request $request) {
    $file = $request->file;
    if (!$file->isValid()) return response()->json(['message' => 'Empty file!']);

    $getClientOriginalName = $file->getClientOriginalName();
    $getClientOriginalExtension = $file->getClientOriginalExtension();
    $getClientMimeType = $file->getClientMimeType();

    $result = $file->storeOnCloudinaryAs('upload', $getClientOriginalName);

    $data = CloudinaryUpload::create([
        'getPath' => $result->getPath(),
        'getSecurePath' => $result->getSecurePath(),
        'getSize' => $result->getSize(),
        'getReadableSize' => $result->getReadableSize(),
        'getFileType' => $result->getFileType(),
        'getFileName' => $result->getFileName(),
        'getOriginalFileName' => $result->getOriginalFileName(),
        'getPublicId' => $result->getPublicId(),
        'getExtension' => $result->getExtension(),
        'getWidth' => $result->getWidth(),
        'getHeight' => $result->getHeight(),
    ]);

    $data->getClientOriginalName = $getClientOriginalName;
    $data->getClientOriginalExtension = $getClientOriginalExtension;
    $data->getClientMimeType = $getClientMimeType;
    $data->save();

    return response()->json([
        'message' => 'Uploaded!',
        'data' => $data,
    ]);
});

Route::prefix('departments')->group(function () {
    Route::get('/', [DepartmentController::class, 'index']);
    // Route::get('/new', [DepartmentController::class, 'create']);
    Route::post('/', [DepartmentController::class, 'store']);
    Route::get('/{department}', [DepartmentController::class, 'show']);
    // Route::get('/{department}/edit', [DepartmentController::class, 'edit']);
    Route::match(['post','put', 'patch'], '/{department}', [DepartmentController::class, 'update']);
    Route::delete('/{department}', [DepartmentController::class, 'destroy']);
});

Route::prefix('faculties')->group(function () {
    Route::get('/', [FacultyController::class, 'index']);
    // Route::get('/new', [FacultyController::class, 'create']);
    Route::post('/', [FacultyController::class, 'store']);
    Route::get('/{faculty}', [FacultyController::class, 'show']);
    // Route::get('/{faculty}/edit', [FacultyController::class, 'edit']);
    Route::match(['post','put', 'patch'], '/{faculty}', [FacultyController::class, 'update']);
    Route::delete('/{faculty}', [FacultyController::class, 'destroy']);
});

Route::prefix('doctors')->group(function () {
    Route::get('/', [DoctorController::class, 'index']);
    // Route::get('/new', [DoctorController::class, 'create']);
    Route::post('/', [DoctorController::class, 'store']);
    Route::get('/{doctor}', [DoctorController::class, 'show']);
    // Route::get('/{doctor}/edit', [DoctorController::class, 'edit']);
    Route::match(['post','put', 'patch'], '/{doctor}', [DoctorController::class, 'update']);
    Route::delete('/{doctor}', [DoctorController::class, 'destroy']);
});

