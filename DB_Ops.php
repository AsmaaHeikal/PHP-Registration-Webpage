<?php
    include 'DB_Ops.php';
    include 'Upload.php';
    include 'API_Ops.php';
    ?>
   <! Doctype html>
       <html lang="en">

       <head>
           <meta charset="utf-8">
           <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
           <title> Registration Form </title>
           <style>
               body {
                   font-family: Arial, sans-serif;
                   margin: 0;
                   padding: 0;
                   background-color: #76ABAE;
               }

               .page-body {
                   width: 50%;
                   margin: 70 auto;
                   padding: 20px;
                   background-color: #EEEEEE;
                   border-radius: 30px;
                   box-shadow: 0 0 25px rgba(0, 0, 0, 1);
               }

               .title {
                   text-align: center;
                   margin-bottom: 20px;
                   color: #222831;
               }

               form {
                   width: 100%;
               }

               table {
                   width: 100%;
                   border-collapse: collapse;
               }

               td {
                   padding: 10px;
                   border-bottom: 1px solid #ddd;
                   color: #222831;
               }

               td b {
                   display: block;
                   margin-bottom: 5px;
               }

               tr:last-child td {
                   border-bottom: none;
               }

               input[type="text"],
               input[type="password"],
               input[type="email"],
               textarea,
               select {
                   width: calc(100% - 16px);
                   padding: 8px;
                   border: 1px solid #ddd;
                   border-radius: 10px;
                   box-sizing: border-box;
                   color: #222831;
                   
               }

               input[type="date"] {
                   width: calc(82% - 16px);
                   padding: 8px;
                   border: 1px solid #ddd;
                   border-radius: 10px;
                   box-sizing: border-box;
                   color: #222831;
               }

               input[type="file"] {
                   padding: 8px;
               }

               input[type="submit"],
               input[type="reset"] {
                   padding: 20px 70px;
                   background-color: #31363F;
                   color: #fff;
                   border: none;
                   border-radius: 10px;
                   cursor: pointer;
                   transition: background-color 0.3s;
                   margin-top: 30px;
                   font-size: medium;
               }

               input[type="submit"]:hover,
               input[type="reset"]:hover,
               button[id="checkActors"]:hover {
                   opacity: 80%;
               }

               @media (max-width: 768px) {
                   .page-body {
                       width: 90%;
                   }
               }

               button[id="checkActors"] {
                   padding: 8px;
                   background-color: #31363F;
                   color: #fff;
                   border: none;
                   border-radius: 10px;
                   cursor: pointer;
                   transition: background-color 0.3s;
                   margin-top: 10px;
                   font-size: medium;
               }
               .error {
                color: #af4242;
                background-color : #fde8ec;
                display: none;
               }
               .form-message {
                display: none; 
                background-color: #ffcccc; 
                color: #990000; 
                padding: 10px; 
                border-radius: 5px; 
                margin-top: 10px; 
                border: 1px solid #ff3333; 
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); 
            }

           </style>
           <?php
           if($pic_error != null){
            ?> <style>.pic-error {display: block}</style> <?php
           }
           ?>
       </head>

       <body>
           <?php include 'Header.php'; ?>

           <section class="page-body">
               <div class="title">
                   <h1> Registration Form </h1>
               </div>
               <form method="post" enctype="multipart/form-data" action="#" id="form">
                   <table>
                       <tr>
                           <td colspan="2"> <?php echo @$msg; ?> </td>
                       </tr>
                       <div class="form-message" ></div>
                       <tr>
                           <td width="159"> <b> Full Name <span style="color:red"> * </span></b> </td>
                           <td width="218">
                               <input type="text" placeholder="Enter your full name" name="n" pattern="[a-z A-Z]*"  />
                           </td>
                       </tr>
                       <tr>
                           <td width="159"> <b> Username <span style="color:red"> * </span> </b> </td>
                           <td width="218">
                               <input type="text" placeholder="Enter your username" name="u" pattern="[a-z A-Z]*"  />
                           </td>
                       </tr>
                       <tr>
                           <td> <b> Birthdate <span style="color:red"> * </span></b> </td>
                           <td>
                               <input type="date" name="birthdate" min='1899-01-01' max='2005-12-31'  />
                               <button type="button" id="checkActors">check</button>
                           </td>
                       </tr>
                       <tr>
                           <td> <b> Phone Number <span style="color:red"> * </span></b> </td>
                           <td> <input type="text" pattern="[0-9]*" name="m" / placeholder=" Enter your phone number"  /> </td>
                       </tr>
                       <tr>
                           <td> <b> Address </b> </td>
                           <td> <textarea name="add" placeholder="Enter your address" ></textarea> </td>
                       </tr>
                       <tr>
                           <td> <b> Password <span style="color:red"> * </span></b> </td>
                           <td> <input type="password" name="p" / placeholder=" Enter password" > </td>
                       </tr>
                       <tr>
                           <td> <b> Confirm Password <span style="color:red"> * </span></b> </td>
                           <td> <input type="password" name="cp" / placeholder=" Confirm password" > </td>
                       </tr>
                       <tr>
                           <td> <b> Profile Picture </b> </td>
                           <td> <input type="file" name="pic"  /> </td>
                           <td> <p class= "error pic-error"> 
                            <?php echo $pic_error ?>
                           </p> </td>
                       </tr>
                       <tr>
                           <td> <b> Email  <span style="color:red"> * </span> </b> </td>
                           <td> <input type="email" name="e" / placeholder="Enter your email"  /> </td>
                       </tr>
                       <tr>
                           <td colspan="2" align="center">
                           <input type="submit" name="save" value="Register" onclick="submitForm()" id="btn" />
                               <input type="reset" value="Reset" />
                           </td>
                       </tr>
                   </table>
               </form>
               <div id="actorDetails"></div>
           </section>
           <?php include 'Footer.php'; ?>
           
           
           
           
           
           <script>
            document.getElementById("btn").addEventListener('click',function(event){
                event.preventDefault()
            });



            function submitForm(){
                var xmlhttp;
                if(window.XMLHttpRequest){
                    xmlhttp = new XMLHttpRequest();
                }else if (window.ActiveXObject){
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.open("POST","DB_Ops.php",true);
                            xmlhttp.onreadystatechange = function(){
                if (this.readyState === 4 && this.status === 200) {
                    var displaymsg = document.getElementsByClassName('form-message')[0];
                    displaymsg.style.display = "block";
                    if (this.responseText.includes("Registration Success")) {
                        displaymsg.style.backgroundColor = "rgb(182, 237, 185)"; 
                        displaymsg.style.color = " #16281c";
                        displaymsg.style.border = "1px solid #000000";
                        displaymsg.innerHTML = this.responseText;
                        displaymsg.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        document.getElementById('form').reset();

                         
                    } else {
                        displaymsg.style.backgroundColor = "#f474747d"; 
                    }
                    displaymsg.innerHTML = this.responseText;
                    displaymsg.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
                var form = document.getElementById('form');
                var formdata = new FormData(form);
                xmlhttp.send(formdata);
            }

           </script>














           <script>
               document.getElementById('checkActors').addEventListener('click', function() {
                   var birthdate = document.getElementsByName('birthdate')[0].value;
                   if (birthdate) {
                       var xhr = new XMLHttpRequest();
                       xhr.open('POST', 'API_Ops.php', true);
                       xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                       xhr.onreadystatechange = function() {
                           if (xhr.readyState === XMLHttpRequest.DONE) {
                               if (xhr.status === 200) {
                                   document.getElementById('actorDetails').innerHTML = xhr.responseText;
                               } else {
                                   console.error('Error:', xhr.statusText);
                               }
                           }
                       };
                       xhr.send('birthdate=' + birthdate);
                   } else {
                       console.error('Birthdate is .');
                   }
               });
           </script>
       </body>

       </html>