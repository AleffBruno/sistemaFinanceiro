<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Balance extends Model
{
    public $timestamps = false;

    public function deposit(float $value) : Array // << isso significa que o retorno é um array
    {
        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0;
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
        //Achei uma pegadinha, se der erro ao inserir o historico, ainda é feito o insert em "balance"


        if ($result && $historic)
        {
            DB::commit();

            return [
                'success' => true,
                'message' => 'Sucesso ao recarregar'
            ];
        } else {

            DB::rollback();

            return [
                'success' => false,
                'message' => 'Falha ao recarregar'
            ];
        }

        
    }



}


