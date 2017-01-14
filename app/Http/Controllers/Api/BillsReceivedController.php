<?php

namespace FinancialSystem\Http\Controllers\Api;

use FinancialSystem\Http\Controllers\Controller;
use FinancialSystem\Http\Controllers\Response;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use FinancialSystem\Http\Requests\BillReceivedCreateRequest;
use FinancialSystem\Http\Requests\BillReceivedUpdateRequest;
use FinancialSystem\Repositories\BillReceivedRepository;


class BillsReceivedController extends Controller
{

    /**
     * @var BillReceivedRepository
     */
    protected $repository;

    public function __construct(BillReceivedRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billsReceived = $this->repository->paginate(5);

        return $billsReceived;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BillReceivedCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BillReceivedCreateRequest $request)
    {

        $billReceived = $this->repository->create($request->all());

        return response()->json($billReceived, 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $billReceived = $this->repository->find($id);

        return response()->json($billReceived);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  BillReceivedUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(BillReceivedUpdateRequest $request, $id)
    {

        $billReceived = $this->repository->update($request->all(), $id);

        return response()->json($billReceived);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return response()->json([], 204);
    }


    public function status() {
        $bills =  $this->repository->skipPresenter(true)->all();

        if(!$bills) {
            return response()->json(['status' => false]);
        }

        $count = 0;
        foreach($bills as $bill) {
            if(!$bill->done){
                $count++;
            }
        }

        return response()->json(['status' => $count]);

    }


    public function total() {
        $bills =  $this->repository->skipPresenter(true)->all();

        $total = 0;
        foreach($bills as $bill) {
            $total += (float) $bill->value;
        }

        return response()->json(['total' => money_format('%+-.2i', $total)]);

    }
}
