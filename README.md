# My Dashboard App

My Dashboard App is a web application built using the powerful Laravel framework, providing a user-friendly interface to manage various data within your system. This application takes full advantage of Laravel's modern features, such as Expressive Routing, Eloquent ORM, and more.

## Features
- **Simple and Fast Routing**: Efficient and easy-to-use routing system.
- **Eloquent ORM**: Intuitive and expressive database queries.
- **Authentication**: Secure user login and registration.
- **Real-time Notifications**: Background job processing and real-time event broadcasting.
- **Dashboard**: An interactive, well-designed dashboard for managing and displaying data.
- **Customizable**: Easily extend and modify the application to suit your specific needs.

## Requirements
- PHP >= 8.0
- Composer
- Laravel Herd (for local development environment)

## Installation
Follow the steps below to get the project up and running on your local environment:

1. Clone the repository:
    ```bash
    git clone https://github.com/beratbagir/my-dashboard-app.git
    ```

2. Navigate into the project directory:
    ```bash
    cd my-dashboard-app
    ```

3. Install dependencies using Composer:
    ```bash
    composer install
    ```

4. Set up the environment variables:
    ```bash
    cp .env.example .env
    ```

5. Generate the application key:
    ```bash
    php artisan key:generate
    ```

6. Run migrations to set up the database:
    ```bash
    php artisan migrate
    ```

7. Serve the application using Laravel Herd:
    ```bash
    laravel serve
    ```

8.
    ```bash    
    php artisan db:seed --class=RoleSeeder
    ``` 

Your application should now be accessible at `http://localhost:8000`.

## Development Setup with Laravel Herd
Laravel Herd is a local development environment for Mac that is optimized for Laravel projects. You can easily run and develop your Laravel application on your local machine with all the required services like PHP, MySQL, and more.

1. **Installation**: You can download Laravel Herd from [here](https://laravel.com/docs/8.x/herd).
2. After installing, you can run the application with the Laravel Herd environment to simplify your setup.

## Contributing
Thank you for considering contributing to My Dashboard App! To contribute:

1. Fork the repository.
2. Create a new branch.
3. Make your changes.
4. Create a pull request.

Please ensure your code adheres to the Laravel coding standards and write tests where applicable.

## License
The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Sponsors
This project was made possible by the following Laravel sponsors:

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**

For a full list of Laravel sponsors, visit the [Laravel Sponsors page](https://laravel.com/sponsors).
