<?php

namespace App\Http\Controllers;

use App\Models\Dentist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DentistController extends Controller
{
    public function index(): View
    {
        return view('dentists.index', ['dentists' => Dentist::withCount('appointments')->orderBy('name')->get()]);
    }

    public function create(): View
    {
        return view('dentists.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Dentist::create($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'specialization' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:dentists,email'],
            'phone' => ['required', 'string', 'max:50'],
        ]));

        return to_route('dentists.index')->with('success', 'Dentist added successfully.');
    }

    public function show(Dentist $dentist): View
    {
        $dentist->load('appointments.patient');

        return view('dentists.show', compact('dentist'));
    }

    public function edit(Dentist $dentist): View
    {
        return view('dentists.edit', compact('dentist'));
    }

    public function update(Request $request, Dentist $dentist): RedirectResponse
    {
        $dentist->update($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'specialization' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:dentists,email,'.$dentist->id],
            'phone' => ['required', 'string', 'max:50'],
        ]));

        return to_route('dentists.index')->with('success', 'Dentist updated successfully.');
    }

    public function destroy(Dentist $dentist): RedirectResponse
    {
        if ($dentist->appointments()->exists()) {
            return to_route('dentists.index')->with('error', 'This dentist has appointments and cannot be deleted.');
        }

        $dentist->delete();

        return to_route('dentists.index')->with('success', 'Dentist deleted successfully.');
    }
}
