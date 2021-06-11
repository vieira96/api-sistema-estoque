<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseSuccess(
        $data = [], string $message = null, int $code = 200
    ) {


        $trace = debug_backtrace();

        //$trace[1] pega a ultima classe que requisitou essa função

        if (! $message) {
            switch ($trace[1]['function']) {
                case 'store':
                    $message = 'success.stored';
                    break;
                case 'destroy':
                    $message = 'success.removed';
                    break;
                case 'update':
                    $message = 'success.changed';
                    break;
                case 'index':
                case 'list':
                    $message = 'success.list';
                    break;
                default:
                    $message = 'success.default';
                    break;
            }
        }

        return response()->json([
            'message' => trans($message),
            'code' => $code,
            'data' => $data
        ]);
    }

    public function responseError(
        string $message = null, int $code = 400
    ) {

        if(! $message) {
            $message = 'exceptions.default';
        }

        return response()->json([
            'message' => trans($message),
            'code' => $code,
        ]);
    }
}
