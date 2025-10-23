# Unit Converter (PHP)

A simple, modern unit converter built with PHP for the backend and a Tailwind-powered UI on the frontend. Convert between common units for length, weight, temperature, volume, and area.

## Features

- Modern, responsive UI (Tailwind via CDN)
- Fast conversions in the browser with a minimal PHP backend
- Keyboard-friendly form with instant result output
- Clear category and unit selection

## Project Structure

```
UnitConverter/
├─ index.php           # Frontend UI (Tailwind + vanilla JS)
├─ function.php        # Backend endpoint (expects POST; implement logic here)
├─ Length.php          # (optional) Length conversion class
├─ Weight.php          # (optional) Weight conversion class
├─ Temperature.php     # (optional) Temperature conversion class
├─ Volume.php          # (optional) Volume conversion class
└─ Area.php            # Area conversion class (implemented)
```

## Requirements

- PHP 8.0+
- No database required
- No Composer dependencies (Tailwind is loaded via CDN)

## Run Locally

```bash
# from the project root
php -S localhost:8000
```

Open `http://localhost:8000/index.php` in your browser.

## Usage

1. Choose a category (Length, Weight, Temperature, Volume, Area).
2. Enter a numeric value.
3. Pick the source unit and the target unit.
4. Click Convert to show the result.

The UI submits a POST request to `function.php` with the form data and writes the server response into the Result field.

## HTTP API

- Endpoint: `POST function.php`
- Form fields submitted by the UI:
  - `base-value` (number)
  - `base-unit` (string)
  - `to-unit` (string)

Response is expected to be plain text containing the converted value.

### Implementing `function.php`

This repository includes `Area.php` with a working `Area::convert($value, $fromUnit, $toUnit)` method. You can implement similar classes for the other categories (or handle them directly in `function.php`). Below is a minimal example of how `function.php` can route a request to conversion classes:

```php
<?php
require_once __DIR__ . '/Area.php';
// require_once __DIR__ . '/Length.php';
// require_once __DIR__ . '/Weight.php';
// require_once __DIR__ . '/Temperature.php';
// require_once __DIR__ . '/Volume.php';

header('Content-Type: text/plain; charset=utf-8');

$value = isset($_POST['base-value']) ? (float) $_POST['base-value'] : null;
$from  = $_POST['base-unit'] ?? null;
$to    = $_POST['to-unit'] ?? null;

if ($value === null || $from === null || $to === null) {
    http_response_code(400);
    echo 'Invalid request';
    exit;
}

// Very simple router based on which units are provided
try {
    $result = null;

    // Area (provided):
    if (in_array($from, array_keys(Area::$conversionRates), true) && in_array($to, array_keys(Area::$conversionRates), true)) {
        $result = Area::convert($value, $from, $to);
    }

    // TODO: add other categories similarly once classes are implemented
    // Example pattern:
    // if (in_array($from, array_keys(Length::$conversionRates), true) && in_array($to, array_keys(Length::$conversionRates), true)) {
    //     $result = Length::convert($value, $from, $to);
    // }

    if ($result === null) {
        http_response_code(422);
        echo 'Unsupported unit combination';
        exit;
    }

    echo $result;
} catch (Throwable $e) {
    http_response_code(500);
    echo 'Conversion error';
}
```

## Supported Categories and Units (UI)

- **Length**: Meter, Kilometer, Centimeter, Millimeter, Mile, Yard, Foot, Inch
- **Weight**: Kilogram, Gram, Milligram, Pound, Ounce
- **Temperature**: Celsius, Fahrenheit, Kelvin
- **Volume**: Liter, Milliliter, Cubic Meter, Cubic Centimeter, Gallon, Quart, Pint, Cup, Fluid Ounce
- **Area**: Square Meter, Square Kilometer, Square Mile, Acre, Hectare

Note: The UI already lists these units. Make sure your backend supports the selected units (e.g., by adding `Length.php`, `Weight.php`, etc., modeled on `Area.php`).

## Development

- UI lives in `index.php` and uses Tailwind CDN; tweak classes/styles inline.
- Add or adjust unit lists in the `categories` object inside `index.php`.
- Implement additional conversion classes mirroring the interface in `Area.php`.

## Contributing

Issues and PRs are welcome. If you add a new category, please include:
- A conversion class with a `convert($value, $fromUnit, $toUnit)` method
- Unit tests or examples
- README updates

## License

MIT License


