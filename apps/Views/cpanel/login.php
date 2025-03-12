<form autocomplete="off" action="<?php echo Base_URL?>LoginController/authentication_login" method="POST"> 
    <?php  
        if(isset($msg)){// catch msg so use $msg not message.
            echo '<span style="color: blue;front-weight:bold;">'.$msg.'</span>';
        }

        
        ?>
    <table>

        <tr>
            <td>User Name</td>
            <td><input type="text" required name="username"></td>
        </tr>
        <tr>
            <td>password</td>
            <td><input type="text" required name="password"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="login" value="Login">
            </td>
        </tr>
    </table>
</form>
