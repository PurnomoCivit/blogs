
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Setting
        <small>Blog</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Setting Blog</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">

          <div class="box box-info">
            <div class="box-header">
                <?php if(!empty($success)){ ?>
                  <div class="callout callout-info" id="success">
                    <p><?php echo $success ?></p>
                  </div>
                <?php }
                  if(!empty($error)){ ?>
                  
                  <div class="callout callout-danger" id="error">
                    <p><?php echo $error ?></p>
                  </div>
                  <?php } ?>
            </div>
            <?php echo form_open_multipart("", array("class"=>"form-horizontal")); ?>
            <div class="box-body">
              <!-- Title Post -->
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Blog Title</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="blog_title" value="<?php echo $setting['blog_title']?>" id="inputEmail3" placeholder="Blog Title" required>
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="blog_email" value="<?php echo $setting['blog_email']?>" id="slug" placeholder="Slug" required>
                  </div>
              </div>
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Analytics</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="analytics" value="<?php echo $setting['analytics']?>" id="inputEmail3" placeholder="Google Analytic" required>
                    <span class="help-block">Get ID from here : <a href="https://analytics.google.com/analytics/web/" target="_blank">Google Analytic</a></span>
                  </div>
              </div>
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Blog Description</label>

                  <div class="col-sm-10">
                    <textarea id="editor1" name="blog_description" rows="10" cols="80" required><?php echo $setting['blog_description']?></textarea>
                  </div>
              </div>
              <div class="box-footer">
                <div class="form-group" style="text-align: center;">
                  <button type="submit" name="updated_at" value="<?php echo date('Y-m-d H:i:s');?>" class="btn btn-success">Update</button>
                </div>
              </div>

              <?php echo form_close(); ?>
              
              <!-- /.form group -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
      </div>
    </section>