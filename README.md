# Basic implementation of CQRS - ES in PHP
--------------------------------

###How to clone this project?

Ensure that you already installed git on your computer (https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)

Then open your terminal and type this ```git clone https://yourusername@github.com/asrulsibaoel/implementing-php7-with-es-cqrs.git project-name```

### API List

##### Get List User
Method : GET  
url    : /user/list  
params : page (integer)
 
##### Register User
Method : POST  
URL    : /user/register  
params : username (string), email (string), password (string)

##### Update User
Method : POST  
URL : /user/update/{id}  
params : name (string)