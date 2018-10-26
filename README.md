# mini-loan
API For Mini-Loan

run command

## Installation

Clone the repository

    git clone https://github.com/MgHtinLynn/mini-loan.git
Switch to the repo folder

    cd mini-loan
    
Create env file

    cp .env.example .env
    
Generate a new application key

    php artisan key:generate

Generate a new JWT secret key (If you want to use API)

    php artisan jwt:secret
    
Run the database migrations and Seeding (**Set the database connection in .env before migrating**)

    php artisan migrate --seed
Start the local development server

    php artisan serve
    
You can now access the server at http://localhost:8000

## Issues

If you come across any issues please report them [here](https://github.com/MgHtinLynn/mini-loan/issues).


# API Collection
[File](https://github.com/MgHtinLynn/mini-loan/blob/master/miniLoanAPICollection.json)

# Contributing
Feel free to create any pull requests for the project. For proposing any new changes or features you want to add to the project, you can send us an email at htinlin01@gmail.com.

## License

[MIT LICENSE](https://github.com/MgHtinLynn/mini-loan/blob/master/LICENSE.txt)

