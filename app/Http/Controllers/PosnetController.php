<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use Illuminate\Validation\ValidationException;
use App\Services\Posnet;

class PosnetController extends Controller
{
    protected $posnet;

    public function __construct(Posnet $posnet)
    {
        $this->posnet = $posnet;
    }

    /**
     * Registra una tarjeta
     *
     * @param Request $request
     * @return void
     */
    public function registerCard(Request $request)
    {
           try {
            $validatedData = $request->validate([
                'card_number' => 'required|digits:8|unique:cards',
                'card_type' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $validTypes = ['VISA', 'AMEX'];
                        if (!in_array(strtoupper($value), $validTypes)) {
                            $fail('The card_type is '.implode(",",$validTypes));
                        }
                    },
                ],
                'bank_name' => 'required|string',
                'limit' => 'required|numeric|min:0',
                'dni' => 'required|string',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
            ]);

            // Guardar tarjeta en la base de datos
            $validatedData["card_type"]=strtoupper($validatedData["card_type"]);
            Card::create($validatedData);

            return response()->json(['message' => 'Card registered successfully.'], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

     /**
     * Realiza un pago con tarjeta
     *
     * @param Request $request
     * @return void
     */
    public function doPayment(Request $request)
    {
        try {
            
            $validatedData = $request->validate([
                'card_number' => 'required|digits:8',
                'amount' => 'required|numeric|min:1',
                'installments' => 'required|integer|between:1,6',
            ]);

            $ticket = $this->posnet->doPayment(
                $validatedData['card_number'],
                $validatedData['amount'],
                $validatedData['installments']
            );

            return response()->json(['ticket' => $ticket], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
