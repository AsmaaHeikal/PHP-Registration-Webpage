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
               input[type="reset"]:hover {
                   opacity: 80%;
               }

               @media (max-width: 768px) {
                   .page-body {
                       width: 90%;
                   }
               }
           </style>
       </head>

       <body>
           <?php include 'Header.php'; ?>
           <section class="page-body">
               <div class="title">
                   <h1> Registration Form </h1>
               </div>
               <form method="post" enctype="multipart/form-data" action=?#?>
                   <table>
                       <tr>
                           <td colspan="2"> <?php echo @$msg; ?> </td>
                       </tr>
                       <tr>
                           <td width="159"> <b> Full Name </b> </td>
                           <td width="218">
                               <input type="text" placeholder="Enter your full name" name="n" pattern="[a-z A-Z]*" required />
                           </td>
                       </tr>
                       <tr>
                           <td width="159"> <b> Username </b> </td>
                           <td width="218">
                               <input type="text" placeholder="Enter your username" name="u" pattern="[a-z A-Z]*" required />
                           </td>
                       </tr>
                       <tr>
                           <td> <b> Birthdate </b> </td>
                           <td>
                               <select name="mm">
                                   <option value=""> Month </option>
                                   <?php
                                    for ($i = 1; $i <= 12; $i++) {
                                        echo "<option value ='$i'>" . $i . "</option>";
                                    }
                                    ?>
                               </select>
                               <select name="dd">
                                   <option value=""> Date </option>
                                   <?php
                                    for ($i = 1; $i <= 31; $i++) {
                                        echo "<option value ='$i'>" . $i . "</option>";
                                    }
                                    ?>
                               </select>
                               <select name="yy">
                                   <option value=""> Year </option>
                                   <?php
                                    for ($i = 1900; $i <= 2015; $i++) {
                                        echo "<option value ='$i'>" . $i . "</option>";
                                    }
                                    ?>
                               </select>
                           </td>
                       </tr>
                       <tr>
                           <td> <b> Phone Number </b> </td>
                           <td> <input type="text" pattern="[0-9]*" name="m" / placeholder=" Enter your phone number"> </td>
                       </tr>
                       <tr>
                           <td> <b> Address </b> </td>
                           <td> <textarea name="add">  Enter your address </textarea> </td>
                       </tr>
                       <tr>
                           <td> <b> Password </b> </td>
                           <td> <input type="password" name="p" / placeholder=" Enter password"> </td>
                       </tr>
                       <tr>
                           <td> <b> Confirm Password </b> </td>
                           <td> <input type="password" name="p" / placeholder=" Confirm password"> </td>
                       </tr>
                       <tr>
                           <td> <b> Profile Picture </b> </td>
                           <td> <input type="file" name="pic" /> </td>
                       </tr>
                       <tr>
                           <td> <b> Email </b> </td>
                           <td> <input type="email" name="e" / placeholder="Enter your email"> </td>
                       </tr>
                       <tr>
                           <td colspan="2" align="center">
                               <input type="submit" name="save" value="Register" />
                               <input type="reset" value="Reset" />
                           </td>
                       </tr>
                   </table>
               </form>
           </section>
            <?php include 'Footer.php'; ?>
       </body>

       </html>
       <?php


        ?>