      <div class="row mb-2">
        <?php if(!empty($post) || !empty($tags)){ 
          foreach ($tagssearch as $keyTags => $valueTags) { ?>
        <div class="col-md-3">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <h3 class="mb-0">
                <a class="text-dark" href="<?php base_url() ?>tag-detail/<?php echo str_replace(" ", "-", $tags['tag_name'])?>"><?php echo $tags['tag_name']?></a>
              </h3>
            </div>
            <img class="card-img-right flex-auto d-none d-md-block" data-src="<?php echo base_url(); ?>assets/img/DSCF1188.jpg" alt="Card image cap">
          </div>
        </div>
        <?php } foreach ($postsearch as $key => $value) { ?>
       <div class="col-md-3">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">World</strong>
              <h3 class="mb-0">
                <a class="text-dark" href="<?php base_url() ?>tag-detail/<?php echo str_replace(" ", "-", $value['post_slug'])?>"><?php echo $value['post_title']; ?></a>
              </h3>
              <a href="<?php base_url() ?>tag-detail/<?php echo str_replace(" ", "-", $value['post_slug'])?>">Continue reading</a>
            </div>
            <img class="card-img-right flex-auto d-none d-md-block" data-src="<?php echo base_url(); ?>assets/img/DSCF1188.jpg" alt="Card image cap">
          </div>
        </div>
        <?php }} ?>
      </div>