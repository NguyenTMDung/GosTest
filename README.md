# Laravel Docker

Dự án Laravel tích hợp Docker.
---

### 1. Clone project
```bash
git clone https://github.com/NguyenTMDung/GosTest.git
cd GosTest

2. Tạo file .env
cp .env.example .env

3. Tạo file docker-compose.yaml ở thư mục gốc:
services:
  mydung_server:
    build:
      context: .
      dockerfile: ./docker/dockerfile
    container_name: mydung_server
    working_dir: /var/www/html
    ports:
      - "80:80"
    volumes:
      - .:/var/www/html
      - ./docker/nginx_log:/var/log/nginx
      - ./docker/php-fpm/php-fpm.log:/var/log/php-fpm.log
      - ./docker/config/app.conf:/etc/nginx/conf.d/default.conf

  mysql:
    image: mysql:5.7  
    container_name: mydung_mysql
    environment:
      MYSQL_ROOT_PASSWORD: 
      MYSQL_DATABASE: mydung
      MYSQL_USER: mydung
      MYSQL_PASSWORD: mydung  
    ports:
      - "3308:3306"
    volumes:
      - ./docker/mysql:/var/lib/mysql

4. Chạy Docker
docker-compose up -d --build

5. Cài Composer
Nếu chưa có vendor, chạy trong container:
docker exec -it mydung_server composer install

6. Generate key
docker exec -it mydung_server php artisan key:generate

7. Run migration và seed dữ liệu 
docker exec -it mydung_server php artisan migrate --seed

🔗 Truy cập
Website: http://localhost

PHP container: mydung_server

MySQL: dùng host 127.0.0.1, port 3308, user mydung, password mydung

📁 Cấu trúc Docker
.
├── docker/
│   ├── dockerfile
│   ├── config/
│   │   └── app.conf      # Nginx config
│   ├── php-fpm/
│   │   └── php-fpm.log
│   ├── mysql/            # MySQL data
│   └── nginx_log/        # Nginx log

🧹 Các lệnh thường dùng
# Dừng container
docker-compose down

# Xem logs
docker-compose logs -f

# Truy cập container PHP
docker exec -it mydung_server bash
Docker phải được cài trên máy trước (https://www.docker.com/products/docker-desktop)

