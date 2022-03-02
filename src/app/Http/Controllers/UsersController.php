<?php

namespace App\Http\Controllers;


use App\Http\Enums\MainEnums;
use Illuminate\Support\Collection;

class UsersController extends Controller
{
    public function index()
    {
        $errors = $this->validateRequest();
        if (!empty($errors)) {
            return $errors;
        }
        $data = $this->filterData(collect($this->loadData()));

        return Response()->json([
            'status' => 200,
            'message' => 'message',
            'data' => $data
        ], 200);
    }

    public function validateRequest(): array
    {
        $errors = [];
        if (isset(\request()->balanceMin)) {
            if (\request()->balanceMin < 1) {
                $errors[] = [
                    'status' => 422,
                    'message' => 'balanceMin should be greater than 1',
                ];
            }
            if (isset(\request()->balanceMax) && \request()->balanceMax < \request()->balanceMin) {
                $errors[] = [
                    'status' => 422,
                    'message' => 'balanceMax should be greater than balanceMin',
                ];
            }
        }
        if (isset(\request()->statusCode) && !in_array(\request()->statusCode, MainEnums::getStatuses())) {
            $errors[] = [
                'status' => 422,
                'message' => 'status code is not supported , please use one of [ ' .
                    implode(",", MainEnums::getStatuses()) . ' ]'
            ];
        }
        if (isset(\request()->provider) && !in_array(\request()->provider, MainEnums::getFileNames())) {
            $errors[] = [
                'status' => 422,
                'message' => 'provider is not supported , please use one of [ ' .
                    implode(",", MainEnums::getFileNames()) . ' ]'
            ];
        }
        return $errors;
    }

    public function filterData(Collection $data): Collection
    {
        return $data->when(isset(\request()->currency), function ($q) {
            return $q->where('currency', request()->currency);
        })->when(isset(\request()->balanceMin), function ($q) {
            return $q->where('balance', '>=', request()->balanceMin);
        })->when(isset(\request()->balanceMax), function ($q) {
            return $q->where('balance', '<=', request()->balanceMax);
        })->when(isset(\request()->provider), function ($q) {
            return $q->where('fileName', request()->provider);
        })->when(isset(\request()->statusCode), function ($q) {
            return $q->where('status', request()->statusCode);
        });
    }

    public function loadData(): array
    {
        $data = [];
        $files = MainEnums::FILES_STRUCTURE;
        foreach ($files as $fileName => $structure) {
            $$fileName = collect(json_decode(file_get_contents('./' . $fileName . '.json'), true));
            foreach ($$fileName as $row) {
                $data[] = [
                    'email' => $row[$structure['email']],
                    'currency' => $row[$structure['currency']],
                    'status' => $structure['statusCodes'][$row[$structure['status']]],
                    'balance' => $row[$structure['balance']],
                    'fileName' => $fileName,
                ];
            }
        }
        return $data;
    }
}
