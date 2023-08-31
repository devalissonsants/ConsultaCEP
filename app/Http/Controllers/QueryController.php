<?php

namespace App\Http\Controllers;

use App\Http\Requests\QueryZipCodeRequest;
use App\Service\QueryService;

class QueryController extends Controller
{
    private $queryService;
    public function __construct(QueryService $queryService)
    {
        $this->queryService = $queryService;
    }

    public function queryZipCode(QueryZipCodeRequest $request)
    {
        return $this->queryService->queryZipCode($request->cep);
    }
}
