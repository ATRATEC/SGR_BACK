<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public static $messages = [
                                'required' => 'Campo :attribute obrigatório.',
                                'numeric' => 'Campo :attribute deve ser do tipo numerico.',
                                'max' => 'Campo :attribute não pode ser maior que :max caracteres.',
                              ];
}
