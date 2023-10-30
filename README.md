These are the steps you can follow to set up the project on your local machine.

## Step 1: Clone the Project

---

Clone your project to the server using the following command:

`git clone <project-git-repo-url>`

## Step 2: Composer Install

---

Run composer instlal to install all required dependencies:

`composer install`

## Step 3: Set up your .env file

---

You can rename the .env.example file to .env and update the values to match your local environment.

## Step 4: Seed data to the database

---

Run the following command to seed initial data to the database:

`php artisan db:seed`

## Step 5: APIs to test with

---

At this point, you should be good to go! I've set up a few APIs you can use to test creating a comment and logging a watched lesson:

`POST /api/comment` - Create a comment. It should also award the correct achievement and badge where the user earns them
`POST /api/lessons-watched` - Log a watched lesson. It should also award the correct achievement and badge where the user earns them

A user has to be logged in to access these APIs. You can use the following credentials to log in:

`Email: test@example.com`
`Password: password`

`Login API: POST /api/login`

The API provides a token that can be used to authenticate the user for the other APIs.

## Step 6: Have questions?

---

Feel free to reach out and ask me if you're stuck anywhere. I'd be happy to help.

`fredrickmakoffu@gmail.com`
