<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock In - Inventory Management</title>
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

        /* Form Styles */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
            font-size: 14px;
        }

        .form-label.required::after {
            content: " *";
            color: #ef4444;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-hint {
            font-size: 12px;
            color: #6b7280;
            margin-top: 6px;
        }

        .select-wrapper {
            position: relative;
        }

        .select-wrapper::after {
            content: "▼";
            font-size: 12px;
            color: #6b7280;
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        /* Material Categories */
        .material-categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .material-category {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .material-category:hover {
            border-color: #3b82f6;
        }

        .material-category.active {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .material-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
        }

        .material-wood .material-icon { background: #8B4513; }
        .material-glass .material-icon { background: #87CEEB; }
        .material-aluminum .material-icon { background: #A9A9A9; }

        .material-name {
            font-weight: 500;
            color: #111827;
        }

        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .items-table th {
            background: #f9fafb;
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            color: #374151;
            font-size: 14px;
            border-bottom: 1px solid #e5e7eb;
        }

        .items-table td {
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }

        .items-table input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
        }

        .items-table input:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .remove-item {
            color: #ef4444;
            cursor: pointer;
            padding: 8px;
            border-radius: 6px;
            transition: background-color 0.2s;
        }

        .remove-item:hover {
            background: #fee2e2;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .btn {
            padding: 12px 24px;
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

        .btn-success {
            background: #10b981;
            color: white;
        }

        .btn-success:hover {
            background: #059669;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #d1d5db;
            color: #374151;
        }

        .btn-outline:hover {
            background: #f9fafb;
        }

        /* Recent Stock Ins */
        .recent-stockins {
            margin-top: 10px;
        }

        .stockin-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border-bottom: 1px solid #f3f4f6;
        }

        .stockin-item:last-child {
            border-bottom: none;
        }

        .stockin-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: #10b981;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .stockin-details {
            flex: 1;
        }

        .stockin-title {
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
        }

        .stockin-info {
            color: #6b7280;
            font-size: 14px;
        }

        .stockin-amount {
            font-weight: 600;
            color: #111827;
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
            
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .material-categories {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
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
                        <h1 class="page-title">Stock In</h1>
                        
                    </div>
                <div class="header">
                    <div>
                        
                    </div>
                </div>

                <!-- Stock In Form -->
                <div class="content-card">
                    <div class="card-header">
                        <h2><i class="fas fa-arrow-down"></i> New Stock In Entry</h2>
                    </div>
                    <div class="card-body">
                        <form id="stockInForm">
                            <div class="form-grid">
                                <!-- Supplier Information -->
                                <div class="form-group">
                                    <label class="form-label required" for="supplier">Supplier</label>
                                    <div class="select-wrapper">
                                        <select id="supplier" class="form-control" required>
                                            <option value="">Select Supplier</option>
                                            <option value="timbercorp">TimberCorp Wood Suppliers</option>
                                            <option value="glassworks">GlassWorks International</option>
                                            <option value="metalco">MetalCo Aluminum</option>
                                            <option value="buildmart">BuildMart Construction</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label required" for="referenceNo">Reference No.</label>
                                    <input type="text" id="referenceNo" class="form-control" placeholder="STK-IN-2024-001" required>
                                </div>

                                <!-- Stock In Details -->
                                <div class="form-group">
                                    <label class="form-label required" for="stockInDate">Stock In Date</label>
                                    <input type="date" id="stockInDate" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="receivedBy">Received By</label>
                                    <input type="text" id="receivedBy" class="form-control" placeholder="Enter receiver name">
                                </div>

                                <!-- Material Category Selection -->
                                <div class="form-group full-width">
                                    <label class="form-label">Material Category</label>
                                    <div class="material-categories">
                                        <div class="material-category material-wood active" data-category="wood">
                                            <div class="material-icon">
                                               <i class="fas fa-tree + fas fa-cube"></i>
                                            </div>
                                            <div class="material-name">Wood</div>
                                        </div>
                                        <div class="material-category material-glass" data-category="glass">
                                            <div class="material-icon">
                                              <i class="fas fa-clone"></i>
                                            </div>
                                            <div class="material-name">Glass</div>
                                        </div>
                                        <div class="material-category material-aluminum" data-category="aluminum">
                                            <div class="material-icon">
                                               <i class="fas fa-industry + fas fa-cube"></i>
                                            </div>
                                            <div class="material-name">Aluminum</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Items to Stock In -->
                                <div class="form-group full-width">
                                    <label class="form-label required">Items to Stock In</label>
                                    <table class="items-table">
                                        <thead>
                                            <tr>
                                                <th>Material</th>
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Unit Price (₱)</th>
                                                <th>Total (₱)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="itemsTableBody">
                                            <tr>
                                                <td>
                                                    <div class="select-wrapper">
                                                        <select class="form-control material-select">
                                                            <option value="">Select Material</option>
                                                            <option value="oak_planks">Oak Wood Planks</option>
                                                            <option value="plywood">Plywood Sheets</option>
                                                            <option value="pine">Pine Timber</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control quantity" value="1" min="1">
                                                </td>
                                                <td>
                                                    <div class="select-wrapper">
                                                        <select class="form-control unit">
                                                            <option value="pcs">Pieces</option>
                                                            <option value="sheets">Sheets</option>
                                                            <option value="kg">Kilograms</option>
                                                            <option value="m">Meters</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control unit-price" value="0" step="0.01" min="0">
                                                </td>
                                                <td>
                                                    <span class="total-price">₱0.00</span>
                                                </td>
                                                <td>
                                                    <div class="remove-item" onclick="removeItem(this)">
                                                        <i class="fas fa-times"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-outline" onclick="addNewItem()" style="margin-top: 15px;">
                                        <i class="fas fa-plus"></i> Add Another Item
                                    </button>
                                </div>

                                <!-- Additional Information -->
                                <div class="form-group full-width">
                                    <label class="form-label" for="notes">Notes</label>
                                    <textarea id="notes" class="form-control" rows="3" placeholder="Additional notes about this stock in..."></textarea>
                                </div>
                            </div>

                            <!-- Summary -->
                            <div class="form-group full-width" style="background: #f9fafb; padding: 20px; border-radius: 8px;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <div style="font-weight: 600; color: #111827; margin-bottom: 5px;">Total Amount</div>
                                        <div style="font-size: 24px; font-weight: 700; color: #10b981;" id="totalAmount">₱0.00</div>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-size: 14px; color: #6b7280; margin-bottom: 5px;">Items: <span id="totalItems">1</span></div>
                                        <div style="font-size: 14px; color: #6b7280;">Total Quantity: <span id="totalQuantity">1</span></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="action-buttons">
                                <button type="button" class="btn btn-outline">
                                    <i class="fas fa-times"></i> Cancel
                                </button>
                                <button type="button" class="btn btn-outline">
                                    <i class="fas fa-save"></i> Save Draft
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check"></i> Complete Stock In
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Recent Stock Ins -->
                <div class="content-card">
                    <div class="card-header">
                        <h2><i class="fas fa-history"></i> Recent Stock Ins</h2>
                    </div>
                    <div class="card-body">
                        <div class="recent-stockins">
                            <div class="stockin-item">
                                <div class="stockin-icon">
                                    <i class="fas fa-tree"></i>
                                </div>
                                <div class="stockin-details">
                                    <div class="stockin-title">Oak Wood Planks</div>
                                    <div class="stockin-info">Ref: STK-IN-2024-015 • TimberCorp Wood Suppliers</div>
                                </div>
                                <div class="stockin-amount">+50 pcs</div>
                            </div>
                            <div class="stockin-item">
                                <div class="stockin-icon" style="background: #87CEEB;">
                                    <i class="fas fa-wine-glass"></i>
                                </div>
                                <div class="stockin-details">
                                    <div class="stockin-title">Tempered Glass Sheets</div>
                                    <div class="stockin-info">Ref: STK-IN-2024-014 • GlassWorks International</div>
                                </div>
                                <div class="stockin-amount">+25 sheets</div>
                            </div>
                            <div class="stockin-item">
                                <div class="stockin-icon" style="background: #A9A9A9;">
                                    <i class="fas fa-industry"></i>
                                </div>
                                <div class="stockin-details">
                                    <div class="stockin-title">Aluminum Rods</div>
                                    <div class="stockin-info">Ref: STK-IN-2024-013 • MetalCo Aluminum</div>
                                </div>
                                <div class="stockin-amount">+100 pcs</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Material category selection
        document.querySelectorAll('.material-category').forEach(category => {
            category.addEventListener('click', function() {
                document.querySelectorAll('.material-category').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                updateMaterialOptions(this.dataset.category);
            });
        });

        // Update material options based on category
        function updateMaterialOptions(category) {
            const materialSelects = document.querySelectorAll('.material-select');
            materialSelects.forEach(select => {
                select.innerHTML = '';
                
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Select Material';
                select.appendChild(defaultOption);

                let materials = [];
                if (category === 'wood') {
                    materials = [
                        { value: 'oak_planks', text: 'Oak Wood Planks' },
                        { value: 'plywood', text: 'Plywood Sheets' },
                        { value: 'pine', text: 'Pine Timber' },
                        { value: 'teak', text: 'Teak Wood' },
                        { value: 'mahogany', text: 'Mahogany Planks' }
                    ];
                } else if (category === 'glass') {
                    materials = [
                        { value: 'tempered', text: 'Tempered Glass Sheets' },
                        { value: 'laminated', text: 'Laminated Glass' },
                        { value: 'float', text: 'Float Glass' },
                        { value: 'mirror', text: 'Mirror Glass' }
                    ];
                } else if (category === 'aluminum') {
                    materials = [
                        { value: 'rods', text: 'Aluminum Rods' },
                        { value: 'sheets', text: 'Aluminum Sheets' },
                        { value: 'profiles', text: 'Aluminum Profiles' },
                        { value: 'tubes', text: 'Aluminum Tubes' }
                    ];
                }

                materials.forEach(material => {
                    const option = document.createElement('option');
                    option.value = material.value;
                    option.textContent = material.text;
                    select.appendChild(option);
                });
            });
        }

        // Add new item row
        function addNewItem() {
            const tbody = document.getElementById('itemsTableBody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>
                    <div class="select-wrapper">
                        <select class="form-control material-select">
                            <option value="">Select Material</option>
                        </select>
                    </div>
                </td>
                <td>
                    <input type="number" class="form-control quantity" value="1" min="1">
                </td>
                <td>
                    <div class="select-wrapper">
                        <select class="form-control unit">
                            <option value="pcs">Pieces</option>
                            <option value="sheets">Sheets</option>
                            <option value="kg">Kilograms</option>
                            <option value="m">Meters</option>
                        </select>
                    </div>
                </td>
                <td>
                    <input type="number" class="form-control unit-price" value="0" step="0.01" min="0">
                </td>
                <td>
                    <span class="total-price">₱0.00</span>
                </td>
                <td>
                    <div class="remove-item" onclick="removeItem(this)">
                        <i class="fas fa-times"></i>
                    </div>
                </td>
            `;
            tbody.appendChild(newRow);
            
            // Update material options for the new row
            const activeCategory = document.querySelector('.material-category.active');
            if (activeCategory) {
                updateMaterialOptions(activeCategory.dataset.category);
            }
            
            updateTotals();
        }

        // Remove item row
        function removeItem(button) {
            const row = button.closest('tr');
            if (document.querySelectorAll('#itemsTableBody tr').length > 1) {
                row.remove();
                updateTotals();
            }
        }

        // Update totals
        function updateTotals() {
            let totalAmount = 0;
            let totalItems = 0;
            let totalQuantity = 0;

            document.querySelectorAll('#itemsTableBody tr').forEach(row => {
                const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
                const unitPrice = parseFloat(row.querySelector('.unit-price').value) || 0;
                const total = quantity * unitPrice;
                
                row.querySelector('.total-price').textContent = `₱${total.toFixed(2)}`;
                totalAmount += total;
                totalItems++;
                totalQuantity += quantity;
            });

            document.getElementById('totalAmount').textContent = `₱${totalAmount.toFixed(2)}`;
            document.getElementById('totalItems').textContent = totalItems;
            document.getElementById('totalQuantity').textContent = totalQuantity;
        }

        // Event listeners for quantity and price changes
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('quantity') || e.target.classList.contains('unit-price')) {
                updateTotals();
            }
        });

        // Form submission
        document.getElementById('stockInForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your form submission logic here
            alert('Stock In completed successfully!');
        });

        // Initialize with current date
        document.getElementById('stockInDate').valueAsDate = new Date();
    </script>
</body>
</html>