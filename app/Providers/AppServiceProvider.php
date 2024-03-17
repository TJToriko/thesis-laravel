<?php

namespace App\Providers;

use App\Models\Payment;
use Illuminate\Support\ServiceProvider;
use DB;
use App\Models\registrationnotification;
use App\Models\Aboutus;
use App\Models\Logo;
use App\Models\paymenttracker;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fetch registration notifications for the authenticated mechanic where is_read is 0
        $registrationnotificationrealtime = DB::table('registrationnotifications')
        ->select(DB::raw('COUNT(registrationnotifications.is_read) AS unread'))
        ->get();
        view()->share('registrationnotificationrealtime', $registrationnotificationrealtime);

        $registrationnotifications = registrationnotification::orderBy('created_at', 'desc')
        ->take(5)
        ->get();
        view()->share('registrationnotifications', $registrationnotifications);

        $aboutus = Aboutus::orderBy('id', 'ASC')->first();
        view()->share('aboutus', $aboutus);

        $logo = Logo::orderBy('id', 'ASC')->first();
        view()->share('logo', $logo);

        // Count pending payments for today
        $pendingTodayCount = paymenttracker::whereDate('due_date', '=', Carbon::today())
        ->where('payment_status', 'Pending')
        ->count();

        // Count overdue payments
        $overdueCount = paymenttracker::where('due_date', '<', Carbon::today())
            ->where('payment_status', 'Pending')
            ->count();

        // Count pending payments for today of reservation online
        $pendingCustomerReserveTodayCount = Payment::whereDate('date_to_collect', '=', Carbon::today())
        ->where('status', 'Pending')
        ->count();

        // Calculate the total count
        $totalCount = $pendingTodayCount + $overdueCount + $pendingCustomerReserveTodayCount;
        view()->share('totalCount', $totalCount);
    }
}
