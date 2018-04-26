<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    public $timestamps = false;

    public function deposit(float $value) : Array // << isso significa que o retorno é um array
    {
        $totalBefore = $this->amount;
        // perhaps needs to use "number_format";
        $this->amount += $value;
        $result = $this->save();

        $historic = auth()->user()->historics()->create([
                        'type'          => 'I',
                        'amount'        => $value,
                        'total_before'  => $totalBefore,
                        'total_after'   => $this->amount,
                        'date'          => date('Y-m-d')
                    ]);
        //Achei uma pegadinha, se der erro ai inserir o historico, ainda é feito o insert em "balance"


        if ($result && $historic)
        {
            return [
                'success' => true,
                'message' => 'Sucesso ao recarregar'
            ];
        }

        return [
            'success' => false,
            'message' => 'Falha ao recarregar'
        ];
    }



}


