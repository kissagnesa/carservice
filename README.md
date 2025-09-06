# Autószerviz napló

Ez az alkalmazás egy autószerviz ügyfél- és szerviznapló kezelő rendszer, amely PHP és MySQL alapokon készült, Docker környezetben futtatható.

## Verziók

- **PHP:** 8.2 (Docker image: `php:8.2-apache`)
- **MySQL/MariaDB:** 10.4.32-MariaDB
- **Apache:** A PHP Docker image beépített Apache szervert használ
- **JavaScript:** Vanilla JS
- **jQuery:** 3.7.1 (`js/jquery-3.7.1.min.js`)
- **Bootstrap:** 5.3.2 (`css/bootstrap.min.css` és `js/bootstrap.bundle.min.js`)

## Telepítési és beüzemelési lépések

### 1. Klónozd a repót

```sh
git clone <repo-url>
cd carservice
```

### 2. Docker Compose használata

A projekt tartalmaz egy Dockerfile-t és egy compose.yaml-t. Indítsd el a konténert:

```sh
docker compose up --build
```

Ez elindítja a PHP-Apache szervert a forráskóddal.

### 3. Adatbázis beállítása

A projekt tartalmaz egy `carservice.sql` dumpot, amelyet importálni kell egy MariaDB/MySQL adatbázisba.

#### MariaDB konténer indítása (példa)

```sh
docker run --name carservice-db -e MYSQL_ROOT_PASSWORD=root -e MYSQL_DATABASE=carservice -p 3306:3306 -d mariadb:10.4
```

#### Adatbázis importálása

```sh
docker exec -i carservice-db mysql -uroot -proot carservice < carservice.sql
```

### 4. Konfiguráció

A `connect.php` fájlban az adatbázis elérési adatait szükség szerint módosítsd:

```php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "carservice";
```

Ha a PHP és a DB konténer külön fut, a `localhost` helyett a DB konténer nevét add meg.

### 5. Használat

- Böngészőben nyisd meg: [http://localhost:80](http://localhost:80) (vagy a Docker host szerinti portot)
- Az alkalmazás automatikusan betölti a JSON állományokat az adatbázisba, ha az üres.

## Fájlstruktúra

- `index.php` – főoldal
- `modules/` – PHP backend modulok
- `modules/data/` – JSON adatállományok
- `js/` – JavaScript és jQuery fájlok
- `css/` – stíluslapok (pl. Bootstrap)
- `Dockerfile`, `compose.yaml` – Docker konfiguráció

## Megjegyzések

- A projekt nem használ Laravel-t vagy más PHP frameworköt.
- A Docker Compose fájl csak a PHP-Apache szervert tartalmazza, az adatbázist külön kell indítani.
- Az első indításkor a `modules/data_check.php` automatikusan feltölti az adatbázist a JSON fájlokból, ha az üres.

---

**Fejlesztői környezet ajánlott verziók:**
- Docker: 24.x vagy újabb
-