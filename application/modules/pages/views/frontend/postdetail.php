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