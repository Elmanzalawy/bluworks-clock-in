## Bluworks Backend Task

bluworks is an HR system for workers in the service industry. One of the key features
bluworks provides is the ability to track worker clock-ins and clock-outs from a mobile device
to enable accurate live data for decision makers.

### Installation

-   Install Composer dependencies
    ```bash
    composer install
    ```
-   Generate app key

    ```bash
    php artisan key:generate
    ```

-   Create & seed Database

    ```bash
    php artisan migrate --seed
    ```

    Or import the schema and data from the `database-seeder.sql.zip` file in the root directory

-   Generate swagger docs

    ```bash
    php artisan l5-swagger:generate
    ```

-   Start the server
    ```bash
    php artisan serve
    ```

-   Use swagger docs on the URL `<APP_URL>/api/documentation`
