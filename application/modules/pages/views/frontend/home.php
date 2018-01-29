
      <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
          <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
          <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
          <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
        </div>
      </div>

    <main role="main" class="container">
      <div class="row">
        <div class="col-md-12 blog-main">
          <h3 class="pb-3 mb-4 font-italic border-bottom">
            From the <?php echo $setting['blog_title']; ?>
          </h3>

          <?php 
          $this->load->helper("Generatedate_helper");
            if(!empty($post)){
              foreach ($post as $keyPost => $valuePost) { ?>

          <div class="blog-post">
            <h2 class="blog-post-title"><?php echo $valuePost['post_title']; ?></h2>
            <p class="blog-post-meta"></p>
            <?php echo $valuePost['post_description']; ?>
            
          </div><!-- /.blog-post -->
          <?php }
          } ?>
          <!-- <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
          </nav> -->

        </div><!-- /.blog-main -->

      </div><!-- /.row -->

    </main><!-- /.container -->