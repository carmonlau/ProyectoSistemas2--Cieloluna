<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Método que muestra la vista del dashboard
    public function index()
    {
        return view('dashboard'); // Asegúrate de que tienes una vista llamada 'dashboard.blade.php'
    }
}
