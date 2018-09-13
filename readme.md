



## Simple REST API 

### install

##### - run this cmd

- git clone https://github.com/ahmedsalemA/TeamAppWithRepositry.git 
- composer install
- (don't forget to edit your .env )
- php artisan migrate
- sudo composer dump-autoload
- php artisan db:seed
- php artisan serve

##### - second step import json into post man for test your api

<i> this file in the public folder {{ App.postman_collection.json }}
import this file on post-man </i>

#### check your apis

### controllers
- BaseController
- TeamController
- UserController
- RoleController

### models (in Models folder)

- User 
- Role
- Team
- TeamUser
- RoleUser

### Repos Folder (Http/Repos)

- AbstractRepo
- TeamRepo
- UserRepo
- RoleRepo