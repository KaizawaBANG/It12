<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            margin-left: 280px; /* Sidebar width */
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

        .content-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
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
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Action Bar */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-box {
            position: relative;
            width: 300px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
        }

        .search-box i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
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

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #d1d5db;
            color: #374151;
        }

        .btn-outline:hover {
            background: #f9fafb;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        /* Table */
        .table-container {
            overflow-x: auto;
            flex: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        th {
            background: #f9fafb;
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            color: #374151;
            font-size: 14px;
            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }

        tr:hover {
            background: #f9fafb;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #3b82f6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
        }

        .user-details h4 {
            color: #111827;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .user-details span {
            color: #6b7280;
            font-size: 12px;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-active {
            background: #d1fae5;
            color: #065f46;
        }

        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .role-badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
        }

        .role-admin {
            background: #fef3c7;
            color: #92400e;
        }

        .role-user {
            background: #dbeafe;
            color: #1e40af;
        }

        .role-manager {
            background: #f3e8ff;
            color: #6b21a8;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .pagination-info {
            color: #6b7280;
            font-size: 14px;
        }

        .pagination-controls {
            display: flex;
            gap: 8px;
        }

        .page-btn {
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            background: white;
            color: #374151;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .page-btn.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .page-btn:hover:not(.active) {
            background: #f9fafb;
        }

        @media (max-width: 1024px) {
            .content-wrapper {
                margin-left: 0;
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
            
            .action-bar {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }
            
            .search-box {
                width: 100%;
            }
            
            .table-container {
                font-size: 12px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .pagination {
                flex-direction: column;
                gap: 15px;
                align-items: center;
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
            <div>
                        <h1 class="page-title">User List</h1>
                        
                    </div>
                <div class="header">
                    <div>
                        
                    </div>
                </div>

                <!-- User List Card -->
                <div class="content-card">
                    <div class="card-header">
                        <h2><i class="fas fa-users"></i> System Users</h2>
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> Add User
                        </a>
                    </div>
                    
                    <div class="card-body">
                        <div class="action-bar">
                            <div class="search-box">
                                <input type="text" placeholder="Search users...">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="filter-buttons">
                                <button class="btn btn-outline">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                <button class="btn btn-outline">
                                    <i class="fas fa-download"></i> Export
                                </button>
                            </div>
                        </div>

                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Last Login</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="user-info">
                                                <div class="user-avatar">JD</div>
                                                <div class="user-details">
                                                    <h4>John Doe</h4>
                                                    <span>john.doe@company.com</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="role-badge role-admin">Administrator</span></td>
                                        <td><span class="status-badge status-active">Active</span></td>
                                        <td>2 hours ago</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-outline btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-outline btn-sm">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="user-info">
                                                <div class="user-avatar">AS</div>
                                                <div class="user-details">
                                                    <h4>Alice Smith</h4>
                                                    <span>alice.smith@company.com</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="role-badge role-manager">Manager</span></td>
                                        <td><span class="status-badge status-active">Active</span></td>
                                        <td>1 day ago</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-outline btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-outline btn-sm">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="user-info">
                                                <div class="user-avatar">BJ</div>
                                                <div class="user-details">
                                                    <h4>Bob Johnson</h4>
                                                    <span>bob.johnson@company.com</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="role-badge role-user">User</span></td>
                                        <td><span class="status-badge status-inactive">Inactive</span></td>
                                        <td>1 week ago</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-outline btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-outline btn-sm">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="pagination">
                            <div class="pagination-info">
                                Showing 1 to 3 of 3 entries
                            </div>
                            <div class="pagination-controls">
                                <button class="page-btn active">1</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>