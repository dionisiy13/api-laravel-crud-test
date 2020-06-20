
## Set up the project

Copy .env file
```
cp .env.example .env
```

Start our containers
```
./vessel start
```

Install composer
```
./vessel composer install
```

Migrate DB
```
./vessel php artisan migrate
```

Seed Users
```
./vessel php artisan db:seed --class=UserSeeder
```

Now the application is ready for working!

Run tests
```
./vessel php artisan test
```


## API

User

####Create the User
```
POST /api/user
```
Fields 
- name - string (required, max 255)
- birth - string (required, format(Y-m-d))
- password - string (required, min 6)
- password_repeat - string (required, min 6, same password)

Example of the answer:

> Status 201 Created
```
{
    "data": {
        "name": "Danys Kurasov",
        "birth": "1995-11-21",
        "email": "dionisiy90@gmail.com",
        "updated_at": "2020-06-20T07:37:18.000000Z",
        "created_at": "2020-06-20T07:37:18.000000Z",
        "id": 51
    },
    "created": true
}
```


####Update the user
```
PUT /api/user/{id}
```
Where:
- id - int (user id) 

Fields 
- name - string (max 255)
- birth - string (format(Y-m-d))
- password - string (min 6)
- password_repeat - string (min 6, same password)

Example of the answer:

> Status 200 Ok
```
{
    "id": 1,
    "name": "Danys Kurasov",
    "birth": "1988-09-29 11:13:09",
    "email": "saige19@example.org",
    "created_at": "2020-06-20T07:30:33.000000Z",
    "updated_at": "2020-06-20T07:41:10.000000Z"
}
```


####List
```
GET /api/user
```
Example of the answer:

> Status 200 Ok
```
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name": "Danys Kurasov",
            "birth": "1988-09-29 11:13:09",
            "email": "saige19@example.org",
            "created_at": "2020-06-20T07:30:33.000000Z",
            "updated_at": "2020-06-20T07:41:10.000000Z"
        },
        {
            "id": 2,
            "name": "Orin Schuppe",
            "birth": "2008-02-07 17:21:59",
            "email": "ora08@example.net",
            "created_at": "2020-06-20T07:30:33.000000Z",
            "updated_at": "2020-06-20T07:30:33.000000Z"
        }
    ],
    "first_page_url": "http://localhost/api/user?page=1",
    "from": 1,
    "last_page": 3,
    "last_page_url": "http://localhost/api/user?page=3",
    "next_page_url": "http://localhost/api/user?page=2",
    "path": "http://localhost/api/user",
    "per_page": 20,
    "prev_page_url": null,
    "to": 20,
    "total": 51
}
```


####Show
```
GET /api/user/{id}
```
Where:
- id - int (user id) 

Example of the answer:

> Status 200 Ok
```
{
    "id": 2,
    "name": "Orin Schuppe",
    "birth": "2008-02-07 17:21:59",
    "email": "ora08@example.net",
    "created_at": "2020-06-20T07:30:33.000000Z",
    "updated_at": "2020-06-20T07:30:33.000000Z"
}
```
