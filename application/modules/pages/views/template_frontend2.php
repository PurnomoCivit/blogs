<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/favicon/favicon.ico">

    <title><?php echo $title ?></title>

    <?php if(!empty($setting['analytics'])){ ?>
    <!-- 
        Set Analytics
      -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', '<?php echo $setting["analytics"] ?>', 'auto');
        ga('send', 'pageview');
    </script>
    <?php } ?>

  </head>

  <body>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/template/Ionicons/css/ionicons.min.css"); ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/blog.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/main2.css"); ?>" rel="stylesheet">
    
    <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4">
            <a class="blog-header-logo text-dark" href="<?php echo base_url(); ?>"><?php echo $setting['blog_title']; ?></a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
            <?php echo form_open("search", array("method"=>"GET", "class" => "form-inline")); ?>
            <div class="form-group add-on">
              <input class="form-control" placeholder="Search" name="search" id="srch-term" type="text">
              <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="ion-search"></i></button>
              </div>
            </div>
            <?php echo form_close(); ?>
            <a class="btn btn-sm btn-outline-secondary" href="sign-in">Sign In</a>
          </div>
        </div>
      </header>

      <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
          <?php if(!empty($tags)){ 
            foreach ($tags as $keyTags => $valueTags) {
             ?> 
              <a class="p-2 text-muted" href="<?php echo base_url($valueTags['tag_name']) ?>">
                <?php echo $valueTags['tag_name'] ?></a>
          <?php }} ?>
        </nav>
      </div>

      <?php echo $contents ?>

    <footer class="blog-footer">
      <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!-- <script>window.jQuery || document.write('<script src="<?php echo asset("assets/js/jquery-slim.min.js") ?>"></script>')</script> -->
    <script src="<?php echo base_url('assets/js/jquery-slim.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/holder.min.js") ?>"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  </body>
</html>
