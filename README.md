# Valūtu kursu risinājums

Ieteicams izmantot Docker, lai uzstādītu projektu

# Uzstādīšana

Pēc failu klonēšanas komandrindā nepieciešams izpildīt komandas, kur /path/to/cloned-project ir ceļš uz klonēto direktoriju
```sh
cd /path/to/cloned-project
docker-compose up -d
```
Kad Docker konteineri ir veiksmīgi uzsākuši darbību, nepieciešams izpildīt komandu
```sh
docker-compose exec -w /var/www/symfony/ php composer install
```

Lai izveidotu vajadzīgo datubāzes tabulu, jāizpilda
```sh
docker-compose exec -w /var/www/symfony/ php bin/console doctrine:migrations:migrate
```

Kad tabula izveidota, to var piepildīt ar datiem izpildot komandu
```sh
docker-compose exec -w /var/www/symfony/ php bin/console update-currencies
```

Cronjob var izmantot šo komandu, lai atjaunotu tekošos valūtu datus
```sh
php /var/www/symfony/bin/console update-currencies
```

Lai apskatītu lapu, kurā redzamas visas valūtas, jāapmeklē: http://view.localhost/
Lai apskatītu vienu konkrētu valūtu, var apmeklēt: http://view.localhost/currency/gbp vai uzspiest uz konkrētās valūtas apzīmējuma lapā http://view.localhost/

Valūtu API izmanto šādus endpointus
  - http://api.localhost/api/currency/latest - lai iegūtu jaunākos valūtu datus
  - http://api.localhost/api/currency/single/gbp - lai iegūtu konkrētas valūtas datus