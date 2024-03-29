<?php
namespace App\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

interface UserService {
    public function getAll();
    public function addUser(Request $request);
}
