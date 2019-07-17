<!--https://github.com/microtrain/bootcamp/blob/master/09-PHP/04-FormValidation.md
exercise 2, f12 > network > name > contact.php, click > headers > 
query string parameters-->

<?php
//Include non-vendor files
require '../core/About/src/Validation/Validate.php';

//Declare Namespaces
use About\Validation;

//Validate Declarations
$valid = new About\Validation\Validate();
$args = [
  'name'=>FILTER_SANITIZE_STRING,
  'subject'=>FILTER_SANITIZE_STRING,
  'message'=>FILTER_SANITIZE_STRING,
  'email'=>FILTER_SANITIZE_EMAIL,
];
$input = filter_input_array(INPUT_POST, $args);

if(!empty($input)){

   $valid->validation = [
      'email'=>[[
              'rule'=>'email',
              'message'=>'Please enter a valid email'
          ],[
              'rule'=>'notEmpty',
              'message'=>'Please enter an email'
      ]],
      'name'=>[[
          'rule'=>'notEmpty',
          'message'=>'Please enter your first name'
      ]],
      'message'=>[[
          'rule'=>'notEmpty',
          'message'=>'Please add a message'
      ]],
  ];


    $valid->check($input);
}

if(empty($valid->errors) && !empty($input)){
    $message = "<div>Success!</div>";
}else{
    $message = "<div>Error!</div>";
}

?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Contact</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="David Schousen Contact Page">
      <meta name="keywords" content="David Schousen, Full Stack, Web Design, Developer, CSM">
      <link rel="stylesheet" type="text/css" href="./dist/css/contact.css">
   </head>
   <body>
      <header>
         <a id="toggleMenu">Menu
         <a>
            <span class="logo">Contact</span> 
            <nav>
               <ul>
                  <li>
         <a href="index.html">Home</a></li>
         <li><a href="resume.html">Resume</a></li>
         <li><a href="contact.php">Contact</a></li>
         </ul>
         </nav>
      </header>
      <main>
         <section>
            <h1>David Schousen</h1>
            <p>Contact Me Page</p>
            <form action="contact.php">
               <div>
                  <label for="name">Name</label>
                  <input id="name" type="text" name="name">
               </div>
               <div>
                  <label for="email">Email</label>
                  <input id="email" type="text" name="email">  
               </div>
               <div>
                  <label for="message">Message</label>
                  <textarea id="message" name="message"></textarea>
               </div>
               <div>
                  <input type="hidden" name="subject" value="New submission!">
               </div>
               <div>
                  <input type="submit" value="Send">
               </div>               
            </form>
            <script>
               var toggleMenu = document.getElementById('toggleMenu');
               var nav = document.querySelector('nav');
               toggleMenu.addEventListener(
                 'click',
                 function(){
                   if(nav.style.display=='block'){
                     nav.style.display='none';
                   }else{
                     nav.style.display='block';
                   }
                 }
               );
            </script>
         </section>
      </main>
   </body>
</html>