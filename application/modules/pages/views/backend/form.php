
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Form Post
        <small><?php ucfirst($action);?> A Post</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="post">Post</a></li>
        <li class="active">Form Post</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Input masks</h3>
            </div>
            <?php echo form_open_multipart("", array("class"=>"form-horizontal")); ?>
            <div class="box-body">
              <!-- Title Post -->
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Title</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" onchange="generateSlug(this.value)" value="<?php echo $post[0]['post_title']?>" id="inputEmail3" placeholder="Title Post" required>
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Slug</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="slug" value="<?php echo $post[0]['post_slug']?>" id="slug" placeholder="Slug" required>
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Image Thumbnail</label>

                  <div class="col-sm-10">
                    <?php if(!empty($post[0]['thumbnail'])){ ?>
                        <img src="<?php echo base_url()."assets/media/".$post[0]['thumbnail']; ?>" width="150px">
                        <input type="hidden" value="<?php echo $post[0]['thumbnail']?>" name="thumbnailupdate">
                    <?php } ?>
                    <input type="file" name="thumbnail" id="exampleInputFile">
                  </div>
              </div>

              <div class="form-group">
                  <label for="tags" class="col-sm-2 control-label">Tags</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="tags" placeholder="Tags"><br />
                    <div id="showOtherTag">
                      <?php if(!empty($post[0]['tag_name'])){ 
                        foreach ($post[0]['tag_name'] as $key => $value) { 
                          echo '<div class"row"><div class="col-sm-10 padding-bottom"><input type="hidden" name="tag['.$key.']" value="'.$value['tag_name'].'" id="tags" placeholder="Tags"><input type="text" class="form-control" value="'.$value['tag_name'].'" disabled></div><div class="col-sm-2"><button type="button" id="tagdelete" value="'.$value['id'].'" onclick="deleteTags(this.value)" class="btn btn-danger fa fa-trash"></button></div></div>';
                        }?>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="cal-sm-2">
                    <button type="button" id="tag" onclick="addTagsForm()" class="btn btn-warning">+</button>
                  </div>
              </div>
              
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Description</label>

                  <div class="col-sm-10">
                    <textarea id="editor1" name="description" rows="10" cols="80" required>
                      <?php echo $post[0]['post_description']?> 
                    </textarea>
                    <script>
                        // Replace the <textarea id='description'> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace('description', {
                            height: 300,
                            filebrowserBrowseUrl: '<?= base_url()?>assets/template/ckfinder/ckfinder.html',
                            filebrowserImageBrowseUrl: '<?= base_url()?>assets/template/ckfinder/ckfinder.html?type=Images',
                            filebrowserUploadUrl: '<?= base_url()?>assets/template/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                            filebrowserImageUploadUrl: '<?= base_url()?>assets/template/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                      });
                  </script>
                  </div>
              </div>
              <?php if($action == "update"){ ?>
              <input type="hidden" name="id" value="<?php echo $post[0]['id']?>" >
              <?php } ?>
              <div class="box-footer">
                <div class="form-group" style="text-align: center;">
                  <button type="reset" class="btn btn-warning">Reset</button>
                  <button type="submit" name="<?php echo $action; ?>" class="btn btn-success"><?php echo ucfirst($action); ?></button>
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
    <script type="text/javascript">
        function generateSlug(slug){
            var finalSlug = slug.split(' ').join('-');
            document.getElementById('slug').value = finalSlug;
        }

        function addTagsForm(){
            var tags = document.getElementById('tags').value;
            var id = 0;
            var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
                csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
            document.getElementById('tags').value = "";
            console.log(tags, csrfHash, csrfName);
            $.ajax({
              "url"       : '<?php echo base_url() ?>tags/create',
              "type"      : "GET",
              "data"      : "tag_name="+tags,
              success: function(result){
                  console.log(result);
                  $('#showOtherTag').append("<div class='row' id='"+result+"'><div class='col-sm-10 padding-bottom'><input type='hidden' class='form-control' name='tag["+result+"]' value='"+tags+"'><input type='text' class='form-control' value='"+tags+"' disabled></div><div class='col-sm-2'><button type='button' id='tagdelete' value='"+result+"' onclick='deleteTags(this.value)' class='btn btn-danger fa fa-trash'></button></div></div>");
                  id++;
              },
            });
        }

        function deleteTags(id){
            $.ajax({
              "url"       : '<?php echo base_url() ?>tags/delete',
              "type"      : "GET",
              "data"      : "id="+id,
              success: function(result){
                  console.log(result);
                  var parent = document.getElementById("showOtherTag");
                  var child = document.getElementById(id);
                  parent.removeChild(child);
              }
            });
        }

    </script>