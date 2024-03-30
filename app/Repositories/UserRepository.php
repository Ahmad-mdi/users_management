<?php
namespace App\Repositories;
use Illuminate\Http\Request;

interface UserRepository {
    public function getAll();
    public function addUser(Request $request);
}
