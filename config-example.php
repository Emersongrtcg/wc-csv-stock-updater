<?php

//The URL of your store.
const STORE_URL = 'https://examplestore.com/';

//The consumer key and consumer secret are showed when you create your
//WooCommerce API Key.
const CONSUMER_KEY = 'ck_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
const CONSUMER_SECRET = 'cs_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

/**
 * Default constants
 * 
 * You may change the following constants if you want to use a different name
 * convention.
 */
//The name of the file with the old stocks. Default: 'old.csv'
const OLD_DATA_FILE_NAME = 'old.csv';
//The name of the file with the new stocks. Default: 'new.csv'
const NEW_DATA_FILE_NAME = 'new.csv';
//The name of the file with the stock changes, for update without comparing
//files. Default: 'stock.csv'
const STOCK_FILE_NAME = 'stock.csv';

//The title of the column where are the product ID's. Default: 'id'
const ID_COLUMN_TITLE = 'id';
//The title of the column where are the product stocks. Default: 'stock'
const STOCK_COLUMN_TITLE = 'stock';
