<?php

namespace App\Repositories;

use App\Models\Contract;
use App\Models\Rate;
use App\Imports\RatesImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\BaseRepository;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\Schema;

/**
 * Class ContractRepository
 * @package App\Repositories
 * @version November 26, 2021, 3:49 am UTC
*/

class ContractRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'fecha'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Contract::class;
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Model
     */
    public function create($input)
    {
        try {
            DB::beginTransaction();
                $model = $this->model->newInstance($input);
                $model->save();
                $import = new RatesImport($model->id);
                $import->import($input['file']);
                //$data = Rate::with('contract')->whereBelongsTo($model)->firstOrFail()->get()->toArray();
                $data = DB::table('rates')
                        ->join('contracts', 'rates.contract_id', '=', 'contracts.id')
                        ->select('contracts.nombre', 'contracts.fecha', 'rates.origin', 'rates.destination', 'rates.currency', 'rates.twenty', 'rates.forty', 'rates.fortyhc')
                        ->get();
            DB::commit();
            return $data;
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->handleException($th);
        }
    }
}
