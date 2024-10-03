<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use NumberFormatter;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
  public function index()
  {
    $users = User::paginate(20);

    return view('admin-users', compact('users'));
  }

  public function store(Request $request)
  {
    try {
      $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', Rules\Password::defaults()],
        'role' => ['required', Rule::in(['ADMIN', 'USER', 'GUEST'])],
      ], [
        'name.required' => 'O campo nome é obrigatório.',
        'name.string' => 'O campo nome deve ser uma string.',
        'name.max' => 'O campo nome não pode ter mais de 255 caracteres.',
        'email.required' => 'O campo e-mail é obrigatório.',
        'email.string' => 'O campo e-mail deve ser uma string.',
        'email.email' => 'Por favor, insira um endereço de e-mail válido.',
        'email.max' => 'O campo e-mail não pode ter mais de 255 caracteres.',
        'email.unique' => 'Este e-mail já está em uso.',
        'password.required' => 'O campo senha é obrigatório.',
        'role.required' => 'O campo cargo é obrigatório.',
        'role.in' => 'O campo cargo deve ser Administrador, Convidado ou Usuário.',
      ]);
      try {
        $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'role' => $request->role,
          'password' => Hash::make($request->password),
          'email_verified_at' => now(),
          'approved_at' => now(),
        ]);
      } catch (\Throwable $th) {
        throw $th;
        return redirect()->route('admin.users.index')->with([
          'message' => 'Não foi possível cadastrar o usuário.',
          'type' => 'error'
        ]);
      }
      return redirect()->route('admin.users.index')->with([
        'message' => 'Usuário cadastrado!',
        'type' => 'success'
      ]);
    } catch (ValidationException $e) {
      $errors = $e->errors();

      $allErrors = [];
      foreach ($errors as $fieldErrors) {
        $allErrors = array_merge($allErrors, $fieldErrors);
      }

      $allErrors = array_map(function($error) {
        return ' - ' . $error;
      }, $allErrors);

      return redirect()->route('admin.users.index')->with([
        'message' => 'Não foi possível criar o usuário.',
        'valerrors' => $allErrors,
        'type' => 'error',
      ]);
    }
  }

  public function approve($user_id)
  {
    $user = User::findOrFail($user_id);
    $user->update(['approved_at' => now()]);

    return redirect()->route('admin.users.index')->with([
      'message' => 'Usuário aprovado com sucesso.',
      'type' => 'success'
    ]);
  }
}
