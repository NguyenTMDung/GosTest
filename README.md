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
### 3. Tạo file docker-compose.yaml ở thư mục gốc với nội dung:
```bash
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
```

### 4. Tạo file docker/config/app.conf với nội dung
```bash
server {
    listen 80;
    server_name localhost;

    root /var/www/html/public;
    index index.php index.html index.htm;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass 127.0.0.1:9000; 
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }


    location ~ /\.ht {
        deny all;
    }
}
```

### 5. Chạy Docker
```bash
docker-compose up -d --build 
```
sau đó chạy 'docker ps' kiểm tra xem bảo đảm đã có mydung_server và mydung_sql 

### 6. Cài Composer (nếu chưa có thư mục vendor)
```bash
docker exec -it mydung_server composer install
```

### 7. Generate key
```bash
docker exec -it mydung_server php artisan key:generate
```

### 8. Run migration và seed dữ liệu
```bash
docker exec -it mydung_server php artisan migrate --seed
```

🔗 Truy cập
Website: http://localhost

PHP container: mydung_server

MySQL: host 127.0.0.1, port 3308, user mydung, password mydung


```

🐳 Lưu ý: Docker phải được cài trên máy trước. Tải tại: https://www.docker.com/products/docker-desktop
