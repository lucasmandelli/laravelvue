<?php

namespace FinancialSystem\Http\Controllers\Api;

use FinancialSystem\Criteria\FindRootCategoriesCriteria;
use FinancialSystem\Criteria\WithDepthCategoriesCriteria;
use FinancialSystem\Http\Controllers\Controller;

use FinancialSystem\Http\Requests\CategoryRevenueRequest;
use FinancialSystem\Repositories\CategoryRevenueRepository;


class CategoryRevenuesController extends Controller
{

    /**
     * @var CategoryRevenueRepository
     */
    protected $repository;

    public function __construct(CategoryRevenueRepository $repository)
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
        $categoryRevenues = $this->repository->all();

        return $categoryRevenues;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryRevenueRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRevenueRequest $request)
    {
        $categoryRevenue = $this->repository->skipPresenter()->create($request->all());

        $this->repository->skipPresenter(false);

        $categoryRevenue = $this->repository->find($categoryRevenue->id);

        return response()->json($categoryRevenue, 201);
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
        $categoryRevenue = $this->repository->find($id);

        return response()->json($categoryRevenue);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRevenueRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(CategoryRevenueRequest $request, $id)
    {
        $categoryRevenue = $this->repository->skipPresenter()->update($request->all(), $id);

        $this->repository->skipPresenter(false);

        $categoryRevenue = $this->repository->find($categoryRevenue->id);

        return response()->json($categoryRevenue);
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
