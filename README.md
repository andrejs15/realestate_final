# RealEstate – Vaííčko migration

Táto branch je migrácia pôvodnej Laravel semestrálnej práce na povinný framework **Vaííčko 3.0.6** podľa podmienok VAII 2026/27.

Framework je pripojený ako Git submodule z oficiálneho repozitára:
https://github.com/thevajko/vaiicko

## Spustenie

Pri novom clone použite:

```bash
git clone --recurse-submodules -b vajko-migration https://github.com/andrejs15/realestate_final.git
cd realestate_final/docker
docker compose up -d
```

Ak už repozitár máte lokálne a iba prepnete branch:

```bash
git checkout vajko-migration
git submodule update --init --recursive
cd docker
docker compose up -d
```

Aplikácia: http://localhost/

Adminer: http://localhost:8080/  
Server: `db`  
Databáza: `realestate`  
Používateľ: `realestate_user`  
Heslo: `realestate_pass`

> Ak port 80 používa Laragon/Apache, pred spustením Dockeru ho zastavte.

## Databáza

MariaDB pri prvom vytvorení kontajnera automaticky spustí `docker/sql/01_realestate.sql`. Skript vytvorí tabuľky, vzťahy aj ukážkové dáta.

Ak už databázový Docker volume existuje a chcete inicializáciu zopakovať:

```bash
cd docker
docker compose down -v
docker compose up -d
```

## Aktuálne migrovaná funkcionalita

- Vaííčko MVC namiesto Laravelu
- zoznam nehnuteľností
- detail nehnuteľnosti
- 1:N vzťahy Property → PropertyImage a typ/štýl nehnuteľnosti
- M:N Property ↔ AccessibilityFeature
- Create Property so serverovou aj klientskou validáciou
- upload viacerých obrázkov, prvý obrázok je hlavný
- JavaScript preview obrázkov a počítadlo znakov
- responzívny dizajn a pôvodné CSS
- ochrana DB dopytov cez prepared statements Vaííčka
- CSRF token pre Create formulár
- Docker + automatický import demo dát

Edit/Update/Delete, druhý CRUD, databázové prihlásenie/role a AJAX budú doplnené v ďalších commitoch.

## Tailwind

Existujúce Tailwind utility triedy boli pri migrácii zachované. V tejto migračnej verzii sa Tailwind 4 načítava cez browser build z CDN; pred finálnym odovzdaním ho môžeme prepnúť na lokálne skompilovaný statický CSS súbor.

## AI a zdroje

Súbory vytvorené alebo výrazne prerobené počas migrácie sú označené komentárom `AI-assisted migration`. Povinný framework nie je AI-generovaný; jeho zdroj je oficiálny repozitár Vaííčko uvedený vyššie. `FrameworkOverrides/Http/Responses/ViewResponse.php` je označená adaptácia pôvodného Vaííčko súboru a obsahuje odkaz na zdroj.
