# আমাদের সমাজ (Amader Somaj)

৭নং ধর্মপুর ইউনিয়নের একটি সামাজিক সংগঠনের ওয়েবসাইট। Laravel 11 + MySQL + Tailwind CSS + Alpine.js দিয়ে তৈরি, সম্পূর্ণ বাংলা UI সহ।

## Tech Stack

- **Laravel 11** (PHP 8.4)
- **MySQL** (ডেভেলপমেন্টে SQLite ফলব্যাক সহ)
- **Blade** templating
- **Tailwind CSS** + **Alpine.js** (Breeze ব্ল্যাড স্ট্যাক)
- **Laravel Breeze** — অ্যাডমিন authentication
- **Spatie Media Library** — ছবি/ভিডিও মিডিয়া
- **Laravel Livewire** — ইনস্টল করা, ডায়নামিক কম্পোনেন্টের জন্য প্রস্তুত
- **Hind Siliguri** / **Noto Sans Bengali** — বাংলা ফন্ট (Google Fonts)

## ফিচার

### পাবলিক পেজ
- হোম (হিরো, স্ট্যাটস কাউন্টার, কার্যক্রম, ছবি প্রিভিউ)
- আমাদের সম্পর্কে (ইতিহাস, মিশন/ভিশন, টিম)
- কার্যক্রম (ক্যাটাগরি ফিল্টার + সার্চ + পেজিনেশন, একক পোস্ট)
- ছবি গ্যালারি (ক্যাটাগরি ফিল্টার + লাইটবক্স)
- ভিডিও গ্যালারি (YouTube embed + আপলোড করা ভিডিও)
- সদস্যপদ (টিয়ার, বেনিফিট, আবেদন ফরম)
- দান / ফান্ড সংগ্রহ (বিকাশ/নগদ নির্দেশনা + ফরম)
- যোগাযোগ (ফরম + Google Map + ঠিকানা)
- WhatsApp ফ্লোটিং বাটন, সোশ্যাল শেয়ার, বাংলা SEO মেটা ট্যাগ

### অ্যাডমিন প্যানেল (`/admin`)
পোস্ট, ক্যাটাগরি, ছবি, ভিডিও, সদস্য, অনুদান, বার্তা, টিম মেম্বার ও সাইট সেটিংস — সম্পূর্ণ CRUD।

## অ্যাডমিন লগইন (সিড করা)

```
URL:      http://localhost:8000/login
ইমেইল:    admin@amadersomaj.org
পাসওয়ার্ড: password
```
> প্রোডাকশনে যাওয়ার আগে অবশ্যই পাসওয়ার্ড পরিবর্তন করুন।

---

## সেটআপ

### ১. ডিপেন্ডেন্সি
```bash
composer install
npm install
```

### ২. পরিবেশ
```bash
cp .env.example .env
php artisan key:generate
```

### ৩. MySQL ডাটাবেজ তৈরি (একবার, root অ্যাক্সেস প্রয়োজন)
নিচের কমান্ডটি চালান (root পাসওয়ার্ড চাওয়া হবে):

```bash
mysql -u root -p <<'SQL'
CREATE DATABASE IF NOT EXISTS amadersomaj CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS 'amadersomaj'@'localhost' IDENTIFIED BY 'amadersomaj_secret';
GRANT ALL PRIVILEGES ON amadersomaj.* TO 'amadersomaj'@'localhost';
FLUSH PRIVILEGES;
SQL
```

`.env`-এ নিশ্চিত করুন:
```
DB_CONNECTION=mysql
DB_DATABASE=amadersomaj
DB_USERNAME=amadersomaj
DB_PASSWORD=amadersomaj_secret
```
> পাসওয়ার্ড পরিবর্তন করলে উপরের SQL ও `.env` — দুই জায়গাতেই আপডেট করুন।

### ৪. মাইগ্রেশন, সিড ও অ্যাসেট
```bash
php artisan migrate --seed
php artisan storage:link
npm run build      # অথবা ডেভে: npm run dev
```

### ৫. সার্ভার চালু
```bash
php artisan serve
```
সাইট: http://localhost:8000 — অ্যাডমিন: http://localhost:8000/admin

---

## ডাটাবেজ টেবিল
`users`, `members`, `posts`, `categories`, `photos`, `videos`, `donations`, `contacts`, `team_members`, `settings` (+ Spatie `media`)।

## নোট
- **ফন্ট:** কাজে SolaimanLipi/Kalpurush লোকাল লাইসেন্সড ফন্টের পরিবর্তে ফ্রি ও নির্ভরযোগ্য **Hind Siliguri** (Google Fonts) ব্যবহার করা হয়েছে। লোকাল ফন্ট ব্যবহার করতে চাইলে `.woff2` ফাইল `public/fonts/`-এ রেখে `resources/css/app.css`-এ `@font-face` যোগ করুন।
- **সাইটের সব টেক্সট/নম্বর** অ্যাডমিন → সেটিংস থেকে পরিবর্তনযোগ্য (সাইটের নাম, হিরো, যোগাযোগ, বিকাশ/নগদ নম্বর, WhatsApp, ম্যাপ ইত্যাদি)।
- ডেভেলপমেন্টে দ্রুত শুরুর জন্য SQLite-ও সমর্থিত — `.env`-এ `DB_CONNECTION=sqlite` দিন।
