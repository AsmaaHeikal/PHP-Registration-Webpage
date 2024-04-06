    <! Doctype html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title> Registration Form </title>
            <style>
                
            </style>
        </head>

        <body>
            <h1> Registration Form </h1>
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
                        <td> <b> Select your Profile Pic </b> </td>
                        <td> <input type="file" name="pic" /> </td>
                    </tr>
                    <tr>
                        <td> <b> Enter your Email </b> </td>
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
        </body>

        </html>
        <?php
        extract($_POST);
        if (isset($save)) {
            $dob = $yy . "-" . $mm . "--" . $dd;
            $h = implode(",", $hobb);
            $img = $_FILES['pic']['name'];
            if ($return) {
                $msg = "<font color='red'>" . ucfirst($e) . " already exists choose another email </font>";
            } else {
                $msg = "<font color='blue'> your data saved </font>";
            }
        }
        ?>