# Project Title
- COVID vaccine registration system API


## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/tarikulIslamNahid/covid-api.git 
   ```
2. Navigate to the project directory:
   ```bash
   cd covid-api
   ```
3. Install Dependencies:
   ```bash
   composer install
   ```
4. Setup Project:
   ```bash
   # create a environment file
   cp .env.example .env

   # setup the mail credential
    MAIL_HOST=""
    MAIL_PORT=""
    MAIL_USERNAME=""
    MAIL_PASSWORD=""
    MAIL_FROM_ADDRESS=""

   # setup the database credential
    DB_PORT=""
    DB_DATABASE=""
    DB_USERNAME=""
    DB_PASSWORD=""

   # migrate database
    php artisan migrate --seed # --seed need for create VaccineCenter
   ```

## Running the Project
- To start the project, use the following command:
  ```bash
  php artisan serve
  ```

## Additional Information
- for fronted repo visit: https://github.com/tarikulIslamNahid/covid-frontend.git 
