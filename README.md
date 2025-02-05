## Cara Instalasi

Download project atau clone via github

- Buka CMD arahkan ke folder htdocs (jika xampp)
- Ketik git clone https://github.com/arimahendra1806/simeks.git
- Ketik cd simeks
- Ketik composer update
- Ketik cp .env.example .env
- Buat database di mysql dengan nama "old_simeks"
- Ketik php artisan migrate:refresh --seed
- Ketik php artisan serve
- Buka di chrome "http://127.0.0.1:8000/"

## User akun

Password awal sama "simeks"

- Akun Admin: admin@example.com
- Akun Marketing: marketing@example.com
- Akun Direktur: direktur@example.com
- Akun Buyer: buyer@example.com
