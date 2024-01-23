<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->get();
        return response()->json($customers);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
        ]);

        $customer = Customer::create($validatedData);

        return response()->json($customer);
    }

    public function show($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            return response()->json($customer);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Customer not found.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id,
        ]);

        try {
            $customer = Customer::findOrFail($id);
            $customer->update($validatedData);
            return response()->json($customer);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Customer not found.'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();
            return response()->json($customer);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Customer not found.'], 404);
        }
    }
}
