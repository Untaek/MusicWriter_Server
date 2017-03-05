<?php 
  session_start();

  if(!isset($_SESSION['user_id'])){
    if(isset($_COOKIE['autologin'])){
      include $_SERVER['DOCUMENT_ROOT'].'/dbconn.php';
      $cryptid = $_COOKIE['autologin'];
      $sql="SELECT Email, Nickname, User_id FROM users WHERE User_id_crypt='$cryptid'";
      $query = mysqli_query($conn, $sql);
      $logindata = mysqli_fetch_assoc($query);

      $id= $logindata['User_id'];
      $_SESSION['user_id'] = $logindata['User_id'];
      $_SESSION['email'] = $logindata['Email'];
      $_SESSION['nickname'] = $logindata['Nickname'];
      $_SESSION['logined'] = true;

      setcookie('autologin', $cryptid, time()+60*60*24*7, '/', '127.0.0.1', false, true);
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<script type="text/javascript">
  $(function(){
    var nowpage = "<?php echo $_SERVER['PHP_SELF'] ?>";
    console.log(nowpage);

    switch(nowpage){
      case '/index.php': $('#home').addClass('active');
      break;
      case '/videos/all.php': $('#videos').addClass('active');
      case '/videos/funny.php': $('#videos').addClass('active');
      case '/videos/impressive.php': $('#videos').addClass('active');
      case '/videos/information.php': $('#videos').addClass('active');
      case '/videos/upload.php' : $('#videos').addClass('active');
      case '/videos/post/view.php' :$('#videos').addClass('active');
      break;
      case '/notice.php' : $('#notice').addClass('active');
      break;
      case '/member/mypage.php' : $('#mypage_nav').addClass('active');
    }
  });

  $('#logout_nav a').on('click', function(event) {
    event.preventDefault();
    /* Act on the event */
  });
</script>
<nav class="navbar navbar-inverse" style="border-radius:0;">
  <div class="container-fluid" style="padding-left:0">
    <ul class="nav navbar-nav" style="">
      <li id="home"><a class="glyphicon glyphicon-home" href="/index.php"></a></li>
      <li id="videos"><a href="/videos/all.php?sort=newest&page=1">Videos</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right" style="position:relative;">
      <li id="notice"><a href="/notice.php"><span class="glyphicon glyphicon-asterisk"></span> Notice</a></li>
      <?php
      if(!isset($_SESSION['logined'])){
        echo '<li id="signup_nav"><a href="/member/join.php?page=signup"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
        echo '<li id="login_nav"><a href="/member/join.php?page=login"><span class="glyphicon glyphicon-log-in"></span> Log in</a></li>';
      }else{
        include $_SERVER['DOCUMENT_ROOT'].'/dbconn.php';
        $id = $_SESSION['user_id'];
        $sql = "SELECT Nickname FROM users WHERE User_id=$id";
        $query = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($query);

        echo '<li id="mypage_nav"><a href="/member/user_info.php"><span class="glyphicon glyphicon-user"></span> '.$data["Nickname"].'</a></li>';
        echo '<li id="logout_nav"><a href="/member/logout.php"><span class="glyphicon glyphicon-off"></span> Log out</a></li>';

        mysqli_close($conn);
      }
        ?>
    </ul>
  </div>
</nav>
</body>
</html>
