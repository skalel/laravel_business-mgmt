<?php

namespace App\Http\Controllers;

use App\Models\Finances;

use Illuminate\View\View;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

use Illuminate\Validation\ValidationException;
use NumberFormatter;

class CashflowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $finances = Finances::sortable()->paginate(20);

      $formatter = new NumberFormatter('pt-BR', NumberFormatter::CURRENCY);

      foreach ($finances as $finance) {
        $finance->type = ($finance->type === 'IN') ? 'Entrada' : 'Saída';
        $finance['entry_value'] = $formatter->format($finance['entry_value']);
      }

      return view('finances.cashflow', compact('finances'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try{
      $request['entry_value'] = floatval(str_replace(['.', ','], ['', '.'], $request['entry_value']));
      $validatedData = $request->validate([
        'type' => ['required', Rule::in(['in', 'out'])],
        'info' => 'required|string|max:255',
        'entry_value' => 'required|numeric|between:0,9999999999.99',
      ], [
        'type.required' => 'O campo Tipo é obrigatório.',
        'type.in' => 'O campo Tipo deve ser Entrada ou Saída.',
        'info.required' => 'O campo Observações é obrigatório.',
        'info.string' => 'O campo Observações deve ser uma string.',
        'info.max' => 'O campo Observações não pode exceder 255 caracteres.',
        'entry_value.required' => 'O campo Valor é obrigatório.',
        'entry_value.numeric' => 'O campo Valor deve ser um número.',
        'entry_value.between' => 'O campo Valor deve estar entre 0 e 9999999999.99.',
      ]);
      try {
        $result = Finances::create($validatedData);
      } catch (\Throwable $th) {
        return redirect()->route('cashflow.index')->with([
          'message' => 'Não foi possível criar seu lançamento.',
          'type' => 'error'
        ]);
      }
      return redirect()->route('cashflow.index')->with([
        'message' => 'Lançamento criado com sucesso.',
        'type' => 'success'
      ]);
      } catch (ValidationException $e) {
        $errors = $e->errors();

        $allErrors = [];
        foreach ($errors as $fieldErrors) {
          $fieldErrors = ' - ' . $fieldErrors;
          $allErrors = array_merge($allErrors, $fieldErrors);
        }

        return redirect()->route('cashflow.index')->with([
            'message' => 'Não foi possível criar seu lançamento.',
            'valerrors' => implode('<br/>', $allErrors),
            'type' => 'error',
        ]);
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $entry = Finances::find($id);

      if ($entry) {
        $formatter = new NumberFormatter('pt-BR', NumberFormatter::CURRENCY);
        $entry['entry_value'] = $formatter->format($entry['entry_value']);
        $entry->entry_value = preg_replace('/[^\d,.]/', '', $entry->entry_value);
        return view('finances.cashflow-show', ['entry' => $entry]);
      } else {
        return redirect()->route('cashflow.index')->with([
          'message' => 'Não foi possível acessar o lançamento desejado.',
          'type' => 'error'
        ]);
      }
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(Request $request, string $id)
    {
      $type = $request->type;
      $entry_value = $request->entry_value;
      $info = $request->info;

      $original = Finances::find($id);

      try {
        $original->type = $type;
        $original->entry_value = floatval(str_replace(['.', ','], ['', '.'], $entry_value));
        $original->info = $info;
        $original->save();
      } catch (\Throwable $th) {
        return redirect()->route('cashflow.index')->with([
          'message' => 'Não foi possível alterar o lançamento.',
          'type' => 'error'
        ]);
      }
      return redirect()->route('cashflow.index')->with([
        'message' => 'Lançamento alterado com sucesso.',
        'type' => 'success'
      ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      if(!auth()->user()->role === 'ADMIN'){
        return redirect()->route('cashflow.index')->with([
          'message' => 'Não foi possível excluir o lançamento. Contate algum administrador.',
          'type' => 'error'
        ]);
      }
      try {
        Finances::destroy($id);

        return redirect()->route('cashflow.index')->with([
          'message' => 'Lançamento excluído com sucesso.',
          'type' => 'success'
        ]);
      } catch (\Throwable $th) {
        return redirect()->route('cashflow.index')->with([
          'message' => 'Ocorreu um erro, contate o desenvolvedor.',
          'type' => 'error'
        ]);
      }
    }
}
