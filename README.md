to Start:

git clone https://github.com/Maximnnn/SORQ-test.git

composer install

copy .env.example to .env

configure .env (database)

php artisan key:generate

php artisan migrate:refresh --seed

php artisan serve

localhost:8000/tasks

login test@test.com:qwerty


ROUTES:

tasks page:

GET localhost:8000/tasks?title=some_title&assignee_id=user_id

create task (requires title,description):
  
POST localhost:8000/tasks

returns json ['comments' => Comment[]]

GET localhost:8000/tasks/{id}/comments

create comment (requires comment)

POST localhost:8000/tasks/{id}/comments 
