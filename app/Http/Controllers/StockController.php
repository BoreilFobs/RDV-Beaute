<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $query = Stock::query();

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by quantity status
        if ($request->filled('quantity_filter')) {
            if ($request->quantity_filter == 'in-stock') {
                $query->where('quantity', '>=', 10);
            } elseif ($request->quantity_filter == 'low-stock') {
                $query->where('quantity', '>', 0)->where('quantity', '<', 10);
            } elseif ($request->quantity_filter == 'out-of-stock') {
                $query->where('quantity', '<=', 0);
            }
        }

        $stocks = $query->paginate(10)->withQueryString();

        return view('admin.stock.index', compact('stocks'));
    }

    public function create()
    {
       return view("admin.stock.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'usage_type' => 'required|string',
        ]);

        $stock = new Stock();
        $stock->name = $request->input('name');
        $stock->quantity = $request->input('quantity');
        $stock->unit_price = $request->input('unit_price');
        $stock->save();

        return redirect()->route('stock.index')->with('success', 'Stock item created successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        return view("admin.stock.edit", compact('stock'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'usage_type' => 'required|string',
        ]);

        $stock = Stock::findOrFail($id);
        $stock->name = $request->input('name');
        $stock->quantity = $request->input('quantity');
        $stock->unit_price = $request->input('unit_price');
        $stock->save();

        return redirect()->route('stock.index')->with('success', 'Stock item updated successfully.');
    }

    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('stock.index')->with('success', 'Stock item deleted successfully.');
    }
    
    public function used(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $stock = Stock::findOrFail($id);

        // Prevent negative quantity
        if ($request->quantity > $stock->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        $stock->quantity -= $request->quantity;
        $stock->save();

        return redirect()->route('stock.index')->with('success', 'Stock quantity updated as sold/used.');
    }
}
