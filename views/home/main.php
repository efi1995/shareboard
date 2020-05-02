<html>
<head>
  <title>Shareboard</title> 
  <!-- Theme CSS - Includes Bootstrap -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>

  <!-- Datepicker -->
  <script src="https://kit.fontawesome.com/yourcode.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- <link rel="stylesheet" href="//resources/demos/style.css">-->  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!-- Flipclock -->
  <script src="<?php echo ROOT_PATH; ?>assets/js/flipclock.js"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/main.css">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Plugin CSS -->
  <!--<link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">-->

</head>
<body>
  <!-- Header -->
  <div class="header">
  <nav class="navbar navbar-expand-lg fixed-top">
    <a class="navbar-brand nav-link js-scroll-trigger" href="<?php echo ROOT_URL;?>"><h1>Shareboard</h1></a>
    <div class="text-right mt-4">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="material-icons fs-41">menu</i>
      </button>
    </div>

    <div class="collapse navbar-collapse over-y-hidden" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      <?php if(isset($_SESSION['is_logged_in'])) : ?>
        <li class="nav-item first dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Projects
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php foreach($viewmodel[0] as $item) : ?>
              <a class="dropdown-item pl-5" href="<?php echo ROOT_PATH;?>posts/update/<?php echo $item['post_id'];?>">
                <?php echo $item['post_title'];?>
              </a>
              <div class="dropdown-divider"></div>
            <?php endforeach;?>
            <a class="dropdown-item pl-5" href="<?php echo ROOT_PATH;?>posts/add">New Project</a>
          </div>
        </li>
        <li class="nav-item active first">
          <a class="nav-link" href="<?php echo ROOT_URL; ?>tasks">Tasks</a>
        </li>
        <li class="nav-item first">
          <a class="nav-link" href="<?php echo ROOT_URL; ?>wiki">Wiki</a>
        </li>
        <?php endif;?>
        <li class="nav-item first">
          <a class="nav-link disabled" href="<?php echo ROOT_URL;?>contact">Contact</a>
        </li>
      </ul>

      <ul class="navbar-nav">
      <?php if(isset($_SESSION['is_logged_in'])) : ?>
        <li class="nav-item second">
          <a class="nav-link" href="<?php echo ROOT_URL; ?>users/<?php echo $_SESSION['user_data']['user_id'];?>">Welcome <?php echo $_SESSION['user_data']['user_name'];?></a>
        </li>
        <li class="nav-item second">
          <a class="nav-link" href="<?php echo ROOT_URL; ?>users/logout">Logout</a>
        </li>
        <?php else : ?>
          <li class="nav-item second">
          <a class="nav-link" href="<?php echo ROOT_URL; ?>users/login">Login</a>
        </li>
        <li class="nav-item second">
          <a class="nav-link" href="<?php echo ROOT_URL; ?>users/register">Register</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
  </div>

  <!-- Main pages -->
  <div class="main-page">
    <?php Messages::display(); ?>
    <?php require($view); ?>
  </div>

  <!-- Footer -->
  <footer class="bg-primary footer-position">
    <div class="container">
      <div class="small text-center">Copyright &copy; 2019 - Shareboard</div>
    </div>
  </footer>
  
</body>

<!-- Bootstrap core JavaScript -->
<!-- <script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>  -->

<!-- Plugin JavaScript -->
<!-- <scrpit src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>  -->

</html>