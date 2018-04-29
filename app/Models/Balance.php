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
        $deposit = $this->save();

        $historic = auth()->user()->historics()->create([
                        'type'          => 'I',
                        'amount'        => $value,
                        'total_before'  => $totalBefore,
                        'total_after'   => $this->amount,
                        'date'          => date('Y-m-d')
                    ]);
        //Achei uma pegadinha, se der erro ao inserir o historico, ainda é feito o insert em "balance"


        if ($deposit && $historic)
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

    public function withdraw(float $value) : Array
    {
        if($this->amount < $value)
        {
            return [
                'success' => false,
                'message' => 'Saldo Insuficiente'
            ];
        }

        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0;
        // perhaps needs to use "number_format";
        $this->amount -= $value;
        $withdraw = $this->save();

        $historic = auth()->user()->historics()->create([
                        'type'          => 'O',
                        'amount'        => $value,
                        'total_before'  => $totalBefore,
                        'total_after'   => $this->amount,
                        'date'          => date('Y-m-d')
                    ]);
        //Achei uma pegadinha, se der erro ao inserir o historico, ainda é feito o insert em "balance"


        if ($withdraw && $historic)
        {
            DB::commit();

            return [
                'success' => true,
                'message' => 'Sucesso ao retirar'
            ];
        } else {

            DB::rollback();

            return [
                'success' => false,
                'message' => 'Falha ao retirar'
            ];
        }
    }

}


