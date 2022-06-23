1. Copy the `.env.example` to `.env` file in root project directory , and key In the required information for database : 
`DB_USERNAME`, and `DB_PASSWORD`
2. Inside the `.env`, configure your mail sending authroization, for this test, I use mailtrap
3. After your database are ready, run this script in the terminal
   `php artisan migrate:fresh --seed`
   This will create a fresh migrated table with database seeders to it
4. After everything set up, open 2 terminal in project directory and run these commands:
   - `php artisan serve` (To run the application)
   - `php artisan queue:work` (To run the queue worker for sending bulk emails)
5. There are 2 endpoints that are available for testing : 
   - `/api/users/subscribe` -> to subscribe user to a specific website (requets body defined in postman collecition)
   - `/api/posts/create` -> to create a post for a particular website (request body defined in postman collection), it should send email to subcribed users which post belongs to a particular website
6. To send email using command, I use it using `php artisan subscriber:emails` {websiteId}