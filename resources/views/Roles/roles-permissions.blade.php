<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles & Permissions</title>
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

        /* Roles Grid */
        .roles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .role-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            background: white;
            transition: all 0.3s ease;
        }

        .role-card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .role-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .role-title {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
        }

        .user-count {
            color: #6b7280;
            font-size: 14px;
            background: #f3f4f6;
            padding: 4px 8px;
            border-radius: 12px;
        }

        .role-description {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .permissions-list {
            margin-top: 15px;
        }

        .permission-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .permission-item:last-child {
            border-bottom: none;
        }

        .permission-item i {
            font-size: 14px;
            width: 16px;
        }

        .permission-item .fa-check-circle {
            color: #10b981;
        }

        .permission-item .fa-times-circle {
            color: #ef4444;
        }

        .permission-text {
            font-size: 14px;
            color: #374151;
        }

        .role-actions {
            margin-top: 20px;
            display: flex;
            gap: 10px;
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
            
            .roles-grid {
                grid-template-columns: 1fr;
            }
            
            .role-actions {
                flex-direction: column;
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
                        <h1 class="page-title">Roles & Permissions</h1>
                        
                    </div>
                </div>

                <div class="content-card">
                    <div class="card-header">
                        <h2><i class="fas fa-user-shield"></i> System Roles</h2>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Role
                        </button>
                    </div>
                    
                    <div class="card-body">
                        <div class="roles-grid">
                            <!-- Administrator Role -->
                            <div class="role-card">
                                <div class="role-header">
                                    <div class="role-title">Administrator</div>
                                    <div class="user-count">2 users</div>
                                </div>
                                <p class="role-description">
                                    Full system access and control over all features and users.
                                </p>
                                <div class="permissions-list">
                                    <div class="permission-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="permission-text">User Management</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="permission-text">Role Management</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="permission-text">System Settings</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="permission-text">Data Export</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="permission-text">Inventory Management</span>
                                    </div>
                                </div>
                                <div class="role-actions">
                                    <button class="btn btn-outline btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-outline btn-sm">
                                        <i class="fas fa-copy"></i> Duplicate
                                    </button>
                                    <button class="btn btn-outline btn-sm">
                                        <i class="fas fa-users"></i> Manage Users
                                    </button>
                                </div>
                            </div>

                            <!-- Manager Role -->
                            <div class="role-card">
                                <div class="role-header">
                                    <div class="role-title">Manager</div>
                                    <div class="user-count">5 users</div>
                                </div>
                                <p class="role-description">
                                    Can manage users and content but cannot modify system settings.
                                </p>
                                <div class="permissions-list">
                                    <div class="permission-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="permission-text">User Management</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="permission-text">Content Management</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="permission-text">Inventory Management</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-times-circle"></i>
                                        <span class="permission-text">System Settings</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="permission-text">Data Export</span>
                                    </div>
                                </div>
                                <div class="role-actions">
                                    <button class="btn btn-outline btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-outline btn-sm">
                                        <i class="fas fa-copy"></i> Duplicate
                                    </button>
                                    <button class="btn btn-outline btn-sm">
                                        <i class="fas fa-users"></i> Manage Users
                                    </button>
                                </div>
                            </div>

                            <!-- User Role -->
                            <div class="role-card">
                                <div class="role-header">
                                    <div class="role-title">Employee</div>
                                    <div class="user-count">10 Employees</div>
                                </div>
                                <p class="role-description">
                                    Basic access to system features with limited permissions.
                                </p>
                                <div class="permissions-list">
                                    <div class="permission-item">
                                        <i class="fas fa-times-circle"></i>
                                        <span class="permission-text">User Management</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="permission-text">View Content</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="permission-text">View Inventory</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-times-circle"></i>
                                        <span class="permission-text">System Settings</span>
                                    </div>
                                    <div class="permission-item">
                                        <i class="fas fa-times-circle"></i>
                                        <span class="permission-text">Data Export</span>
                                    </div>
                                </div>
                                <div class="role-actions">
                                    <button class="btn btn-outline btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-outline btn-sm">
                                        <i class="fas fa-copy"></i> Duplicate
                                    </button>
                                    <button class="btn btn-outline btn-sm">
                                        <i class="fas fa-users"></i> Manage Users
                                    </button>
                                </div>
                            </div>

                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>