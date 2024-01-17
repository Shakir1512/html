<?php
// Handle AJAX request (start)
if( isset($_POST['ajax']) && isset($_POST['name']) && isset($_POST['email']) ){
  echo $_POST['name'];
  echo $_POST['email'];
  exit;
}

?>

<!doctype html>
<html>
 
 <body >
 
   <form method='post' action>
      <input type='text' name='name' placeholder='Enter your name' id='name'>
      <input type='text' name='email' placeholder='Enter your email' id='email'>
      <input type='submit' value='submit' name='submit' id="submit"><br>
      <div id='response'></div>
      <div id='response1'></div>
   </form>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script>
   $(document).ready(function(){
      $('#submit').click(function(){
         var name = $('#name').val();
         var email = $('#email').val();
         $.ajax({
            type: 'post',
            data: {name: name,email:email},
            success: function(data){
               $('#response').text('Name : ' + name);
               $('#response1').text('Email : ' + email);
              
            }
         });
      });
   });
   </script>
 </body>
</html>