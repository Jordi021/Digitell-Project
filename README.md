<h1>Digitell</h1>

## Instalación

1. Clonar repositorio.
   ```sh
   git clone git remote add origin https://github.com/Jordi021/Digitell-Project.git Digitell

2. Backend
    ```sh
    cd Digitell
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan serve

3. Fronted
    ```sh
    npm install
    npm run dev
    