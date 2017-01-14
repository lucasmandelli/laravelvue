<?php

namespace FinancialSystem\Http\Controllers\Api;

use FinancialSystem\Http\Controllers\Controller;
use FinancialSystem\Http\Controllers\Response;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use FinancialSystem\Http\Requests\BillPayCreateRequest;
use FinancialSystem\Http\Requests\BillPayUpdateRequest;
use FinancialSystem\Repositories\BillPayRepository;


class BillsPayController extends Controller
{

    /**
     * @var BillPayRepository
     */
    protected $repository;

    public function __construct(BillPayRepository $repository)
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
        $billsPay = $this->repository->paginate(5);

        return $billsPay;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BillPayCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BillPayCreateRequest $request)
    {

        $billPay = $this->repository->create($request->all());

        return response()->json($billPay, 201);
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
        $billPay = $this->repository->find($id);

        return response()->json($billPay);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  BillPayUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(BillPayUpdateRequest $request, $id)
    {
        $billPay = $this->repository->update($request->all(), $id);

        return response()->json($billPay);
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
