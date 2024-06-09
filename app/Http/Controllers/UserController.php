<?php

namespace App\Http\Controllers;

use App\Core\App;
use App\Core\Database;
use App\Core\Session;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController
{
    private Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function index()
    {
        $perPage = 10;
        $page = $_GET['page'] ?? 1;
        $search = $_GET['search'] ?? '';

        try {
            $query = 'SELECT id, username, email, role FROM users';
            $params = [];

            if ($search) {
                $query .= ' WHERE username LIKE ? OR email LIKE ?';
                $params[] = '%'.$search.'%';
                $params[] = '%'.$search.'%';
            }

            $query .= ' LIMIT ? OFFSET ?';
            $params[] = (int) $perPage;
            $params[] = (int) (($page - 1) * $perPage);

            $users = $this->db->query($query, $params)->get();

            // Count total users for pagination
            $countQuery = 'SELECT COUNT(*) as count FROM users';
            $countParams = [];
            if ($search) {
                $countQuery .= ' WHERE username LIKE ? OR email LIKE ?';
                $countParams[] = '%'.$search.'%';
                $countParams[] = '%'.$search.'%';
            }

            $totalUsers = $this->db->query($countQuery, $countParams)->find()['count'];
            $totalPages = ceil($totalUsers / $perPage);

            return view('users/index', [
                'users' => $users,
                'currentPage' => $page,
                'totalPages' => $totalPages,
                'search' => htmlspecialchars($search),
            ]);
        } catch (\Throwable $th) {
            abort(500, ['message' => $th->getMessage()]);
        }
    }

    public function create()
    {
        return view('users/create', ['errors' => Session::get('errors')]);
    }

    public function store()
    {
        $request = UserCreateRequest::validate(
            $attributes = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'role' => $_POST['role'],
            ]
        );

        try {
            $this->db->query(
                'INSERT INTO users (username, email, role, password) VALUES (:username, :email, :role, :password)',
                [
                    ':username' => $attributes['username'],
                    ':email' => $attributes['email'],
                    ':role' => $attributes['role'],
                    ':password' => password_hash('password', PASSWORD_BCRYPT),
                ]
            );
            redirect('/users');
        } catch (\Throwable $th) {
            abort(500, ['message' => $th->getMessage()]);
        }

    }

    public function show($id)
    {
        try {
            $user = $this->db->query(
                'SELECT id, username, email, role FROM users WHERE id = :id',
                [
                    ':id' => $id,
                ]
            )->find();

            if (! $user) {
                abort(404, ['message' => 'User not found.']);
            }

            return view('users/show', ['user' => $user]);
        } catch (\Throwable $th) {
            dd($th);
            abort(500, ['message' => $th->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $user = $this->db->query(
                'SELECT id, username, email, role FROM users WHERE id = :id',
                [
                    ':id' => $id,
                ]
            )->find();

            if (! $user) {
                abort(404, ['message' => 'User not found.']);
            }

            return view('users/edit', ['user' => $user, 'errors' => Session::get('errors')]);
        } catch (\Throwable $th) {
            abort(500, ['message' => $th->getMessage()]);
        }
    }

    public function update($id)
    {
        $request = UserUpdateRequest::validate(
            $attributes = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'role' => $_POST['role'],
            ],
            $id
        );

        try {
            $this->db->query(
                'UPDATE users SET username = :username, email = :email, role = :role, updated_at = NOW() WHERE id = :id',
                [
                    ':username' => $attributes['username'],
                    ':email' => $attributes['email'],
                    ':role' => $attributes['role'],
                    'id' => $id,
                ]
            );
            redirect('/users');
        } catch (\Throwable $th) {
            abort(500, ['message' => $th->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            $user = $this->db->query(
                'DELETE FROM users WHERE id = :id',
                [
                    ':id' => $id,
                ]
            );

            if (! $user) {
                abort(404, ['message' => 'User not found.']);
            }

            redirect('/users');
        } catch (\Throwable $th) {
            dd($th);
            abort(500, ['message' => $th->getMessage()]);
        }
    }
}
