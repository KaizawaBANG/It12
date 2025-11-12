<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Sidebar with Profile in Footer</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: #f5f7fa;
        }

        .left-navbar {
            width: 280px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 40;
            background: rgb(255, 255, 255);
            border-right: 1px solid #000000;
            display: flex;
            flex-direction: column;
        }

        .nav-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .scrollable-nav {
            flex: 1;
            overflow-y: auto;
            padding-bottom: 10px;
        }

        .logo-container {
            padding: 15px 20px; 
            text-align: center;
            border-bottom: 1px solid #000000;
            flex-shrink: 0;
        }

        .logo-img {
            max-width: 300px;  
            max-height: 100px;  
            width: auto;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .nav-links {
            padding: 20px 0;
        }

        .nav-item {
            padding: 14px 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            color: #4b5563;
            text-decoration: none;
        }

        .nav-item:hover {
            background-color: #f3f4f6;
            padding-left: 30px;
            color: #111827;
        }

        .nav-item.active {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
            color: #1d4ed8;
        }

        .nav-item i {
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        .nav-item.active i {
            color: #3b82f6;
        }

        .nav-text {
            font-size: 16px;
            font-weight: 500;
        }

        .dropdown-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 12px 20px;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #4b5563;
            font-weight: 500;
        }

        .dropdown-header:hover {
            background-color: #f3f4f6;
            color: #111827;
        }

        .dropdown-content {
            margin-top: 5px;
            margin-left: 20px;
            border-left: 2px solid #e5e7eb;
            padding-left: 10px;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 15px;
            color: #6b7280;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 5px;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #f3f4f6;
            color: #374151;
        }

        .dropdown-item.active {
            background-color: #eff6ff;
            color: #1d4ed8;
        }

        .dropdown-item i {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .profile-footer {
            padding: 20px;
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
            flex-shrink: 0;
        }

        .profile-dropdown {
            position: relative;
        }

        .profile-trigger {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 10px 15px;
            border-radius: 8px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .profile-trigger:hover {
            background-color: #f3f4f6;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
            margin-right: 12px;
        }

        .user-info {
            flex: 1;
            text-align: left;
        }

        .user-name {
            font-weight: 600;
            color: #111827;
            font-size: 14px;
        }

        .user-role {
            color: #6b7280;
            font-size: 12px;
        }

        .dropdown-icon {
            color: #9ca3af;
            transition: transform 0.2s;
        }

        .profile-menu {
            position: absolute;
            bottom: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            overflow: hidden;
            z-index: 50;
        }

        .profile-menu-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: #4b5563;
            text-decoration: none;
            transition: all 0.2s ease;
            border-bottom: 1px solid #f3f4f6;
        }

        .profile-menu-item:last-child {
            border-bottom: none;
        }

        .profile-menu-item:hover {
            background-color: #f9fafb;
            color: #111827;
        }

        .profile-menu-item i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }

        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #111827;
            margin-bottom: 10px;
        }

        .header p {
            color: #6b7280;
        }

        .content-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-header h2 {
            font-size: 20px;
            color: #111827;
        }

        .alert {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            border-radius: 6px;
            margin-top: 20px;
        }

        /* Custom scrollbar for sidebar */
        .scrollable-nav::-webkit-scrollbar {
            width: 6px;
        }

        .scrollable-nav::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .scrollable-nav::-webkit-scrollbar-thumb {
            background: #c5c5c5;
            border-radius: 10px;
        }

        .scrollable-nav::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        @media (max-width: 768px) {
            .left-navbar {
                width: 100%;
                position: relative;
                height: auto;
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <nav x-data="{ 
        userManagementOpen: false,
        inventoryManagementOpen: false,
        profileOpen: false
    }" class="left-navbar">
        <div class="nav-content">
            <div class="scrollable-nav">
                
                <div class="logo-container">
                    <div class="logo">
                        <img src="{{ asset('images/davao.png') }}" alt="Davao Modern Glass and Aluminum Supply Corp" class="logo-img">
                    </div>
                </div>

                <div class="nav-links">
                    <!-- Dashboard -->
                    <a href="dashboard" class="nav-item" data-nav="dashboard">
                        <i class="fas fa-tachometer-alt"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>

                    <!-- User Management Dropdown -->
                    <div class="nav-section">
                        <div @click="userManagementOpen = !userManagementOpen" class="dropdown-header">
                            <div class="flex items-center">
                                <i class="fas fa-users"></i>
                                <span class="ml-3">User Management</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200" 
                               :class="{'rotate-180': userManagementOpen}"></i>
                        </div>
                        
                        <!-- User Management Submenu -->
                        <div x-show="userManagementOpen" x-collapse class="dropdown-content">
                            <a href="{{ route('users.index') }}" class="dropdown-item" data-nav="user-list">
                                <i class="fas fa-list"></i>
                                <span>User List</span>
                            </a>
                          
                            <a href="{{ route('roles-permissions') }}" class="dropdown-item" data-nav="roles-permissions">
                                <i class="fas fa-user-shield"></i>
                                <span>Roles & Permissions</span>
                            </a>
                        </div>
                    </div>

                    <!-- Inventory Management Dropdown -->
                    <div class="nav-section">
                        <div @click="inventoryManagementOpen = !inventoryManagementOpen" class="dropdown-header">
                            <div class="flex items-center">
                                <i class="fas fa-boxes"></i>
                                <span class="ml-3">Inventory Management</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200" 
                               :class="{'rotate-180': inventoryManagementOpen}"></i>
                        </div>
                        
                        <!-- Inventory Management Submenu -->
                        <div x-show="inventoryManagementOpen" x-collapse class="dropdown-content">
                            <a href="{{ route('inventory.productlist') }}" class="dropdown-item" data-nav="product-list">
                                <i class="fas fa-list"></i>
                                <span>Product List</span>
                            </a>
                            <a href="{{ route('StockIn.stockin') }}" class="dropdown-item" data-nav="stock-in">
                                <i class="fas fa-arrow-down"></i>
                                <span>Stock In</span>
                            </a>
                            <a href="{{ route('Stockout.stockout') }}" class="dropdown-item" data-nav="stock-out">
                                <i class="fas fa-arrow-up"></i>
                                <span>Stock Out</span>
                            </a>
                            <a href="{{ route('Stockadjustment.stockadjustment') }}" class="dropdown-item" data-nav="stock-adjustment">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                <span>Stock Adjustment</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Footer -->
            <div class="profile-footer">
                <div class="profile-dropdown" x-data="{ open: false }">
                    <div @click="open = !open" class="profile-trigger">
                        <div class="user-avatar">A</div>
                        <div class="user-info">
                            <div class="user-name">Kane</div>
                            <div class="user-role">Administrator</div>
                        </div>
                        <i class="fas fa-chevron-down dropdown-icon" :class="{'rotate-180': open}"></i>
                    </div>
                    
                    <!-- Profile Dropdown Menu -->
                    <div x-show="open" @click.outside="open = false" class="profile-menu" x-cloak>
                        <a href="#" class="profile-menu-item">
                            <i class="fas fa-user"></i>
                            <span>My Profile</span>
                        </a>
                        <a href="#" class="profile-menu-item">
                            <i class="fas fa-cog"></i>
                            <span>Account Settings</span>
                        </a>
                        <a href="#" class="profile-menu-item">
                            <i class="fas fa-bell"></i>
                            <span>Notifications</span>
                        </a>
                        <div class="border-t border-gray-200"></div>
                        <a href="{{ route('home') }}" class="profile-menu-item text-red-600">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
 
    <script>
        // Enhanced navigation active state management
        document.addEventListener('DOMContentLoaded', function() {
            // Get all navigation items
            const navItems = document.querySelectorAll('.nav-item, .dropdown-item');
            
            // Function to set active state
            function setActiveNavItem(clickedItem) {
                // Remove active class from all nav items
                navItems.forEach(item => {
                    item.classList.remove('active');
                });
                
                // Add active class to clicked item
                clickedItem.classList.add('active');
                
                // If it's a dropdown item, also highlight the parent dropdown header
                if (clickedItem.classList.contains('dropdown-item')) {
                    const dropdownHeader = clickedItem.closest('.nav-section').querySelector('.dropdown-header');
                    dropdownHeader.style.backgroundColor = '#f3f4f6';
                    dropdownHeader.style.color = '#111827';
                }
                
                // Store active state in localStorage for persistence
                const navId = clickedItem.getAttribute('data-nav');
                if (navId) {
                    localStorage.setItem('activeNav', navId);
                }
            }
            
            // Add click event listeners to all nav items
            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    // Prevent default only for demo purposes (remove in production)
                    if (!item.getAttribute('href') || item.getAttribute('href') === '#') {
                        e.preventDefault();
                    }
                    setActiveNavItem(this);
                });
            });
            
            // Check for stored active state on page load
            const activeNavId = localStorage.getItem('activeNav');
            if (activeNavId) {
                const activeNavItem = document.querySelector(`[data-nav="${activeNavId}"]`);
                if (activeNavItem) {
                    activeNavItem.classList.add('active');
                }
            } else {
                // Set dashboard as default active
                const dashboardNav = document.querySelector('[data-nav="dashboard"]');
                if (dashboardNav) {
                    dashboardNav.classList.add('active');
                }
            }
        });
    </script>
</body>
</html>