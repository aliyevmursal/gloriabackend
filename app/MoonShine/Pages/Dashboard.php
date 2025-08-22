<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use MoonShine\Apexcharts\Components\DonutChartMetric;
use MoonShine\Apexcharts\Components\LineChartMetric;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Metrics\Wrapped\ValueMetric;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use Illuminate\Support\Facades\DB;
#[\MoonShine\MenuManager\Attributes\SkipMenu]

class Dashboard extends Page
{
    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle()
        ];
    }

    public function getTitle(): string
    {
        return $this->title ?: 'Dashboard';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        // Basic stats
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalBlogs = Blog::count();
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'delivered')->count();
        $totalRevenue = (float) Order::where('status', 'delivered')->sum('total_price');

        // Monthly revenue
        $monthlyRevenue = (float) Order::where('status', 'delivered')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_price');

        // Sales chart data (last 30 days)
        $salesData = Order::query()
            ->selectRaw('SUM(total_price) as sum, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
            ->groupBy('date')
            ->where('status', 'delivered')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->pluck('sum', 'date')
            ->toArray();

        // Create array with last 30 days, all with 0 value
        $last30Days = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('d.m.Y');
            $last30Days[$date] = 0;
        }

        // Merge actual sales data with last 30 days
        $salesData = array_merge($last30Days, $salesData);


        // Order status distribution
        $orderStatusData = Order::query()
            ->selectRaw('CONCAT(UPPER(LEFT(status, 1)), LOWER(SUBSTRING(status, 2))) as status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();

        // Ensure all statuses are present with 0 count if no orders
        $allStatuses = [
            'Pending' => 0,
            'Confirmed' => 0,
            'Preparing' => 0,
            'Prepared' => 0,
            'Shipped' => 0,
            'Delivered' => 0,
            'Returned' => 0,
            'Cancelled' => 0
        ];

        // Merge actual data with all statuses
        $orderStatusData = array_merge($allStatuses, $orderStatusData);

        // Define colors for each status
        $statusColors = [
            '#ffcc00',      // Yellow - Pending
            '#00bb00',      // Green - Confirmed
            '#ff9900',      // Orange - Preparing
            '#0066cc',      // Blue - Prepared
            '#9933cc',      // Purple - Shipped
            '#00cc66',      // Light Green - Delivered
            '#ff6600',      // Red-Orange - Returned
            '#cc0000'       // Red - Cancelled
        ];

        // Recent orders
        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return [
            Grid::make([
                Column::make([
                    Grid::make([
                        Column::make([
                            ValueMetric::make('Total Products')
                                ->value($totalProducts)
                                ->icon('cube'),
                        ])->columnSpan(3),

                        Column::make([
                            ValueMetric::make('Total Categories')
                                ->value($totalCategories)
                                ->icon('tag'),
                        ])->columnSpan(3),

                        Column::make([
                            ValueMetric::make('Total Blogs')
                                ->value($totalBlogs)
                                ->icon('document-text'),
                        ])->columnSpan(3),

                        Column::make([
                            ValueMetric::make('Total Users')
                                ->value($totalUsers)
                                ->icon('users'),
                        ])->columnSpan(3),
                    ]),

                    Grid::make([
                        Column::make([
                            ValueMetric::make('Total Orders')
                                ->value($totalOrders)
                                ->icon('shopping-bag'),
                        ])->columnSpan(3),

                        Column::make([
                            ValueMetric::make('Pending Orders')
                                ->value($pendingOrders)
                                ->icon('clock'),
                        ])->columnSpan(3),

                        Column::make([
                            ValueMetric::make('Completed Orders')
                                ->value($completedOrders)
                                ->icon('check-circle'),
                        ])->columnSpan(3),

                        Column::make([
                            ValueMetric::make('Total Revenue')
                                ->value('$' . number_format($totalRevenue, 2))
                                ->icon('currency-dollar'),
                        ])->columnSpan(3),
                    ]),

                    Grid::make([
                        Column::make([
                            ValueMetric::make('Monthly Revenue')
                                ->value('$' . number_format($monthlyRevenue, 2))
                                ->icon('chart-bar'),
                        ])->columnSpan(6),

                        Column::make([
                            ValueMetric::make('Average Order Value')
                                ->value('$' . number_format($completedOrders > 0 ? $totalRevenue / $completedOrders : 0, 2))
                                ->icon('calculator'),
                        ])->columnSpan(6),
                    ]),

                    Grid::make([
                        Column::make([
                            LineChartMetric::make('Sales Revenue (Last 30 Days)')
                                ->line([
                                    'Revenue' => $salesData,
                                ], 'date')
                                ->columnSpan(8),
                        ])->columnSpan(8),

                        Column::make([
                            DonutChartMetric::make('Order Status Distribution')
                                ->values($orderStatusData)
                                ->colors($statusColors),
                        ])->columnSpan(4),
                    ]),

                    Box::make('Recent Orders', [
                        TableBuilder::make()
                            ->items($recentOrders)
                            ->fields([
                                Text::make('ID', 'id'),
                                Text::make('User', formatted: fn($order) => $order->user->full_name ?? 'N/A'),
                                Number::make('Total', 'total_price', formatted: fn($value) => '$' . number_format((float) $value->total_price, 2)),
                                Text::make('Status', 'status', formatted: fn($value) => ucfirst($value->status)),
                                Date::make('Date', 'created_at')->format('d.m.Y H:i'),
                            ])
                    ])
                ])
            ])
        ];
    }
}
