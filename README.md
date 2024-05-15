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

    Or use import the schema + data from the .sql file attached to the task submission.

-   Generate swagger docs

    ```bash
    php artisan l5-swagger:generate
    ```

-   Use swagger docs on the URL `<APP_URL>/api/documentation`
