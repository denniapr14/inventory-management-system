<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management API Documentation</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1, h2, h3 {
            color: #2c3e50;
        }
        h1 {
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        h2 {
            background-color: #f8f9fa;
            padding: 10px;
            border-left: 4px solid #3498db;
        }
        .endpoint {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid #2ecc71;
        }
        .method {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 3px;
            font-weight: bold;
            color: white;
            margin-right: 10px;
        }
        .get { background-color: #3498db; }
        .post { background-color: #2ecc71; }
        .put { background-color: #f39c12; }
        .patch { background-color: #9b59b6; }
        .delete { background-color: #e74c3c; }
        pre {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .auth-note {
            background-color: #fff8e1;
            padding: 10px;
            border-left: 4px solid #ffc107;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <h1>Inventory Management API Documentation</h1>
    <p>API for inventory management with Laravel 11 and Sanctum Authentication.</p>

    <div class="auth-note">
        <strong>Authentication:</strong> Most endpoints require Bearer Token authentication. Obtain a token by logging in or registering.
    </div>

    <h2>Authentication</h2>
    
    <div class="endpoint">
        <h3><span class="method post">POST</span> /api/login</h3>
        <p>Authenticate user and get access token.</p>
        
        <h4>Request Body</h4>
        <pre>{
    "email": "admin@gmail.com",
    "password": "password"
}</pre>
    </div>

    <div class="endpoint">
        <h3><span class="method post">POST</span> /api/register</h3>
        <p>Register a new user.</p>
        
        <h4>Request Body</h4>
        <pre>{
    "name": "Nama User",
    "email": "user@example.com",
    "password": "password",
    "password_confirmation": "password"
}</pre>
    </div>

    <div class="endpoint">
        <h3><span class="method get">GET</span> /api/me</h3>
        <p>Get authenticated user's profile.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
    </div>

    <h2>Products</h2>

    <div class="endpoint">
        <h3><span class="method get">GET</span> /api/produk</h3>
        <p>Get list of all products.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
    </div>

    <div class="endpoint">
        <h3><span class="method get">GET</span> /api/produk/{id}</h3>
        <p>Get details of a specific product.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
    </div>

    <div class="endpoint">
        <h3><span class="method post">POST</span> /api/produk</h3>
        <p>Create a new product.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
        <h4>Request Body</h4>
        <pre>{
    "nama_produk": "Produk A",
    "kode_produk": "PRD001",
    "kategori": "Elektronik",
    "satuan": "pcs",
    "deskripsi": "Deskripsi produk",
    "harga": 100000
}</pre>
    </div>

    <div class="endpoint">
        <h3><span class="method patch">PATCH</span> /api/produk/{id}</h3>
        <p>Update a product.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
        <h4>Request Body</h4>
        <pre>{
    "nama_produk": "Produk A[UPDATED]",
    "kode_produk": "PRD006432",
    "kategori": "Elektronik",
    "satuan": "pcs",
    "deskripsi": "Deskripsi produk",
    "harga": 100000
}</pre>
    </div>

    <div class="endpoint">
        <h3><span class="method delete">DELETE</span> /api/produk/{id}</h3>
        <p>Delete a product.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
    </div>

    <div class="endpoint">
        <h3><span class="method get">GET</span> /api/produk/{id}/mutasi</h3>
        <p>Get mutation history for a product.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
    </div>

    <h2>Locations</h2>

    <div class="endpoint">
        <h3><span class="method get">GET</span> /api/lokasi</h3>
        <p>Get list of all locations.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
    </div>

    <div class="endpoint">
        <h3><span class="method post">POST</span> /api/lokasi</h3>
        <p>Create a new location.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
        <h4>Request Body</h4>
        <pre>{
    "kode_lokasi": "L001",
    "nama_lokasi": "Gudang Utama",
    "alamat": "Jl. Gudang No. 1",
    "kota": "Jakarta",
    "provinsi": "DKI Jakarta",
    "kode_pos": "12345"
}</pre>
    </div>

    <div class="endpoint">
        <h3><span class="method get">GET</span> /api/lokasi/{id}</h3>
        <p>Get details of a specific location.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
    </div>

    <div class="endpoint">
        <h3><span class="method patch">PATCH</span> /api/lokasi/{id}</h3>
        <p>Update a location.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
        <h4>Request Body</h4>
        <pre>{
    "kode_lokasi": "L003213",
    "nama_lokasi": "Gudang Utama",
    "alamat": "Jl. Gudang No. 1",
    "kota": "Jakarta",
    "provinsi": "DKI Jakarta",
    "kode_pos": "12345"
}</pre>
    </div>

    <div class="endpoint">
        <h3><span class="method delete">DELETE</span> /api/lokasi/{id}</h3>
        <p>Delete a location.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
    </div>

    <h2>Product Locations</h2>

    <div class="endpoint">
        <h3><span class="method get">GET</span> /api/produk-lokasi</h3>
        <p>Get list of products at locations.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
    </div>

    <div class="endpoint">
        <h3><span class="method get">GET</span> /api/produk-lokasi/{id}</h3>
        <p>Get details of a product at a specific location.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
    </div>

    <div class="endpoint">
        <h3><span class="method patch">PATCH</span> /api/produk-lokasi/{id}</h3>
        <p>Update stock of a product at a location.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
        <h4>Request Body</h4>
        <pre>{
    "stok": 20
}</pre>
    </div>

    <h2>Mutations</h2>

    <div class="endpoint">
        <h3><span class="method get">GET</span> /api/mutasi</h3>
        <p>Get list of stock mutations.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
    </div>

    <div class="endpoint">
        <h3><span class="method post">POST</span> /api/mutasi</h3>
        <p>Create a new stock mutation.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
        <h4>Request Body</h4>
        <pre>{
    "tanggal": "2023-10-15",
    "jenis_mutasi": "masuk",
    "jumlah": 5,
    "keterangan": "Penambahan stok baru",
    "produk_lokasi_id": 1
}</pre>
    </div>

    <div class="endpoint">
        <h3><span class="method get">GET</span> /api/mutasi/{id}</h3>
        <p>Get details of a specific mutation.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
    </div>

    <div class="endpoint">
        <h3><span class="method patch">PATCH</span> /api/mutasi/{id}</h3>
        <p>Update a mutation.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
    </div>

    <div class="endpoint">
        <h3><span class="method delete">DELETE</span> /api/mutasi/{id}</h3>
        <p>Delete a mutation.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
    </div>

    <div class="endpoint">
        <h3><span class="method get">GET</span> /api/mutasi/history</h3>
        <p>Get mutation history.</p>
        <p><strong>Headers:</strong> Authorization: Bearer {token}</p>
    </div>

    <h2>Installation</h2>
    <pre>
# Clone the repository
git clone https://github.com/username/inventory-api.git
cd inventory-api

# Install dependencies
composer install
npm install

# Create .env file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_api
DB_USERNAME=root
DB_PASSWORD=

# Run migrations
php artisan migrate

# Install Sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

# Start the server
php artisan serve
    </pre>
</body>
</html>
