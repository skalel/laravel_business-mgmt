<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stocks;

use Illuminate\Validation\ValidationException;
use NumberFormatter;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $stocks = Stocks::sortable()->paginate(20);

      $formatter = new NumberFormatter('pt-BR', NumberFormatter::CURRENCY);

      foreach ($stocks as $stock) {
        $stock['prod_selling_value'] = $formatter->format($stock['prod_selling_value']);
      }

      return view('stocks.index', compact('stocks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try {
        $request['prod_purchase_value'] = floatval(str_replace(['.', ','], ['', '.'], $request['prod_purchase_value']));
        $request['prod_selling_value'] = floatval(str_replace(['.', ','], ['', '.'], $request['prod_selling_value']));
        $validatedData = $request->validate([
          'prod_name' => 'required|string|max:255',
          'prod_description' => 'nullable|string',
          'prod_reference' => 'nullable|string|max:255',
          'prod_batch' => 'nullable|string|max:255',
          'prod_quantity' => 'required|integer|min:1',
          'prod_width' => 'nullable|numeric|min:0',
          'prod_length' => 'nullable|numeric|min:0',
          'prod_height' => 'nullable|numeric|min:0',
          'prod_purchase_value' => 'required|numeric|between:0,9999999999.99',
          'prod_selling_value' => 'required|numeric|between:0,9999999999.99',
        ], [
          'prod_name.required' => 'O campo Nome do Produto é obrigatório.',
          'prod_name.string' => 'O campo Nome do Produto deve ser uma string.',
          'prod_name.max' => 'O campo Nome do Produto não pode ter mais de :max caracteres.',
          'prod_description.string' => 'O campo Descrição do Produto deve ser uma string.',
          'prod_reference.string' => 'O campo Referência do Produto deve ser uma string.',
          'prod_reference.max' => 'O campo Referência do Produto não pode ter mais de :max caracteres.',
          'prod_batch.string' => 'O campo Lote do Produto deve ser uma string.',
          'prod_batch.max' => 'O campo Lote do Produto não pode ter mais de :max caracteres.',
          'prod_quantity.required' => 'O campo Quantidade é obrigatório.',
          'prod_quantity.integer' => 'O campo Quantidade deve ser um número inteiro.',
          'prod_quantity.min' => 'O campo Quantidade deve ser no mínimo :min.',
          'prod_width.numeric' => 'O campo Largura deve ser um número.',
          'prod_width.min' => 'O campo Largura deve ser no mínimo :min.',
          'prod_length.numeric' => 'O campo Comprimento deve ser um número.',
          'prod_length.min' => 'O campo Comprimento deve ser no mínimo :min.',
          'prod_height.numeric' => 'O campo Altura deve ser um número.',
          'prod_height.min' => 'O campo Altura deve ser no mínimo :min.',
          'prod_purchase_value.required' => 'O campo Valor de Compra é obrigatório.',
          'prod_purchase_value.numeric' => 'O campo Valor de Compra deve ser um número.',
          'prod_purchase_value.min' => 'O campo Valor de Compra deve ser no mínimo :min.',
          'prod_selling_value.required' => 'O campo Valor de Venda é obrigatório.',
          'prod_selling_value.numeric' => 'O campo Valor de Venda deve ser um número.',
          'prod_selling_value.min' => 'O campo Valor de Venda deve ser no mínimo :min.',
        ]);
        try {
          $result = Stocks::create($validatedData);
        } catch (\Throwable $th) {
          return redirect()->route('stock.index')->with([
            'message' => 'Não foi possível registrar seu produto.',
            'type' => 'error'
          ]);
        }
        return redirect()->route('stock.index')->with([
          'message' => 'Produto cadastrado com sucesso.',
          'type' => 'success'
        ]);
      } catch (ValidationException $e) {
        $errors = $e->errors();

        $allErrors = [];
        foreach ($errors as $fieldErrors) {
          $fieldErrors = ' - ' . $fieldErrors;
          $allErrors = array_merge($allErrors, $fieldErrors);
        }

        return redirect()->route('stock.index')->with([
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
      $stock = Stocks::find($id);

      $formatter = new NumberFormatter('pt-BR', NumberFormatter::CURRENCY);
      $stock['prod_selling_value'] = $formatter->format($stock['prod_selling_value']);
      $stock->prod_selling_value = preg_replace('/[^\d,.]/', '', $stock->prod_selling_value);
      $stock['prod_purchase_value'] = $formatter->format($stock['prod_purchase_value']);
      $stock->prod_purchase_value = preg_replace('/[^\d,.]/', '', $stock->prod_purchase_value);

      return view('stocks.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $stock = Stocks::find($id);

      $formatter = new NumberFormatter('pt-BR', NumberFormatter::CURRENCY);
      $stock['prod_selling_value'] = $formatter->format($stock['prod_selling_value']);
      $stock->prod_selling_value = preg_replace('/[^\d,.]/', '', $stock->prod_selling_value);
      $stock['prod_purchase_value'] = $formatter->format($stock['prod_purchase_value']);
      $stock->prod_purchase_value = preg_replace('/[^\d,.]/', '', $stock->prod_purchase_value);

      return view('stocks.edit', compact('stock'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      $prod_name = $request->prod_name;
      $prod_reference = $request->prod_reference;
      $prod_description = $request->prod_description;
      $prod_batch = $request->prod_batch;
      $prod_quantity = $request->prod_quantity;
      $prod_purchase_value = $request->prod_purchase_value;
      $prod_selling_value = $request->prod_selling_value;
      $prod_width = $request->prod_width;
      $prod_length = $request->prod_length;
      $prod_height = $request->prod_height;

      $original = Stocks::find($id);
      try {
        $original->prod_name = $prod_name;
        $original->prod_reference = $prod_reference;
        $original->prod_description = $prod_description;
        $original->prod_batch = $prod_batch;
        $original->prod_quantity = $prod_quantity;
        $original->prod_purchase_value = floatval(str_replace(['.', ','], ['', '.'], $prod_purchase_value));
        $original->prod_selling_value = floatval(str_replace(['.', ','], ['', '.'], $prod_selling_value));
        $original->prod_width = $prod_width;
        $original->prod_length = $prod_length;
        $original->prod_height = $prod_height;
        $original->save();
      } catch (\Throwable $th) {
        return redirect()->route('stock.index')->with([
          'message' => 'Não foi possível alterar o produto.',
          'type' => 'error'
        ]);
      }
      return redirect()->route('stock.index')->with([
        'message' => 'Produto alterado com sucesso.',
        'type' => 'success'
      ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $data = Stocks::find($id);

      if(!auth()->user()->role === 'ADMIN' OR auth()->user()->id !== $data->created_by){
        return redirect()->route('stock.index')->with([
          'message' => 'Não foi possível excluir o produto. Contate algum administrador.',
          'type' => 'error'
        ]);
      }
      try {
        Stocks::destroy($id);

        return redirect()->route('stock.index')->with([
          'message' => 'Produto excluído com sucesso.',
          'type' => 'success'
        ]);
      } catch (\Throwable $th) {
        return redirect()->route('stock.index')->with([
          'message' => 'Ocorreu um erro, contate o desenvolvedor.',
          'type' => 'error'
        ]);
      }
    }
}
