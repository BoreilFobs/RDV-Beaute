<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Gallery;
use App\Models\Offers;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
     public function index()
    {
        // Appointments Stats
        $appointmentsCount = Appointments::where('status', 'completed')->count();
        $lastMonthAppointments = Appointments::where('status', 'completed')
            ->where('created_at', '>=', now()->subMonth())
            ->count();
        $appointmentsChange = $this->calculatePercentageChange($appointmentsCount, $lastMonthAppointments);
        
        // Users Stats
        $usersCount = User::count();
        $lastMonthUsers = User::where('created_at', '>=', now()->subMonth())->count() - 1;
        $usersChange = $this->calculatePercentageChange($usersCount, $lastMonthUsers);
        
        // Stock On Sale Value
        $stockOnSaleValue = Stock::where('usage_type', 'sale')
            ->get()
            ->sum(function($stock) {
                return ($stock->unit_price ?? 0) * ($stock->quantity ?? 0);
            });

        $lastMonthStockOnSaleValue = Stock::where('usage_type', 'sale')
            ->where('created_at', '>=', now()->subMonth())
            ->get()
            ->sum(function($stock) {
                return ($stock->unit_price ?? 0) * ($stock->quantity ?? 0);
            });
        $stockOnSaleChange = $this->calculatePercentageChange($stockOnSaleValue, $lastMonthStockOnSaleValue);
        
        // Products Stats
        $productsCount = Stock::count();
        $lastMonthProducts = Stock::where('created_at', '>=', now()->subMonth())->count();
        $productsChange = $this->calculatePercentageChange($productsCount, $lastMonthProducts);

        // prestation Stats
        $prestationsCount = Offers::count();
        $lastMonthPrestations = Offers::where('created_at', '>=', now()->subMonth())->count();
        $prestationsChange = $this->calculatePercentageChange($productsCount, $lastMonthProducts);
        
        // Recent Data
        $recentAppointments = Appointments::with('offer')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $recentUsers = User::withCount('appointments')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $recentGalleryItems = Gallery::orderBy('created_at', 'desc')
            ->take(6)
            ->get();
            
        // Appointment Status Distribution
        $appointmentStatuses = Appointments::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get()
            ->map(function($item) use ($appointmentsCount) {
                $item->percentage = $appointmentsCount > 0 ? round(($item->count / $appointmentsCount) * 100) : 0;
                return $item;
            });
            
        // Popular Services
        $popularServices = Offers::withCount('appointments')
            ->orderBy('appointments_count', 'desc')
            ->take(3)
            ->get();

        return view('admin.dashboard', compact(
            'appointmentsCount', 'appointmentsChange',
            'usersCount', 'usersChange',
            'stockOnSaleValue', 'stockOnSaleChange',
            'prestationsCount', 'prestationsChange',
            'productsCount', 'productsChange',
            'recentAppointments', 'recentUsers', 'recentGalleryItems',
            'appointmentStatuses', 'popularServices'
        ));
    }

    private function calculatePercentageChange($current, $previous)
    {
        if ($previous == 0) {
            return $current == 0 ? 0 : 100;
        }
        return (($current - $previous) / $previous) * 100;
    }
}
