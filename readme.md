<img src="https://www.hogelidstennis.se/img/htk-logo.svg" width="200">

## Högelids Tennisklubb - Bokningssystem

### [www.hogelidstennis.se](https://www.hogelidstennis.se/)

## Utvecklingsmiljö / Development Setup

### Förutsättningar / Prerequisites
- **PHP 7.0 - 7.4** (Laravel 5.2 är inte kompatibel med PHP 8+)
- Composer
- Node.js och npm
- **Alternativ: Docker** (för enkel installation utan PHP-versionskonflikter)

> **OBS:** Detta projekt använder Laravel 5.2 som är äldre och kräver PHP 7.x. För nyare PHP-versioner (8.x), se Docker-alternativet nedan.

### Installation med Docker (Rekommenderat för moderna system)

Docker gör det enkelt att köra projektet utan att behöva installera rätt PHP-version på din dator.

1. **Installera Docker Desktop**
   - Ladda ner från [docker.com](https://www.docker.com/products/docker-desktop/)

2. **Klona projektet**
   ```bash
   git clone https://github.com/wictorstenseke/bokningssystem-HTK.git
   cd bokningssystem-HTK
   ```

3. **Skapa en docker-compose.yml fil** (se exempel nedan)

4. **Starta med Docker**
   ```bash
   docker-compose up -d
   ```
   
5. **Installera beroenden i Docker-containern**
   ```bash
   docker-compose exec app composer install
   docker-compose exec app npm install
   docker-compose exec app cp .env.example .env
   docker-compose exec app php artisan key:generate
   ```

6. **Öppna webbläsaren**
   - Gå till http://localhost:8000

### Installation med PHP 7.x (Native)

Om du har PHP 7.0-7.4 installerat:

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

### Docker Compose Exempel

Skapa en `docker-compose.yml` fil i projektets rot:

```yaml
version: '3.8'
services:
  app:
    image: php:7.4-cli
    working_dir: /var/www
    volumes:
      - ./:/var/www
    ports:
      - "8000:8000"
    command: php artisan serve --host=0.0.0.0 --port=8000
    depends_on:
      - db
    environment:
      - DB_HOST=db
      - DB_DATABASE=htk
      - DB_USERNAME=root
      - DB_PASSWORD=secret

  db:
    image: mysql:5.7
    environment:
      MYSQL_ROOT_PASSWORD: secret
      MYSQL_DATABASE: htk
    ports:
      - "3306:3306"
    volumes:
      - db_data:/var/lib/mysql

volumes:
  db_data:
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

## Kända Problem

- **PHP 8+ Kompatibilitet**: Laravel 5.2 stödjer inte PHP 8.0 eller senare. Använd PHP 7.0-7.4 eller Docker-alternativet.
- **Säkerhetsvarningar**: Eftersom ramverket är äldre kan det finnas kända säkerhetsbrister. Detta projekt är för personlig/klubbanvändning.
