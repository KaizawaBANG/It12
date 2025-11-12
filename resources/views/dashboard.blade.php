<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Material Stocks Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f5f7fa;
            min-height: 100vh;
            display: flex;
        }

        .main-container {
            display: flex;
            flex: 1;
        }

        .content-wrapper {
            flex: 1;
            margin-left: 280px;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
        }

        .page-title {
            font-size: 28px;
            color: #111827;
            font-weight: 600;
        }

        .breadcrumb {
            color: #6b7280;
            font-size: 14px;
        }

        .breadcrumb a {
            color: #3b82f6;
            text-decoration: none;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #8B4513; /* Wood color */
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-card.warning {
            border-left-color: #f59e0b;
        }

        .stat-card.danger {
            border-left-color: #ef4444;
        }

        .stat-card.success {
            border-left-color: #10b981;
        }

        .stat-card.info {
            border-left-color: #3b82f6;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .stat-trend {
            font-size: 14px;
            font-weight: 500;
        }

        .trend-up {
            color: #10b981;
        }

        .trend-down {
            color: #ef4444;
        }

        .stat-label {
            font-size: 14px;
            color: #6b7280;
        }

        /* Charts Grid */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .content-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            background: #f9fafb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            font-size: 18px;
            color: #111827;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header h2 i {
            color: #3b82f6;
        }

        .card-body {
            padding: 24px;
        }

        .chart-container {
            height: 300px;
            position: relative;
        }

        /* Alerts Section */
        .alerts-container {
            max-height: 400px;
            overflow-y: auto;
        }

        .alert-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border-bottom: 1px solid #f3f4f6;
            transition: background-color 0.2s;
        }

        .alert-item:hover {
            background: #f9fafb;
        }

        .alert-item:last-child {
            border-bottom: none;
        }

        .alert-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .alert-icon.critical {
            background: #fee2e2;
            color: #dc2626;
        }

        .alert-icon.warning {
            background: #fef3c7;
            color: #d97706;
        }

        .alert-icon.info {
            background: #dbeafe;
            color: #2563eb;
        }

        .alert-content {
            flex: 1;
        }

        .alert-title {
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
        }

        .alert-description {
            color: #6b7280;
            font-size: 14px;
        }

        .alert-time {
            color: #9ca3af;
            font-size: 12px;
        }

        .alert-badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-critical {
            background: #fee2e2;
            color: #dc2626;
        }

        .badge-warning {
            background: #fef3c7;
            color: #d97706;
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            color: inherit;
        }

        .action-btn:hover {
            border-color: #3b82f6;
            background: #f8fafc;
            transform: translateY(-1px);
        }

        .action-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: #8B4513; /* Wood color */
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .action-text {
            font-weight: 500;
            color: #111827;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #d1d5db;
            color: #374151;
        }

        .btn-outline:hover {
            background: #f9fafb;
        }

        /* Material Category Colors */
        .material-wood { color: #8B4513; }
        .material-glass { color: #87CEEB; }
        .material-aluminum { color: #A9A9A9; }

        @media (max-width: 1024px) {
            .content-wrapper {
                margin-left: 0;
            }
            
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .content-wrapper {
                padding: 15px;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .quick-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Sidebar Navigation -->
        @include('layouts.navigation')
        
        <!-- Main Content -->
        <div class="content-wrapper">
            <div class="container">
                <div class="header">
                    <div>
                        <h1 class="page-title">Admin Dashboard</h1>
                    </div>
                    <div class="header-actions">
                        <button class="btn btn-outline">
                            <i class="fas fa-sync-alt"></i> Refresh Data
                        </button>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-value">
                            ₱2,847,890
                            <span class="stat-trend trend-up">+8.5%</span>
                        </div>
                        <div class="stat-label">Total Material Value</div>
                    </div>
                    <div class="stat-card success">
                        <div class="stat-value">
                            856
                            <span class="stat-trend trend-up">+3.2%</span>
                        </div>
                        <div class="stat-label">Total Material Items</div>
                    </div>
                    <div class="stat-card warning">
                        <div class="stat-value">
                            28
                            <span class="stat-trend trend-down">-2.1%</span>
                        </div>
                        <div class="stat-label">Low Stock Materials</div>
                    </div>
                    <div class="stat-card danger">
                        <div class="stat-value">
                            5
                            <span class="stat-trend trend-up">+1.0%</span>
                        </div>
                        <div class="stat-label">Out of Stock</div>
                    </div>
                </div>

                <!-- Charts Grid -->
                <div class="charts-grid">
                    <!-- Material Value Chart -->
                    <div class="content-card">
                        <div class="card-header">
                            <h2><i class="fas fa-chart-line"></i> Material Value Trend</h2>
                            <div class="chart-controls">
                                <button class="btn btn-outline btn-sm">1M</button>
                                <button class="btn btn-outline btn-sm">3M</button>
                                <button class="btn btn-outline btn-sm active">1Y</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="materialValueChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Material Alerts -->
                    <div class="content-card">
                        <div class="card-header">
                            <h2><i class="fas fa-bell"></i> Material Alerts</h2>
                            <span class="alert-badge badge-critical">5 Critical</span>
                        </div>
                        <div class="card-body">
                            <div class="alerts-container">
                                <div class="alert-item">
                                    <div class="alert-icon critical">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="alert-content">
                                        <div class="alert-title"><span class="material-wood">Oak Wood Planks</span> - Out of Stock</div>
                                        <div class="alert-description">Stock level: 0 units</div>
                                        <div class="alert-time">4 hours ago</div>
                                    </div>
                                </div>
                                <div class="alert-item">
                                    <div class="alert-icon critical">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="alert-content">
                                        <div class="alert-title"><span class="material-glass">Tempered Glass Sheets</span> - Critical Low</div>
                                        <div class="alert-description">Only 8 units remaining</div>
                                        <div class="alert-time">6 hours ago</div>
                                    </div>
                                </div>
                                <div class="alert-item">
                                    <div class="alert-icon warning">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </div>
                                    <div class="alert-content">
                                        <div class="alert-title"><span class="material-aluminum">Aluminum Rods</span> - Low Stock</div>
                                        <div class="alert-description">15 units remaining</div>
                                        <div class="alert-time">1 day ago</div>
                                    </div>
                                </div>
                                <div class="alert-item">
                                    <div class="alert-icon info">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <div class="alert-content">
                                        <div class="alert-title"><span class="material-wood">Plywood Sheets</span> - Reorder Suggested</div>
                                        <div class="alert-description">Stock below reorder level</div>
                                        <div class="alert-time">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Charts Row -->
                <div class="charts-grid">
                    <!-- Material Movement Chart -->
                    <div class="content-card">
                        <div class="card-header">
                            <h2><i class="fas fa-warehouse"></i> Material Movement</h2>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="materialMovementChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Material Distribution -->
                    <div class="content-card">
                        <div class="card-header">
                            <h2><i class="fas fa-chart-pie"></i> Stock by Material Type</h2>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="materialChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Material Breakdown -->
                <div class="content-card">
                    <div class="card-header">
                        <h2><i class="fas fa-boxes"></i> Material Stock Breakdown</h2>
                    </div>
                    <div class="card-body">
                        <div class="stats-grid">
                            <div class="stat-card" style="border-left-color: #8B4513;">
                                <div class="stat-value">
                                    425
                                    <span class="stat-trend trend-up">+4.2%</span>
                                </div>
                                <div class="stat-label"><span class="material-wood">Wood Items</span></div>
                                <div style="font-size: 12px; color: #6b7280; margin-top: 8px;">
                                    Oak, Pine, Teak, Plywood
                                </div>
                            </div>
                            <div class="stat-card" style="border-left-color: #87CEEB;">
                                <div class="stat-value">
                                    268
                                    <span class="stat-trend trend-up">+6.8%</span>
                                </div>
                                <div class="stat-label"><span class="material-glass">Glass Items</span></div>
                                <div style="font-size: 12px; color: #6b7280; margin-top: 8px;">
                                    Tempered, Laminated, Float
                                </div>
                            </div>
                            <div class="stat-card" style="border-left-color: #A9A9A9;">
                                <div class="stat-value">
                                    163
                                    <span class="stat-trend trend-up">+2.1%</span>
                                </div>
                                <div class="stat-label"><span class="material-aluminum">Aluminum Items</span></div>
                                <div style="font-size: 12px; color: #6b7280; margin-top: 8px;">
                                    Sheets, Rods, Profiles, Tubes
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="content-card">
                    <div class="card-header">
                        <h2><i class="fas fa-bolt"></i> Quick Actions</h2>
                    </div>
                    <div class="card-body">
                        <div class="quick-actions">
                            <a href="" class="action-btn">
                                <div class="action-icon" style="background: #10b981;">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="action-text">Add New User</div>
                            </a>
                            <a href="#" class="action-btn">
                                <div class="action-icon" style="background: #8B4513;">
                                    <i class="fas fa-tree"></i>
                                </div>
                                <div class="action-text">Add Wood Material</div>
                            </a>
                            <a href="#" class="action-btn">
                                <div class="action-icon" style="background: #87CEEB;">
                                    <i class="fas fa-wine-glass"></i>
                                </div>
                                <div class="action-text">Add Glass Material</div>
                            </a>
                            <a href="#" class="action-btn">
                                <div class="action-icon" style="background: #A9A9A9;">
                                    <i class="fas fa-industry"></i>
                                </div>
                                <div class="action-text">Add Aluminum Material</div>
                            </a>
                            <a href="#" class="action-btn">
                                <div class="action-icon" style="background: #06b6d4;">
                                    <i class="fas fa-file-export"></i>
                                </div>
                                <div class="action-text">Export Material Report</div>
                            </a>
                            <a href="#" class="action-btn">
                                <div class="action-icon" style="background: #84cc16;">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <div class="action-text">Material Settings</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Material Value Chart
        const materialValueCtx = document.getElementById('materialValueChart').getContext('2d');
        const materialValueChart = new Chart(materialValueCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Material Value (₱)',
                    data: [2500000, 2650000, 2580000, 2700000, 2850000, 2900000, 2880000, 2920000, 2950000, 2980000, 3000000, 3040000],
                    borderColor: '#8B4513',
                    backgroundColor: 'rgba(139, 69, 19, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            callback: function(value) {
                                return '₱' + (value / 1000000).toFixed(1) + 'M';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Material Movement Chart
        const materialMovementCtx = document.getElementById('materialMovementChart').getContext('2d');
        const materialMovementChart = new Chart(materialMovementCtx, {
            type: 'bar',
            data: {
                labels: ['Wood', 'Glass', 'Aluminum'],
                datasets: [{
                    label: 'Material In',
                    data: [320, 180, 120],
                    backgroundColor: '#10b981',
                    borderColor: '#10b981',
                    borderWidth: 1
                }, {
                    label: 'Material Out',
                    data: [280, 150, 95],
                    backgroundColor: '#ef4444',
                    borderColor: '#ef4444',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Material Distribution Chart
        const materialCtx = document.getElementById('materialChart').getContext('2d');
        const materialChart = new Chart(materialCtx, {
            type: 'doughnut',
            data: {
                labels: ['Wood', 'Glass', 'Aluminum'],
                datasets: [{
                    data: [45, 35, 20],
                    backgroundColor: [
                        '#8B4513',
                        '#87CEEB',
                        '#A9A9A9'
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                cutout: '60%'
            }
        });

        // Chart control buttons
        document.querySelectorAll('.chart-controls .btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.chart-controls .btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>