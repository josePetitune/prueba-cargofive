<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContractAPIRequest;
use App\Http\Requests\API\UpdateContractAPIRequest;
use App\Models\Contract;
use App\Repositories\ContractRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ContractController
 * @package App\Http\Controllers\API
 */

class ContractAPIController extends AppBaseController
{
    /** @var  ContractRepository */
    private $contractRepository;

    public function __construct(ContractRepository $contractRepo)
    {
        $this->contractRepository = $contractRepo;
    }

    /**
     * Display a listing of the Contract.
     * GET|HEAD /contracts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $contracts = $this->contractRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($contracts->toArray(), 'Contracts retrieved successfully');
    }

    /**
     * Store a newly created Contract in storage.
     * POST /contracts
     *
     * @param CreateContractAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateContractAPIRequest $request)
    {
        $input = $request->all();

        $contract = $this->contractRepository->create($input);

        return $this->sendResponse($contract->toArray(), 'Contract saved successfully');
    }

    /**
     * Display the specified Contract.
     * GET|HEAD /contracts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Contract $contract */
        $contract = $this->contractRepository->find($id);

        if (empty($contract)) {
            return $this->sendError('Contract not found');
        }

        return $this->sendResponse($contract->toArray(), 'Contract retrieved successfully');
    }

    /**
     * Update the specified Contract in storage.
     * PUT/PATCH /contracts/{id}
     *
     * @param int $id
     * @param UpdateContractAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContractAPIRequest $request)
    {
        $input = $request->all();

        /** @var Contract $contract */
        $contract = $this->contractRepository->find($id);

        if (empty($contract)) {
            return $this->sendError('Contract not found');
        }

        $contract = $this->contractRepository->update($input, $id);

        return $this->sendResponse($contract->toArray(), 'Contract updated successfully');
    }

    /**
     * Remove the specified Contract from storage.
     * DELETE /contracts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Contract $contract */
        $contract = $this->contractRepository->find($id);

        if (empty($contract)) {
            return $this->sendError('Contract not found');
        }

        $contract->delete();

        return $this->sendSuccess('Contract deleted successfully');
    }
}
