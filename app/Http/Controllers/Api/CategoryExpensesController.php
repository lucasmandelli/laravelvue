<?php

namespace FinancialSystem\Http\Controllers\Api;

use FinancialSystem\Criteria\FindRootCategoriesCriteria;
use FinancialSystem\Criteria\WithDepthCategoriesCriteria;
use FinancialSystem\Http\Controllers\Controller;

use FinancialSystem\Http\Requests\CategoryExpenseRequest;
use FinancialSystem\Repositories\CategoryExpenseRepository;


class CategoryExpensesController extends Controller
{

    /**
     * @var CategoryExpenseRepository
     */
    protected $repository;

    public function __construct(CategoryExpenseRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->pushCriteria(new WithDepthCategoriesCriteria());
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(new FindRootCategoriesCriteria());
        $categoryExpenses = $this->repository->all();

        return $categoryExpenses;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryExpenseRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryExpenseRequest $request)
    {
        $categoryExpense = $this->repository->skipPresenter()->create($request->all());

        $this->repository->skipPresenter(false);

        $categoryExpense = $this->repository->find($categoryExpense->id);

        return response()->json($categoryExpense, 201);
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
        $categoryExpense = $this->repository->find($id);

        return response()->json($categoryExpense);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryExpenseRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(CategoryExpenseRequest $request, $id)
    {
        $categoryExpense = $this->repository->skipPresenter()->update($request->all(), $id);

        $this->repository->skipPresenter(false);

        $categoryExpense = $this->repository->find($categoryExpense->id);

        return response()->json($categoryExpense);
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
}
