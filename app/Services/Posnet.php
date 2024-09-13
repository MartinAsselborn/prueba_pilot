<?php

namespace App\Services;

use App\Models\Card;

class Posnet
{
    public function doPayment($cardNumber, $amount, $installments)
    {
        
        $card = Card::where('card_number', $cardNumber)->first();
            
        if (!$card) {
            return response()->json(['error' => 'Card not registered.'], 404);
        }

        $totalAmount = $amount;

        // Calcular recargo
        if ($installments > 1) {
            $installmentTotalAmount = (1 + (0.03 * ($installments - 1)));
            $totalAmount= $installmentTotalAmount* $totalAmount;
        }
        
        if ($totalAmount > $card->limit) {
           throw new \Exception('Insufficient limit on the card.',999);
        }

        $installmentAmount=$totalAmount/$installments;
        // ticket 
        $ticket = [
            'firstName' => $card->first_name,
            'lastName' => $card->last_name,
            'totalAmount' => $totalAmount,
            'installmentAmount' => number_format($installmentAmount,2),
        ];

        return $ticket;
    }
}
