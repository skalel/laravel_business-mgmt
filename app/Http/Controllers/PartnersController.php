<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Partners;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PartnersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $partners = Partners::sortable()->paginate(30);

      foreach ($partners as $partner) {
        $partner['client_supplier'] === 'C' ? $partner['client_supplier'] = 'Cliente' : $partner['client_supplier'] = 'Fornecedor';
      }

      return view('partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try {
        $request['telephone'] = str_replace([' ', '-', '(', ')'], '', $request['telephone']);
        $request['cgccpf'] = str_replace(['.', '-', '/'], '', $request['cgccpf']);
        $request['cnpj'] = str_replace(['.', '-', '/'], '', $request['cnpj']);
        $request['client_supplier'] === 'client' ? $request['cnpj'] = null : $request['cgccpf'] = $request['cnpj'];
        $request['client_supplier'] === 'client' ? $request['client_supplier'] = 'C' : $request['client_supplier'] = 'S';

        $validatedData = $request->validate([
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255'],
          'telephone' => ['nullable', 'min:10', 'max:13'],
          'client_supplier' => ['required', Rule::in(['C', 'S'])],
          'cgccpf' => ['required', 'string', 'min:11', 'max:14', 'unique:partners,cgccpf'],
          'cnpj' => ['nullable', 'string', 'max:14'],
          'opening_date' => ['nullable', 'date'],
          'birthdate' => ['nullable', 'date'],
          'address' => ['nullable', 'string'],
        ], [
          'name.required' => 'O campo Nome é obrigatório.',
          'name.string' => 'O campo Nome deve ser uma string.',
          'name.max' => 'O campo Nome não pode ter mais de :max caracteres.',
          'email.required' => 'O campo E-mail é obrigatório.',
          'email.string' => 'O campo E-mail deve ser uma string.',
          'email.email' => 'O campo E-mail deve ser um endereço de e-mail válido.',
          'telephone.min' => 'O campo Telefone deve ter no mínimo :min caracteres.',
          'telephone.max' => 'O campo Telefone não pode ter mais de :max caracteres.',
          'client_supplier.required' => 'O campo Cliente/Fornecedor é obrigatório.',
          'client_supplier.in' => 'O campo Cliente/Fornecedor deve ser "Cliente" ou "Fornecedor".',
          'cgccpf.required' => 'O campo CPF/CNPJ é obrigatório.',
          'cgccpf.string' => 'O campo CPF/CNPJ deve ser uma string.',
          'cgccpf.min' => 'O campo CPF/CNPJ deve ter no mínimo :min caracteres.',
          'cgccpf.max' => 'O campo CPF/CNPJ não pode ter mais de :max caracteres.',
          'cgccpf.unique' => 'O CPF/CNPJ informado já está em uso.',
          'cnpj.max' => 'O campo CNPJ não pode ter mais de :max caracteres.',
          'opening_date.date' => 'O campo Data de Abertura deve ser uma data válida.',
          'birthdate.date' => 'O campo Data de Nascimento deve ser uma data válida.',
          'address.string' => 'O campo Endereço deve ser uma string.',
        ]);
        try {
          $result = Partners::create($validatedData);
        } catch (\Throwable $th) {
          return redirect()->route('partner.index')->with([
            'message' => 'Não foi possível cadastrar o Parceiro.',
            'type' => 'error'
          ]);
        }
        return redirect()->route('partner.index')->with([
          'message' => 'Parceiro cadastrado com sucesso.',
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

        return redirect()->route('partner.index')->with([
            'message' => 'Não foi possível cadastrar o Parceiro.',
            'valerrors' => $allErrors,
            'type' => 'error',
        ]);
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $partner = Partners::find($id);

      $partner->selectedOption = $partner['client_supplier'] === 'C' ? 'client' : 'supplier';
      $partner['client_supplier'] === 'C' ? $partner['client_supplier'] = 'Cliente' : $partner['client_supplier'] = 'Fornecedor';

      return view('partners.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $partner = Partners::find($id);

      $partner->selectedOption = $partner['client_supplier'] === 'C' ? 'client' : 'supplier';
      $partner['client_supplier'] === 'C' ? $partner['client_supplier'] = 'Cliente' : $partner['client_supplier'] = 'Fornecedor';

      return view('partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      try {
        $request['telephone'] = str_replace([' ', '-', '(', ')'], '', $request['telephone']);
        $request['cgccpf'] = str_replace(['.', '-', '/'], '', $request['cgccpf']);
        $request['cnpj'] = str_replace(['.', '-', '/'], '', $request['cnpj']);
        $request['client_supplier'] === 'client' ? $request['cnpj'] = null : $request['cgccpf'] = $request['cnpj'];
        $request['client_supplier'] === 'client' ? $request['client_supplier'] = 'C' : $request['client_supplier'] = 'S';
        $request['client_supplier'] === 'client' ? $request['opening_date'] = null : $request['birthdate'] = null;

        $validatedData = $request->validate([
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255'],
          'telephone' => ['nullable', 'min:10', 'max:13'],
          'client_supplier' => ['required', Rule::in(['C', 'S'])],
          'cgccpf' => ['required', 'string', 'min:11', 'max:14', 'unique:partners,cgccpf'],
          'cnpj' => ['nullable', 'string', 'max:14'],
          'opening_date' => ['nullable', 'date'],
          'birthdate' => ['nullable', 'date'],
          'address' => ['nullable', 'string'],
        ], [
          'name.required' => 'O campo Nome é obrigatório.',
          'name.string' => 'O campo Nome deve ser uma string.',
          'name.max' => 'O campo Nome não pode ter mais de :max caracteres.',
          'email.required' => 'O campo E-mail é obrigatório.',
          'email.string' => 'O campo E-mail deve ser uma string.',
          'email.email' => 'O campo E-mail deve ser um endereço de e-mail válido.',
          'telephone.min' => 'O campo Telefone deve ter no mínimo :min caracteres.',
          'telephone.max' => 'O campo Telefone não pode ter mais de :max caracteres.',
          'client_supplier.required' => 'O campo Cliente/Fornecedor é obrigatório.',
          'client_supplier.in' => 'O campo Cliente/Fornecedor deve ser "Cliente" ou "Fornecedor".',
          'cgccpf.required' => 'O campo CPF/CNPJ é obrigatório.',
          'cgccpf.string' => 'O campo CPF/CNPJ deve ser uma string.',
          'cgccpf.min' => 'O campo CPF/CNPJ deve ter no mínimo :min caracteres.',
          'cgccpf.max' => 'O campo CPF/CNPJ não pode ter mais de :max caracteres.',
          'cgccpf.unique' => 'O CPF/CNPJ informado já está em uso.',
          'cnpj.max' => 'O campo CNPJ não pode ter mais de :max caracteres.',
          'opening_date.date' => 'O campo Data de Abertura deve ser uma data válida.',
          'birthdate.date' => 'O campo Data de Nascimento deve ser uma data válida.',
          'address.string' => 'O campo Endereço deve ser uma string.',
        ]);
        try {
          $original = Partners::find($id);

          $original ? '' : throw new Exception("Parceiro não encontrado", 1);

          $original->name = $validatedData['name'];
          $original->email = $validatedData['email'];
          $original->telephone = $validatedData['telephone'];
          $original->client_supplier = $validatedData['client_supplier'];
          $original->cgccpf = $validatedData['cgccpf'];
          $original->birthdate = $validatedData['birthdate'];
          $original->opening_date = $validatedData['opening_date'];
          $original->address = $validatedData['address'];

          $original->save();
        } catch (\Throwable $th) {
          return redirect()->route('partner.index')->with([
            'message' => 'Não foi possível editar o Parceiro.',
            'type' => 'error'
          ]);
        }
        return redirect()->route('partner.index')->with([
          'message' => 'Parceiro editado com sucesso.',
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

        return redirect()->route('partner.index')->with([
            'message' => 'Não foi possível editar o Parceiro.',
            'valerrors' => $allErrors,
            'type' => 'error',
        ]);
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      try {
        $data = Partners::find($id);
        $data ? '' : throw new Exception("Parceiro não encontrado", 1);

        if(!auth()->user()->role === 'ADMIN' OR auth()->user()->id !== $data->created_by){
          return redirect()->route('partner.index')->with([
            'message' => 'Não foi possível excluir o Parceiro. Contate algum administrador.',
            'type' => 'error'
          ]);
        }
        try {
          Partners::destroy($id);
        } catch (\Throwable $th) {
          return redirect()->route('partner.index')->with([
            'message' => 'Ocorreu um erro, contate o desenvolvedor.',
            'type' => 'error'
          ]);
        }
        return redirect()->route('partner.index')->with([
          'message' => 'Parceiro excluído com sucesso.',
          'type' => 'success'
        ]);
      } catch (\Throwable $th) {
        return redirect()->route('partner.index')->with([
          'message' => 'Não foi possível encontrar o Parceiro.',
          'type' => 'error'
        ]);
      }
    }
}
