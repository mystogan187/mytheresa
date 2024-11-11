# Mytheresa API

This project is a RESTful API that provides product information with applicable discounts and supports filtering options. It is built using **PHP** and the **Symfony** framework.

## Table of Contents

- [Features](#features)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Running the Application](#running-the-application)
- [Running Tests](#running-tests)
- [API Usage](#api-usage)
    - [Endpoint](#endpoint)
    - [Query Parameters](#query-parameters)
    - [Response Format](#response-format)
    - [Examples](#examples)

## Features

- **Single Endpoint**: Provides a `/products` endpoint to retrieve products.
- **Filtering**: Supports filtering by `category` and `priceLessThan` query parameters.
- **Discounts**: Applies discounts based on category and SKU.
- **Pagination**: Returns at most 5 products per request.
- **Currency**: All prices are in EUR.
- **Testing**: Includes unit tests that can be run with a single command.
- **Easy Setup**: Can be installed and run with simple commands on any machine.

## Prerequisites

- **PHP** >= 7.4
- **Composer** installed
- **Symfony CLI** installed (optional but recommended)

## Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/mystogan187/mytheresaApi.git
   cd mytheresaApi
   ```
## !!UPDATE with docker!!
   
   ```bash
   docker compose up --build
   http://localhost:8000/products
   ```

2. **Install Dependencies**

   ```bash
   composer install
   ```

## Running the Application

1. You can run the application using the Symfony CLI or PHP's built-in web server.

    ```bash
   symfony server:start
   ```
The API should be accessible at https://localhost:8000 otherwise check your console instructions.

2. Using PHP's Built-in Server
    ```bash
    php -S localhost:8000 -t public
   ```
The API will be accessible at https://localhost:8000.

## Running Tests
The project includes unit tests that can be run with a single command.

```bash
./vendor/bin/phpunit
```

## API Usage
### Endpoint
1. GET /products
   - Query Parameters
     - category (optional): Filter products by category.
     - priceLessThan (optional): Filter products with original prices less than or equal to this value (before discounts are applied).

2. Response Format
   The API returns a JSON object with a **products** array containing product objects. Each product object includes:
    - **sku**: Product SKU.
    - **name**: Product name.
    - **category**: Product category.
    - **price**: An object containing:
      - **original**: Original price in cents.
      - **final**: Final price after discount in cents.
      - **discount_percentage**: The applied discount percentage (e.g., "30%") or ***null*** if no discount.
      - **currency**: Currency code, always "EUR".

## Examples

- Fetch All Products
    ```bash
    GET /products
    ```
  - Sample Response
    ```bash
    "products": [
    {
      "sku": "000001",
      "name": "BV Lean leather ankle boots",
      "category": "boots",
      "price": {
        "original": 89000,
        "final": 62300,
        "discount_percentage": "30%",
        "currency": "EUR"
      }
    },
    {
      "sku": "000002",
      "name": "BV Lean leather ankle boots",
      "category": "boots",
      "price": {
        "original": 99000,
        "final": 69300,
        "discount_percentage": "30%",
        "currency": "EUR"
      }
    },
    {
      "sku": "000003",
      "name": "Ashlington leather ankle boots",
      "category": "boots",
      "price": {
        "original": 71000,
        "final": 49700,
        "discount_percentage": "30%",
        "currency": "EUR"
      }
    },
    {
      "sku": "000004",
      "name": "Naima embellished suede sandals",
      "category": "sandals",
      "price": {
        "original": 79500,
        "final": 79500,
        "discount_percentage": null,
        "currency": "EUR"
      }
    },
    {
      "sku": "000005",
      "name": "Nathane leather sneakers",
      "category": "sneakers",
      "price": {
        "original": 59000,
        "final": 59000,
        "discount_percentage": null,
        "currency": "EUR"
      }
    }]
    ```
- Filter by Category
  ```bash
  GET /products?category=boots
  ```
  - Sample Response
    ```bash
    "products": [
    {
      "sku": "000001",
      "name": "BV Lean leather ankle boots",
      "category": "boots",
      "price": {
        "original": 89000,
        "final": 62300,
        "discount_percentage": "30%",
        "currency": "EUR"
      }
    },
    {
      "sku": "000002",
      "name": "BV Lean leather ankle boots",
      "category": "boots",
      "price": {
        "original": 99000,
        "final": 69300,
        "discount_percentage": "30%",
        "currency": "EUR"
      }
    },
    {
      "sku": "000003",
      "name": "Ashlington leather ankle boots",
      "category": "boots",
      "price": {
        "original": 71000,
        "final": 49700,
        "discount_percentage": "30%",
        "currency": "EUR"
      }
    }]
    ```
- Filter by Price Less Than
    ```bash
     GET /products?priceLessThan=80000
    ```
- Combined Filters
    ```bash
    GET /products?category=boots&priceLessThan=80000
    ```
  - Sample Response
    ```bash
    "products": [
    {
      "sku": "000003",
      "name": "Ashlington leather ankle boots",
      "category": "boots",
      "price": {
        "original": 71000,
        "final": 49700,
        "discount_percentage": "30%",
        "currency": "EUR"
      }
    }]
    ```
