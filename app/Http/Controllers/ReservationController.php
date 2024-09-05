<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Car;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReservationController extends Controller
{
    public function create(Car $car)
    {
        return Inertia::render('Reservations/Create', ['car' => $car]);
    }

    public function store(Request $request, Car $car)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        // 중복 예약 체크
        $existingReservation = Reservation::where('car_id', $car->id)
            ->where(function($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                      ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                      ->orWhereRaw('? BETWEEN start_date AND end_date', [$request->start_date])
                      ->orWhereRaw('? BETWEEN start_date AND end_date', [$request->end_date]);
            })
            ->exists();

        if ($existingReservation) {
            return back()->withErrors(['start_date' => '이 날짜는 이미 예약되어 있습니다.']);
        }

        Reservation::create([
            'car_id' => $car->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('cars.show', $car)->with('message', '예약이 성공적으로 완료되었습니다.');
    }
}
