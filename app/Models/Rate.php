<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Rate
 * @package App\Models
 * @version November 26, 2021, 3:48 am UTC
 *
 * @property \App\Models\Contract $contract
 * @property string $origin
 * @property string $destination
 * @property string $currency
 * @property string $twenty
 * @property string $forty
 * @property string $fortyhc
 * @property integer $contract_id
 */
class Rate extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'rates';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'origin',
        'destination',
        'currency',
        'twenty',
        'forty',
        'fortyhc',
        'contract_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'origin' => 'string',
        'destination' => 'string',
        'currency' => 'string',
        'twenty' => 'string',
        'forty' => 'string',
        'fortyhc' => 'string',
        'contract_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'origin' => 'required|string|max:255',
        'destination' => 'required|string|max:255',
        'currency' => 'required|string|max:255',
        'twenty' => 'required|string|max:255',
        'forty' => 'required|string|max:255',
        'fortyhc' => 'required|string|max:255',
        'contract_id' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function contract()
    {
        return $this->belongsTo(\App\Models\Contract::class, 'contract_id');
    }
}
