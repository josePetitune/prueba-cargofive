<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRateAPIRequest;
use App\Http\Requests\API\UpdateRateAPIRequest;
use App\Models\Rate;
use App\Repositories\RateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RateController
 * @package App\Http\Controllers\API
 */

class RateAPIController extends AppBaseController
{
    /** @var  RateRepository */
    private $rateRepository;

    public function __construct(RateRepository $rateRepo)
    {
        $this->rateRepository = $rateRepo;
    }

    /**
     * Display a listing of the Rate.
     * GET|HEAD /rates
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $rates = $this->rateRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($rates->toArray(), 'Rates retrieved successfully');
    }

    /**
     * Store a newly created Rate in storage.
     * POST /rates
     *
     * @param CreateRateAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRateAPIRequest $request)
    {
        $input = $request->all();

        $rate = $this->rateRepository->create($input);

        return $this->sendResponse($rate->toArray(), 'Rate saved successfully');
    }

    /**
     * Display the specified Rate.
     * GET|HEAD /rates/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Rate $rate */
        $rate = $this->rateRepository->find($id);

        if (empty($rate)) {
            return $this->sendError('Rate not found');
        }

        return $this->sendResponse($rate->toArray(), 'Rate retrieved successfully');
    }

    /**
     * Update the specified Rate in storage.
     * PUT/PATCH /rates/{id}
     *
     * @param int $id
     * @param UpdateRateAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRateAPIRequest $request)
    {
        $input = $request->all();

        /** @var Rate $rate */
        $rate = $this->rateRepository->find($id);

        if (empty($rate)) {
            return $this->sendError('Rate not found');
        }

        $rate = $this->rateRepository->update($input, $id);

        return $this->sendResponse($rate->toArray(), 'Rate updated successfully');
    }

    /**
     * Remove the specified Rate from storage.
     * DELETE /rates/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Rate $rate */
        $rate = $this->rateRepository->find($id);

        if (empty($rate)) {
            return $this->sendError('Rate not found');
        }

        $rate->delete();

        return $this->sendSuccess('Rate deleted successfully');
    }
}
