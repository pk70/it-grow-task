# Task requirements
1. [x] PHP 8.1 minimum.
2. [x] Composer.
3. [x] NodeJs minimum v16

# How to install
- `clone https://github.com/pk70/it-grow-task.git`
- `inside folder run composer install`
- `duplicate the .env.example and rename it to .env`
- `inside .env file put your database credentials then add CHARSET=utf8 COLLATION=utf8_general_ci`
- `run php artisan key:generate`
- `run php artisan migrate`
- `run npm install`
- `run npm run build`
- `run php artisan serve`

# api endpoints with query string parameter
- `GET http://127.0.0.1:8000/api/currency_info/AUD?apikey=L3fH5A7`
- `here AUD is for currency code`
- `api documentation https://documenter.getpostman.com/view/17228695/2s83zguQDE`

# Uses instructions
- `If you want to use in your localhost then hit the link in browser http://127.0.0.1:8000`
- `For first time create an account or login`

# Live url
- `http://itgrow.discovernanosoft.com`

# Example api response with a currency code AUD:  
`    {
  "status": "success",
  "description": "successfully done",
  "data": [
    {
      "id": 69,
      "name": "Австралийский доллар",
      "num_code": "036",
      "char_code": "AUD",
      "nominal": 1,
      "value": "17,4757"
    }
  ]
}
  
 