<?php

namespace FinancialSystem\Http\Controllers\Admin;

use FinancialSystem\Http\Controllers\Controller;
use FinancialSystem\Http\Controllers\Response;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use FinancialSystem\Http\Requests\BankCreateRequest;
use FinancialSystem\Http\Requests\BankUpdateRequest;
use FinancialSystem\Repositories\BankRepository;


class BanksController extends Controller
{

    /**
     * @var BankRepository
     */
    protected $repository;

    public function __construct(BankRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->skipPresenter(true);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $banks = $this->repository->paginate(5);

        /*if (request()->wantsJson()) {

            return response()->json([
                'data' => $banks,
            ]);
        }*/

        return view('admin.banks.index', compact('banks'));
    }

    /**
     * Show the form for create the resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BankCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BankCreateRequest $request)
    {

        $data = $request->all();

        $this->repository->create($data);

        /*if ($request->wantsJson()) {

            $response = [
                'message' => 'Bank created.',
                'data'    => $bank->toArray(),
            ];

            return response()->json($response);
        }*/

        return redirect()->route('admin.banks.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $bank = $this->repository->find($id);

        return view('admin.banks.edit', compact('bank'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  BankUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(BankUpdateRequest $request, $id)
    {

        $this->repository->update($request->all(), $id);

        /*if ($request->wantsJson()) {

            $response = [
                'message' => 'Bank updated.',
                'data'    => $bank->toArray(),
            ];

            return response()->json($response);
        }*/

        return redirect()->route('admin.banks.index');

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

        /*if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Bank deleted.',
                'deleted' => $deleted,
            ]);
        }*/

        return redirect()->route('admin.banks.index');
    }
}
