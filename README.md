# Inventory Management System

Sistem manajemen inventori yang dibangun dengan Laravel 11, dilengkapi dengan REST API dan interface web menggunakan Bootstrap.

## Fitur Utama

- **Manajemen Produk**: CRUD produk dengan kategori, satuan, dan harga
- **Manajemen Lokasi**: CRUD lokasi penyimpanan produk
- **Manajemen Stok**: Sistem many-to-many antara produk dan lokasi dengan pivot stok
- **Mutasi Stok**: Pencatatan keluar masuk barang dengan otomatisasi stok
- **REST API**: API lengkap dengan authentication Bearer Token
- **Web Interface**: Dashboard dan CRUD interface dengan Bootstrap
- **Authentication**: Login/register untuk web dan API
- **History Tracking**: Riwayat mutasi per produk dan per user

## Tech Stack

- **Backend**: Laravel 11
- **Database**: SQLite (default), MySQL (production)
- **Authentication**: Laravel Sanctum
- **Frontend**: Blade Templates + Bootstrap 5
- **API**: RESTful API dengan JSON response
- **Containerization**: Docker + Nginx + PHP-FPM

## Model & Relasi

### Models
1. **User** - Pengguna sistem
2. **Produk** - Master data produk
3. **Lokasi** - Master data lokasi
4. **Mutasi** - Transaksi keluar masuk barang

### Relasi
- **Produk ↔ Lokasi**: Many-to-Many dengan pivot table `produk_lokasi` (menyimpan stok)
- **Mutasi → User**: Many-to-One 
- **Mutasi → ProdukLokasi**: Many-to-One
- **ProdukLokasi**: Pivot model dengan relasi ke Produk dan Lokasi

## Instalasi & Setup

### 1. Clone Repository
```bash
git clone <repository-url>
cd inventory-system
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup
```bash
# Untuk SQLite (default)
touch database/database.sqlite

# Jalankan migrasi dan seeder
php artisan migrate --seed
```

### 5. Setup Sanctum
```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

### 6. Jalankan Aplikasi
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

### Default Login
- **Email**: admin@inventory.com
- **Password**: password

## Endpoints API

### Authentication
- `POST /api/login` - Login dan generate token
- `POST /api/register` - Registrasi user baru
- `GET /api/me` - Get user profile
- `POST /api/logout` - Logout

### Produk
- `GET /api/produk` - List semua produk
- `POST /api/produk` - Tambah produk baru
- `GET /api/produk/{id}` - Detail produk
- `PUT /api/produk/{id}` - Update produk
- `DELETE /api/produk/{id}` - Hapus produk
- `GET /api/produk/{id}/mutasi` - History mutasi produk

### Lokasi
- `GET /api/lokasi` - List semua lokasi
- `POST /api/lokasi` - Tambah lokasi baru
- `GET /api/lokasi/{id}` - Detail lokasi
- `PUT /api/lokasi/{id}` - Update lokasi
- `DELETE /api/lokasi/{id}` - Hapus lokasi

### Mutasi
- `GET /api/mutasi` - List semua mutasi
- `POST /api/mutasi` - Tambah mutasi baru
- `GET /api/mutasi/{id}` - Detail mutasi
- `PUT /api/mutasi/{id}` - Update mutasi
- `DELETE /api/mutasi/{id}` - Hapus mutasi
- `GET /api/mutasi/user/history` - History mutasi user

### Produk Lokasi
- `GET /api/produk-lokasi` - List relasi produk-lokasi
- `POST /api/produk-lokasi` - Tambah relasi baru
- `GET /api/produk-lokasi/{id}` - Detail relasi
- `PUT /api/produk-lokasi/{id}` - Update stok
- `DELETE /api/produk-lokasi/{id}` - Hapus relasi

## Penggunaan API

### 1. Login untuk mendapatkan token
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@inventory.com",
    "password": "password"
  }'
```

### 2. Gunakan token untuk request berikutnya
```bash
curl -X GET http://localhost:8000/api/produk \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

### 3. Contoh tambah mutasi
```bash
curl -X POST http://localhost:8000/api/mutasi \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -d '{
    "tanggal": "2024-01-15",
    "jenis_mutasi": "masuk",
    "jumlah": 10,
    "keterangan": "Pembelian bulanan",
    "produk_lokasi_id": 1
  }'
```

## Docker Deployment

### 1. Build Docker Image
```bash
docker build -t inventory-system .
```

### 2. Run Container
```bash
docker run -d -p 8080:80 --name inventory-app inventory-system
```

### 3. Setup Database dalam Container
```bash
docker exec -it inventory-app php artisan migrate --seed
```

Aplikasi akan tersedia di `http://localhost:8080`

## Dokumentasi API Postman

Dokumentasi lengkap API tersedia di Postman Collection:

**[📖 Postman Documentation](https://documenter.getpostman.com/view/your-collection-id/your-collection-name)**

Collection mencakup:
- Authentication endpoints
- CRUD operations untuk semua model
- History tracking endpoints
- Contoh request/response
- Environment variables setup

### Import Collection
1. Buka Postman
2. Import collection dari link di atas
3. Setup environment variable:
   - `base_url`: http://localhost:8000
   - `token`: (akan diset otomatis setelah login)

## Struktur Database

```sql
-- Tabel produk
CREATE TABLE produk (
    id BIGINT PRIMARY KEY,
    nama_produk VARCHAR(255),
    kode_produk VARCHAR(255) UNIQUE,
    kategori VARCHAR(255),
    satuan VARCHAR(255),
    harga DECIMAL(10,2),
    deskripsi TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Tabel lokasi
CREATE TABLE lokasi (
    id BIGINT PRIMARY KEY,
    kode_lokasi VARCHAR(255) UNIQUE,
    nama_lokasi VARCHAR(255),
    alamat TEXT,
    pic VARCHAR(255),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);


-- Tabel pivot produk_lokasi (menyimpan stok)
CREATE TABLE produk_lokasi (
    id BIGINT PRIMARY KEY,
    produk_id BIGINT,
    lokasi_id BIGINT,
    stok INTEGER DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    UNIQUE(produk_id, lokasi_id)
);

-- Tabel mutasi
CREATE TABLE mutasi (
    id BIGINT PRIMARY KEY,
    tanggal DATE,
    jenis_mutasi ENUM('masuk', 'keluar'),
    jumlah INTEGER,
    keterangan TEXT,
    user_id BIGINT,
    produk_lokasi_id BIGINT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

## Fitur Khusus

### 1. Auto Stock Update
- Ketika mutasi dibuat/diupdate/dihapus, stok otomatis terupdate
- Validasi stok untuk mutasi keluar
- History tracking lengkap

### 2. Web Interface
- Dashboard dengan statistik
- CRUD interface yang user-friendly
- Responsive design dengan Bootstrap
- Form validation dan error handling

### 3. API Security
- Bearer token authentication
- Rate limiting
- Input validation
- Proper error responses

### 4. Docker Ready
- Multi-stage Dockerfile
- Nginx + PHP-FPM configuration
- Production-ready setup
- Easy deployment

## Testing

### Manual Testing
1. Test semua endpoint API dengan Postman
2. Test web interface functionality
3. Test mutasi stock calculation
4. Test authentication flow

### Automated Testing
```bash
php artisan test
```

## Contributing

1. Fork repository
2. Create feature branch
3. Commit changes
4. Push to branch
5. Create Pull Request

## Support

Untuk pertanyaan atau bantuan:
- Email: developer@inventory.com
- Issues: [GitHub Issues](repository-url/issues)

## License

This project is licensed under the MIT License.
