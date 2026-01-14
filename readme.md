<img src="https://www.hogelidstennis.se/img/htk-logo.svg" width="200">

## Högelids Tennisklubb - Bokningssystem

### [www.hogelidstennis.se](https://www.hogelidstennis.se/)

## Utvecklingsmiljö / Development Setup

### Förutsättningar / Prerequisites
- PHP >= 5.5.9
- Composer
- Node.js och npm

### Installation

1. **Klona projektet**
   ```bash
   git clone https://github.com/wictorstenseke/bokningssystem-HTK.git
   cd bokningssystem-HTK
   ```

2. **Installera PHP-beroenden**
   ```bash
   composer install
   ```

3. **Installera frontend-beroenden**
   ```bash
   npm install
   ```

4. **Konfigurera miljövariabler**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Konfigurera databasen** (valfritt - krävs bara för att testa bokningar)
   
   Redigera `.env` filen och uppdatera databasinställningarna:
   ```
   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=htk
   DB_USERNAME=root
   DB_PASSWORD=root
   ```
   
   Skapa databas och kör migrationer:
   ```bash
   php artisan migrate
   php artisan db:seed  # Valfritt: Skapa testdata
   ```

### Starta utvecklingsservern

#### Alternativ 1: Kör frontend och backend separat (Rekommenderat)

**Terminal 1 - Backend (Laravel server):**
```bash
npm run serve:backend
# eller
php artisan serve
```
Servern startar på http://localhost:8000

**Terminal 2 - Frontend (Gulp watch + BrowserSync):**
```bash
npm run serve:frontend
# eller
gulp watch
```
BrowserSync startar på http://localhost:3000 med live reload

#### Alternativ 2: Bara backend (utan live reload)
```bash
npm run serve:backend
```
Öppna http://localhost:8000 i webbläsaren

#### Alternativ 3: Bara kompilera assets
```bash
npm run dev      # Kompilera en gång
npm run watch    # Kompilera och bevaka ändringar
npm run prod     # Kompilera för produktion
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
