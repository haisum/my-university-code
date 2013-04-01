<?php session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>
		Book Repository for SZABIST's Students
        </title>
        <link rel="stylesheet" href="<?php echo $base_url ?>/css/eStyles.css" />
        <link rel="stylesheet" href="<?php echo $base_url ?>/css/colorbox.css" />
        <link rel="stylesheet" href="<?php echo $base_url ?>/css/uploadify.css" />
        <link rel="stylesheet" href="<?php echo $base_url ?>/css/upload.css" />
        <link rel="stylesheet" href="<?php echo $base_url ?>/css/datatable/css/table.css" />

        <script type="text/javascript" src="<?php echo $base_url ?>/scripts/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="<?php echo $base_url ?>/scripts/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="<?php echo $base_url ?>/scripts/swfobject.js"></script>
        <script type="text/javascript" src="<?php echo $base_url ?>/scripts/jquery.uploadify.v2.1.0.min.js"></script>
        <script type="text/javascript" src="<?php echo $base_url ?>/scripts/jquery.dataTables.min.js"></script>
        <script type="text/javascript">

            function loginSuccess(){
            <?php
            if(isset ($_SESSION['user_name'])) {
                $username = htmlspecialchars($_SESSION['user_name']);
            }
            else {
                $roll_no = "";
                $username = "";
            }
            
            ?>
                               $("#user_name").html("<?php echo $username ?>");
                               $("#logout").css("display", "inline");
                               $(".loginName span").css("display", "inline");
                               $("#login").css("display", "none");
                               $("#register").css("display", "none");
                               $("#upload").css("display", "inline");
                           }
        </script>
        <script type="text/javascript" src="<?php echo $base_url ?>/scripts/ejavascript.js"></script>
    </head>

    <body onload="set_base_url('<?php echo $base_url; ?>')">
        <div class="imgLoading"><img src="<?php echo $base_url; ?>/images/loading.gif" alt="loading" id="loading" class="loading"></img></div>
        <div id="logo">
            <a href="<?php echo $base_url; ?>"><img src="<?php echo $base_url; ?>/images/szabist.png" alt="SZABIST" style="float:left;"/></a>
            <div class="loginName"><img src="<?php echo $base_url; ?>/images/elibrary3.png" alt="Elibrary"/></div>
        </div>
        <div id="navigation">
            <ul>
                <li><span id="user_name"></span></li>
                <li><a href="javascript:goHome();" class="active" id="homeLink">Home</a></li>
                <li><a href="<?php echo $base_url; ?>/upload.php" class="links" id="upload">Upload</a></li>
                <li><a href="<?php echo $base_url; ?>/index.php/about" class="links" id="About">About</a></li>
                <li><a href="<?php echo $base_url; ?>/index.php/register" class="links" id="register">Register</a></li>
                <li><a href="javascript:logout();" class="links" id="logout">Logout</a></li>
                <li><a href="<?php echo $base_url; ?>/index.php/login" class="links" id="login">Login</a></li>

            </ul>
        </div>
        <?php
        if(isset ($_SESSION['user_name']) && isset ($_SESSION['user_password']) && $_SESSION['user_roll_no']) {

            ?>
        <script type="text/javascript">
            loginSuccess();
        </script>
    <?php
        }
        ?>
        <div id="search">
            <form action="javascript:search($('#searchBox').val());">
                <input type="text" name="txt_search" class="searchBox" id="searchBox" placeholder="Search Books"/>
                <div class="searchButton"><a href="javascript:search($('#searchBox').val());" >Search</a></div>
            </form>
        </div>
        <div id="grid">
            <div id="left">
                <div class="Banners">
                    <h1 class="title">Most Popular</h1>
                    <div class="content popular">
                        <ul>
<?php echo $popular; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="center">
                <div id="books"  class="centerDivs">
                </div>
                <div id="categories" class="centerDivs">
                    <h1 class="title">Categories</h1>
                    <div class="content centerContent" >
<?php echo $categories;?>
                    </div>
                </div>
                <div id="publishers"  class="centerDivs">
                    <h1 class="title">Publishers</h1>
                    <div class="content centerContent">
<?php echo $publishers;?>
                    </div>
                </div>
            </div>
            <div id="right">
                <div class="Banners">
                    <h1 class="title">Featured</h1>
                    <div class="content featured">
                        <ul>
<?php echo $featured; ?>
                        </ul>
                    </div>
                </div>
                <div class="Banners">
                    <h1 class="title">Newest</h1>
                    <div class="content featured">
                        <ul>
<?php echo $newest; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>