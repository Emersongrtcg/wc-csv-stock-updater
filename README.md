# wc-csv-stock-updater
![project under MIT license](https://img.shields.io/badge/license-MIT-green) ![PHP 8.0 or further](https://img.shields.io/badge/php-8.0%2B-4F5B93?logo=php)

A script for updating the stock levels of several products in a WooCommerce store using CSV files and the WooCommerce API. It was built for inventory count purposes.

## Functionalities

### Comparative update
Used when you have files containing both old and new stock levels. The script will compare both files and send to your WooCommerce store only those products whose stock levels have changed.

### Direct update

Used when you already have the product stock levels that need updating. The script will send all of these levels directly to your WooCommerce store.

## Prerequisites to run this script

- **PHP 8.0 or further**: This script uses union types, which are not available in PHP versions prior to 8.0. You should be using a PHP version that at least has active security support. To check the officially supported PHP versions, [click here](https://www.php.net/supported-versions.php).
- **WooCommerce API**: You will need a Consumer Key and a Consumer Secret from the Woocommerce API in your store. If you don't know how to get them, you can check [this link](https://woocommerce.com/document/woocommerce-rest-api/#generate-api-keys).

## How to use this script

1. Copy and paste the `config-example.php` file and rename it to `config.php`;
2. Edit the `config.php` file to input your store information:
    - at `STORE_URL`, place the main URL of your store, including the protocol (http:// or https://);
    - at `CONSUMER_KEY` place your Consumer Key you obtained from the WooCommerce API;
    - at `CONSUMER_SECRET` place the Consumer Secret you obtained from the WooCommerce API.
3. Place the CSV files in the `files` folder:
    - for [comparative update](#comparative-update), name the file with the old stock levels as `old.csv`and the one with the new stock levels as `new.csv`;
    - for [direct update](#direct-update), name the file as `stock.csv`.
> [!TIP]
> You can use different file names. To do so, change the values of the constants `OLD_DATA_FILE_NAME`, `NEW_DATA_FILE_NAME` and `STOCK_FILE_NAME` in `config.php`. Do not forget the file extension `.csv`.
4. From the project folder, run the appropriate command in your terminal:
    - for [comparative update](#comparative-update), run `php compareAndUpdate.php`;
    - for [direct update](#direct-update), run `php updateDirectly.php`.

## How should I format the CSV files

- The columns of your CSV file must be separeted by `,`;
- The enclosure character must be `"`;
- The escape character must be `\`.

Your CSV files must include a header row and columns named "id" and "stock". The values in these columns must be integers or strings that can be converted to integers.

> [!TIP]
> You can use different column titles. To do so, change the values of the constants `ID_COLUMN_TITLE` and `STOCK_COLUMN_TITLE` in `config.php`.

### Examples

The following example is correct. You may have columns other than "id" and "stock".

```csv
id,name,stock
5,A great mug,34
8,"A great mug, but with a comma",221
10,Other great mug,68
```

The following example is incorrect because it is missing the "id" column.

```csv
name,stock
A great mug,34
"A great mug, but with a comma",221
Other great mug,68
```

## Contributing

- Did you find a bug or have a suggestion? (Check the issues)[https://github.com/Emersongrtcg/wc-csv-stock-updater/issues] to see if someone has already mentioned the same issue. If not, open a new issue.
- Do you want to fix or implement something by yourself? (Fork the project)[https://github.com/Emersongrtcg/wc-csv-stock-updater/fork], commit your changes and (make a pull request)[https://github.com/Emersongrtcg/wc-csv-stock-updater/pulls] explaining why these changes were made.
