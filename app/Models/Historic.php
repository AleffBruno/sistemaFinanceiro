<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

class Historic extends Model
{
    protected $fillable = [
        'type',
        'amount',
        'total_before',
        'total_after',
        'user_id_transaction',
        'date'
    ];

    public function type($type = null)
    {
        $types = [
            'I' => 'Entrada',
            'O' => 'Saque',
            'T' => 'Transferencia'
        ];

        if(!$type)
        {
            return $types;
        }

        if($this->user_id_transaction != null && $type == 'I')
        {
            return 'Recebido';
        }

        return $types[$type];
    }

    //hint > scope is a "special word" to do queries that can be used in a lot places
    public function scopeUserAuth($query)
    {
        return $query->where('user_id',auth()->user()->id);
    }

    public function user()
    {
        // caution on the joke, here NOT 'hasOne' USER, but 'belongsToOne'
        return $this->belongsTo(User::class);
    }

    public function userSender()
    {
        return $this->belongsTo(User::class,'user_id_transaction');
    }

    // hint > when use "get"+ATTIBUTE_NAME+"Attribute" , you can edit the values returned from database
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function search(Array $data,$totalPage)
    {
        return $this->where(function($query) use ($data){ // data won't be accepted inside callbackfunction so needs write "use" to use this variable
            if(isset($data['id']))
                $query->where('id',$data['id']);

            if(isset($data['date']))
                $query->where('date',$data['date']);

            if(isset($data['type']))
                $query->where('type',$data['type']);
        })
        //->where('user_id',auth()->user()->id)
        ->userAuth()
        ->with(['userSender'])
        ->paginate($totalPage);
    }

}
