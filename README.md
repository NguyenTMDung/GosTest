# Laravel Docker

Dự án Laravel tích hợp Docker.  
---

### 1. Clone project
```bash
git clone https://github.com/NguyenTMDung/GosTest.git
cd GosTest
```

### 2. Tạo file .env
Copy file .env.example đổi tên thành .env
```bash
cp .env.example .env
```

### 3. Chạy Docker
```bash
docker-compose up -d --build 
```
sau đó chạy 'docker ps' kiểm tra xem bảo đảm đã có mydung_server và mydung_sql 

### 4. Cài Composer (nếu chưa có thư mục vendor)
```bash
docker exec -it mydung_server composer install
```

### 5. Generate key
```bash
docker exec -it mydung_server php artisan key:generate
```

### 6. Run migration và seed dữ liệu
```bash
docker exec -it mydung_server php artisan migrate --seed
```

🔗 Truy cập
Website: http://localhost

PHP container: mydung_server

MySQL: host 127.0.0.1, port 3308, user mydung, password mydung


```

🐳 Lưu ý: Docker phải được cài trên máy trước. Tải tại: https://www.docker.com/products/docker-desktop
