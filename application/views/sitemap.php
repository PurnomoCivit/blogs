<?php header('Content-type: application/xml; charset="ISO-8859-1"',true);  ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" encoding="UTF-8">
  <url>
  <loc><?php echo base_url();?></loc>
  <priority>1.0</priority>
  </url>

  <?php foreach($post as $k => $v) { ?>
  <url>
  <loc><?= base_url() ?><?= $v['post_slug']?></loc>
  <changefreq>monthly</changefreq>
  <priority>0.5</priority>
  </url>
  <?php } ?>

</urlset>
