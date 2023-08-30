<?php

namespace App\Http\Controllers;

use App\Http\Requests\QueryZipCodeRequest;
use App\Service\QueryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
