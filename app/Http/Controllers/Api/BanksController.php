<?php

namespace FinancialSystem\Http\Controllers\Api;

use FinancialSystem\Http\Controllers\Controller;

use FinancialSystem\Repositories\BankRepository;


class BanksController extends Controller
{

    /**
     * @var BankRepository
     */
    protected $repository;

    /**
     * BanksController constructor.
     * @param BankRepository $repository
     */
    public function __construct(BankRepository $repository)
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
        return $this->repository->all();
    }
}
