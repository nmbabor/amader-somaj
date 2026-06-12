# Deploying Amader Somaj to cPanel shared hosting (FTP only)

This guide is for **cPanel + FTP, no SSH**, where you **can set the domain's
document root**. Domain: `amadersomaj.org`.

The golden rule for Laravel on shared hosting: **only the `public/` folder is
web-accessible.** Everything else (your code, `.env`, `vendor/`) lives one level
above it, where browsers can't reach it.

```
/home/cpaneluser/amadersomaj/        <-- APP ROOT (upload everything here)
├── app/  bootstrap/  config/  database/  resources/  routes/  storage/  vendor/
├── .env                              <-- create here (secret)
└── public/                           <-- DOCUMENT ROOT points here
    ├── index.php  build/  storage/(symlink)  deploy.php(temporary)
```

---

## 0. Server requirements (check in cPanel first)

- **PHP 8.2+** — cPanel → *Select PHP Version* (or *MultiPHP Manager*). Set the
  domain to PHP 8.2/8.3/8.4.
- **Enable PHP extensions** (same screen): `pdo_mysql`, `mbstring`, `openssl`,
  `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`, `gd`, `curl`, `zip`.
- A **MySQL** database (all shared hosts have it).

---

## 1. Build the package on your computer

You can't run Composer/npm on the server, so build locally and upload the result.

```bash
bash build-deploy.sh
```

This runs `composer install --no-dev`, `npm run build`, and creates
**`deploy/amadersomaj-deploy.zip`** — one file containing everything the server
needs (including `vendor/` and the compiled CSS/JS in `public/build/`).

> No bash? Run the three commands inside `build-deploy.sh` manually, then zip the
> project folder yourself (exclude `node_modules`, `.git`, `.env`).

---

## 2. Create the MySQL database (cPanel → *MySQL® Databases*)

1. **Create New Database** → e.g. `amadersomaj` → it becomes `cpaneluser_amadersomaj`.
2. **Add New User** → e.g. `amader` → `cpaneluser_amader` → set a strong password.
3. **Add User To Database** → select the user + database → grant **ALL PRIVILEGES**.
4. Write down the three values — you'll put them in `.env` next.

---

## 3. Upload and extract

1. cPanel → **File Manager**. Go *above* `public_html`, into your home folder.
2. Create a folder named **`amadersomaj`** (this is the APP ROOT).
3. Upload **`amadersomaj-deploy.zip`** into it (Upload button — one file is fast).
4. Right-click the zip → **Extract**. Delete the zip afterward.

---

## 4. Create the `.env` file (in the APP ROOT, NOT in public/)

1. In File Manager, inside `amadersomaj/`, create a new file named **`.env`**
   (enable *Settings → Show Hidden Files* to see dotfiles).
2. Open it (Edit) and paste the contents of **`.env.production.example`**, then
   fill in:
   - `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` from step 2.
   - `APP_URL=https://amadersomaj.org`.
   - The `APP_KEY` is already filled in for you (a fresh one was generated).
3. Save.

---

## 5. Point the domain's document root to `public/`

cPanel → **Domains** (or *Addon Domains* / *Domains → Manage*):

- Set the document root for `amadersomaj.org` to:
  **`/home/cpaneluser/amadersomaj/public`**
  (replace `cpaneluser` with your real cPanel username).

If the panel won't let you edit the root for the primary domain, the common
workaround is to put the **contents of `public/`** into `public_html/` and move
the rest of the app beside it — but since you can set the root, prefer the clean
setup above.

---

## 6. Set folder permissions

In File Manager, set these to **755** (or 775 if 755 fails), recursively:

- `amadersomaj/storage`
- `amadersomaj/bootstrap/cache`

(Right-click → *Change Permissions*, tick *Recurse into subdirectories*.)

---

## 7. Run the one-time setup (migrations + seed + caches)

There's no terminal, so use the included helper:

1. Open **`public/deploy.php`** in File Manager → set `$SECRET` to a long random
   string → Save.
2. Visit in your browser (first deploy only — note `&seed=1`):
   ```
   https://amadersomaj.org/deploy.php?token=YOUR_SECRET&seed=1
   ```
   It creates all tables, seeds the admin user + sample content, creates the
   `storage` symlink, and caches config/routes/views. You'll see a log ending in
   **DONE**.
3. **Delete `public/deploy.php`** from the server immediately. (Re-run later
   without `&seed=1` after future code updates.)

---

## 8. Enable HTTPS

- cPanel → **SSL/TLS Status** → *Run AutoSSL* (free Let's Encrypt), or install
  your certificate. The app already sets `SESSION_SECURE_COOKIE=true` and
  `APP_URL=https://…`, so it expects HTTPS.

---

## 9. Final checks

- Visit **https://amadersomaj.org** — the Bengali site should load with styles.
- Log in at **/login** with `admin@amadersomaj.org` / `password`, then **change
  the password immediately** (top-right → Profile) and update site info under
  **Admin → Settings**.
- Submit the contact form once to confirm DB writes work.
- Upload a photo in **Admin → ছবি গ্যালারি** to confirm `storage:link` works
  (image should display on the public gallery).

---

## Updating the site later (new code)

1. `bash build-deploy.sh` locally → upload + extract the new zip (overwrite).
2. Re-upload `public/deploy.php` (with your secret), visit
   `…/deploy.php?token=YOUR_SECRET` **without** `&seed=1`, then delete it again.
   (This re-runs pending migrations and refreshes the caches.)

## Troubleshooting

- **500 error / blank page:** temporarily set `APP_DEBUG=true` in `.env`, re-run
  `deploy.php` (to clear config cache), reload, read the error, then set it back
  to `false`. Also check `storage/logs/laravel.log`.
- **"Please provide a valid cache path.":** the `storage/framework/views`
  directory (and siblings) don't exist on the server. Create
  `storage/framework/{cache,cache/data,sessions,views}`, `storage/logs`, and
  `bootstrap/cache`, set `storage/` + `bootstrap/cache/` to 755, then **delete
  everything inside `bootstrap/cache/`** (a config cache built while the dir was
  missing keeps the bad path) and reload. Re-running `deploy.php` also recreates
  these dirs automatically.
- **"No application encryption key":** `APP_KEY` missing in `.env` — it should
  start with `base64:`.
- **CSS/JS missing:** `public/build/` wasn't uploaded, or `npm run build` wasn't
  run before zipping.
- **Images not showing:** the `public/storage` symlink failed (some hosts block
  `symlink()`). Workaround: in File Manager, manually create a folder
  `public/storage` and copy `storage/app/public/*` into it, or ask support to
  enable symlinks.
- **DB connection refused:** double-check the prefixed DB name/user and that the
  user is attached to the database with ALL PRIVILEGES. Some hosts use a socket —
  then set `DB_HOST=localhost`.
