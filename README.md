# Unit Converter (PHP)

A simple, modern unit converter built with PHP for the backend and a Tailwind-powered UI on the frontend. Convert between common units for length, weight, temperature, volume, and area.

## Project URL
- https://roadmap.sh/projects/unit-converter
## Features

- Modern, responsive UI (Tailwind via CDN)
- Fast conversions in the browser with a minimal PHP backend
- Keyboard-friendly form with instant result output
- Clear category and unit selection

## Project Structure

```
UnitConverter/
├─ index.php           # Frontend UI (Tailwind + vanilla JS)
├─ function.php        # Backend endpoint with full conversion logic
├─ Length.php          # Length conversion class
├─ Weight.php          # Weight conversion class
├─ Temperature.php     # Temperature conversion class
├─ Volume.php          # Volume conversion class
└─ Area.php            # Area conversion class
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

### Backend Implementation

The `function.php` file includes a complete implementation that:
- Validates all input parameters
- Routes requests to appropriate converter classes
- Handles errors gracefully with proper HTTP status codes
- Supports all five conversion categories (Length, Weight, Temperature, Volume, Area)

All converter classes are fully implemented and ready to use.

## Supported Categories and Units (UI)

- **Length**: Meter, Kilometer, Centimeter, Millimeter, Mile, Yard, Foot, Inch
- **Weight**: Kilogram, Gram, Milligram, Pound, Ounce
- **Temperature**: Celsius, Fahrenheit, Kelvin
- **Volume**: Liter, Milliliter, Cubic Meter, Cubic Centimeter, Gallon, Quart, Pint, Cup, Fluid Ounce
- **Area**: Square Meter, Square Kilometer, Square Mile, Acre, Hectare

All units listed above are fully supported by the backend converter classes.

## Development

- UI lives in `index.php` and uses Tailwind CDN; tweak classes/styles inline.
- Add or adjust unit lists in the `categories` object inside `index.php`.
- All conversion classes are implemented and follow consistent patterns.

## Contributing

Issues and PRs are welcome. If you add a new category, please include:
- A conversion class with appropriate conversion methods
- Unit tests or examples
- README updates

## License

MIT License


