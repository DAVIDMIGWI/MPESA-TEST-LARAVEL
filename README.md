# Laravel M-Pesa STK Push Integration

This project demonstrates how to integrate M-Pesa STK Push functionality in a Laravel application. It allows users to initiate payments through M-Pesa by entering the amount, phone number, reference, and description.

## Prerequisites

- PHP >= 7.3
- Composer
- Laravel >= 7.x
- Guzzle HTTP client

## Installation

1. Clone the repository:

    ```bash
    git clone git@github.com:DAVIDMIGWI/MPESA-TEST-LARAVEL.git
    cd MPESA-TEST-LARAVEL
    ```

2. Install dependencies:

    ```bash
    composer install
    ```

3. Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

4. Configure your environment variables in the `.env` file:

    ```env
    MPESA_CONSUMER_KEY=your_consumer_key
    MPESA_CONSUMER_SECRET=your_consumer_secret
    MPESA_SHORTCODE=your_shortcode
    MPESA_PASSKEY=your_passkey
    MPESA_CALLBACK_URL=https://your-callback-url.com/path
    MPESA_BASE_URL=https://api.safaricom.co.ke
    ```

5. Generate an application key:

    ```bash
    php artisan key:generate
    ```

6. Start the Laravel development server:

    ```bash
    php artisan serve
    ```

7. Open your browser and navigate to:

    ```
    http://127.0.0.1:8000
    ```

## Usage

1. On the welcome page, fill in the form with the required details:
    - Amount
    - Phone (must start with `254` followed by 9 digits)
    - Reference
    - Description

2. Click "Submit" to initiate the M-Pesa STK Push transaction.

## Project Structure

- **app/Http/Controllers/MpesaController.php**: Handles the form submission and initiates the STK Push.
- **app/Services/MpesaService.php**: Contains the logic for obtaining the access token and initiating the STK Push request to Safaricom's API.
- **resources/views/welcome.blade.php**: The form view for collecting payment details.

## Error Handling

- If the phone number does not match the required pattern (starting with `254` followed by 9 digits), the form will not be submitted, and a validation message will be shown.
- Any errors from the M-Pesa API will be logged and returned as part of the response.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Acknowledgements

- [Laravel](https://laravel.com/)
- [Guzzle](https://github.com/guzzle/guzzle)
- [Safaricom M-Pesa API](https://developer.safaricom.co.ke/docs)

## Contributing

Feel free to submit issues or pull requests.

## Contact

For more information, contact [David Migwi](mailto:MIGWI81@GMAIL.COM).
