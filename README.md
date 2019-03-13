# WhereIsOurCar / WIOC
Is a simple web page that help you sotre/find where you last parked your car.

### Details
This web app let you save where you parked your car based on:
- your input of street address
- your location (gps based on smarphones for example)

then you can easily access the last saved location


### Requirements
For it work you need to do quite some setup first.

- get you http server running (like apache for example)
- get php setup and working
- get a MySql database setup and running


### Basic package requirements:

#### Ubuntu and derived
the list might not be too acurate

```
- apache2
- mysql-server
- libapache2-mod-php
```

#### Arch and derived

```
- apache
- mariadb
- mariadb-clients
- php
```

### Instalation
once all packages are installed and configured

please create the required database user/password, database and table.
Or adjust the `config.php` file to match your setup.

The file db_dump.sql can setup for you the required table.

copy `config.sample.js` to `config.js` with your token.