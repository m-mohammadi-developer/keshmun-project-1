# Set up the project

1. Create A database(utf8_general_ci recomended) and import projects_keshmun_project_php.sql into it

2. In /bootstrap/config/config.php
  you need to add database information
 
3. In /bootstrap/config/constants.php
  3.1 :: You should define SITE_ROOT and SITE_URL
  
4. if you want to add more admin users just add them to /bootstrap/config/constants.php to $users array (with bcrypt hashed password)

## And Finish Every thing is ready
  
