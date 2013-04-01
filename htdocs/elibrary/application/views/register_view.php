<h2 class ="heading">Register to Upload Books</h2>
             <div class="formInput">
                 <fieldset>
                    <label for="username">Name: </label>
                    <input type="text" name="username" id="user_name"/>
                    <label for="roll">Roll No: </label>
                    <input type="text" name="roll" id="user_roll_no"/>
                    <label for="roll">Password: </label>
                    <input type="password" name="roll" id="user_password"/>
                    <label for="department">Department:</label>
                    <select name="department" id="user_department">
                        <?php
                            echo $departments;
                        ?>
                    </select>
                 </fieldset>
                 <div class="registerButton"><label> &#09;</label><a class="registerButtonA" href="javascript:register();">Register</a></div>
            </div>