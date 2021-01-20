<?php

declare(strict_types = 1);

namespace App\Controllers;

class IndexController extends AbstractController
{
    public function index()
    {
        $method = $this->request->getMethod();
        $user = $this->request->input('user', 'Hyperf');
        return [
            'method' => $method,
	        'message' => "Hello {$user}.",
        ];
    }
}
