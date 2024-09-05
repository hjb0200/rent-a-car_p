<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CarController extends Controller
{
    public function create()
    {
        return Inertia::render('Cars/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
        ]);

        Car::create($request->all());

        return redirect()->route('cars.index')->with('message', 'Car added successfully');
    }

    public function index()
    {
        $cars = Car::all();
        return Inertia::render('Cars/Index', ['cars' => $cars]);
    }

    public function show(Car $car)
    {
        return Inertia::render('Cars/Show', ['car' => $car]);
    }



    // 추가적인 메서드들 (index, show 등)
}
