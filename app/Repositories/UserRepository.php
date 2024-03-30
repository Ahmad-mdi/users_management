<?php
namespace App\Repositories;
use App\Models\User;
use Illuminate\Http\Request;

interface UserRepository {
    public function getAll();
    public function addUser(Request $request);
    public function findByUsername(Request $request);
}
