# Lambda Platform Laravel v2

## Installation
#Create a project

composer create-project lambda-platform/laravel my-app
Composer install  /rm -rf vendor заримдаа хийлгээдэг шүү/
Copy .env.example to .env and tailor for your app, configure the baseURL and any database settings.

php artisan jwt:secret

php artisan key:generate
#Database generate

php artisan migrate

php artisan db:seed

#javascript dependency

Yarn Байхгүй бол global р суулгах

Yarn install Эсвэл yarn ажилуулах

#Runs a defined admin and lambda package scripts

Yarn lstart  - админ ажилуулах

#try to login

domain.dev/auth/login нэвтрэх хуудас орж ирж байгааг шалгах

Username:superadmin password:superadmin нэвтэрч ламбда удирдлага ажиллаж байгааг шалгах

#work as superadmin

Хандах эрх зөвшөөрөл хэсгээс Админ эрх үүсгэх

Хэрэглэгчид цэснээс Шинээр админ эрхтэй хэрэглэгч нэмэх

Цэсний тохиргоонд шинэ цэс нэмэх

Хандах эрх зөвшөөрөл цэснээс хэрэглэгчид харагдах цэс сонгож харгалзах зөвшөөрөл өгөх

#login admin panel

Шинээр үүсгэсэн хэрэглэгчээс дахин нэвтэрч орох

