# Expenses controller - simple pure PHP Web application

This application will allow control and see how much money you spend on which category in given time stamp. I am working on this application because I want to summarize what I learned about WebDev in online course [Web Applications](https://www.coursera.org/specializations/web-applications).

Live demo - not yet available

### Screenshots
not yet available

### Technologies
- PHP 7
- MySQL
- HTML5
- CSS ([PureCSS layout](https://purecss.io/layouts/side-menu/))
- JavaScript with jQuery

### Database schema
[Link](https://dbdiagram.io/d/5fcf5bb49a6c525a03ba3de20)

![Database image should be there](https://github.com/gordon502/expenses-controller/blob/main/database_schema.png)

### Available operations (in nutshell)
- Before login
  - Register new user
  - Activate account by mail link
  - Reset password
- After login
  - Change password
  - CRUD operations
  - Visualising money changes in the chart
  - and more...

### How to install and run locally (Windows)
1.Download XAMPP 
```
https://www.apachefriends.org/pl/index.html
```
2. Install it on
```
C:\xampp
```
3. Run xampp-control.exe
```
C:\xampp\xampp-control.exe
```
4. Run Apache and MySql
5. Go to SQL admin panel in web browser
```
http://localhost/phpMyAdmin
```
6. Run [SQL Script](https://github.com/gordon502/expenses-controller/script.sql) from repository
7. Paste project files to htdocs folder
```
C:\xampp\htdocs
```
8. Go to localhost in web browser
```
http://localhost
```
