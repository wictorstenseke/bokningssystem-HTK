<img src="https://www.hogelidstennis.se/img/htk-logo.svg" width="200">

## Högelids Tennisklubb - Bokningssystem

### [www.hogelidstennis.se](https://www.hogelidstennis.se/)

### Lokal utveckling och preview

**Viktigt:** Detta projekt kräver PHP 7.4 eller tidigare. PHP 8.0+ är inte kompatibelt med Laravel 5.2.

#### Förutsättningar
- PHP 7.4 (eller tidigare)
- Composer
- Node.js och npm
- SQLite (för snabb preview) eller MySQL

#### Snabbstart

1. **Installera PHP 7.4** (om du har PHP 8.x):
   ```bash
   brew install php@7.4
   # Använd PHP 7.4:
   /opt/homebrew/opt/php@7.4/bin/php artisan serve
   ```

2. **Installera dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurera miljö:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Sätt upp databas (SQLite för snabb preview):**
   ```bash
   # I .env, ändra:
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   
   # Skapa databasfilen:
   touch database/database.sqlite
   
   # Kör migrationer:
   php artisan migrate
   ```

5. **Kompilera assets:**
   ```bash
   npm run dev    # För utveckling med watch
   # eller
   npm run prod   # För produktion
   ```

6. **Starta servern:**
   ```bash
   php artisan serve
   ```
   Öppna sedan: http://localhost:8000

7. **Seed med testdata (valfritt):**
   ```bash
   php artisan db:seed
   ```

### Databas
Default så skapas bokningar som kan vara upp till 3 år gamla.
För att bara skapa bokningar för aktuellt år ändra i filen:
`/database/factories/ModelFactory.php`

```php
// Skapar bara bokningar nuvarande år
$year   = Carbon::now()->year;
```

```php
// Skapar bokningar från nuvarande år till och med 3 år gammalt
$year   = Carbon::now()->subYears(rand(0,3))->year;
```



#### Kommandon i terminalen
```bash
# Skapa fake-data
php artisan db:seed

# Töm databasen
php artisan db:seed --class="Truncate"
```
