<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function adminIndex(Request $request)
    {
        $startDateStr = $request->input('start_date');
        $endDateStr = $request->input('end_date');

        if ($startDateStr && $endDateStr) {
            $startDate = Carbon::parse($startDateStr)->startOfDay();
            $endDate = Carbon::parse($endDateStr)->endOfDay();
        } else {
            $startDate = Carbon::now()->subDays(30)->startOfDay();
            $endDate = Carbon::now()->endOfDay();
        }

        // Filtered orders
        $ordersQuery = Order::whereBetween('created_at', [$startDate, $endDate]);
        
        $totalOrders = $ordersQuery->count();
        $totalRevenue = $ordersQuery->where('status', 'delivered')->sum('total_price');
        $pendingRevenue = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'pending')
            ->sum('total_price');

        // Grouped sales by day
        $dailySales = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_price) as total'),
                DB::raw('COUNT(id) as count')
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'delivered')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Category sales distribution
        $categorySales = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name as category_name', DB::raw('SUM(order_items.price * order_items.quantity) as total'))
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->where('orders.status', 'delivered')
            ->groupBy('categories.name')
            ->get();

        // Recent transactions in date range
        $transactions = Order::with('user')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->take(15)
            ->get();

        return view('admin.analytics', compact(
            'totalOrders',
            'totalRevenue',
            'pendingRevenue',
            'dailySales',
            'categorySales',
            'transactions',
            'startDate',
            'endDate'
        ));
    }

    public function adminExport(Request $request, $format)
    {
        $startDateStr = $request->input('start_date');
        $endDateStr = $request->input('end_date');

        if ($startDateStr && $endDateStr) {
            $startDate = Carbon::parse($startDateStr)->startOfDay();
            $endDate = Carbon::parse($endDateStr)->endOfDay();
        } else {
            $startDate = Carbon::now()->subDays(30)->startOfDay();
            $endDate = Carbon::now()->endOfDay();
        }

        $orders = Order::with('user')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();

        if ($format === 'csv') {
            $filename = "orders_export_" . Carbon::now()->format('Y-m-d') . ".csv";
            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$filename",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $columns = array('Order ID', 'Customer Name', 'Customer Email', 'Date', 'Total Price (₹)', 'Fulfillment Status');

            $callback = function() use($orders, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($orders as $order) {
                    fputcsv($file, array(
                        $order->id,
                        $order->user->name ?? 'Guest User',
                        $order->user->email ?? 'N/A',
                        $order->created_at->format('Y-m-d H:i:s'),
                        $order->total_price,
                        $order->status
                    ));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        return redirect()->back()->with('error', 'Unsupported export format.');
    }
}
