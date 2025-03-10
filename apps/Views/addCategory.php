<form autocomplete="off" action="http://cafeweb.test/CategoryController/InsertCategory" method="POST"> 
    <?php  
        if(isset($msg)){// catch msg so use $msg not message.
            echo '<span style="color: blue;front-weight:bold;">'.$msg.'</span>';
        }

        
        ?>
    <table>

        <tr>
            <td>Title</td>
            <td><input type="text" required name="title"></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><input type="text" required name="description"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="addCategory" value="Insert">
            </td>
        </tr>
    </table>
</form>
