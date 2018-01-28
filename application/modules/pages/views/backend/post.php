
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data
        <small>All Post</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url(); ?>post">Post</a></li>
        <li class="active">Data All Post</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Post</h3>
              <a href="<?php echo base_url(); ?>post/create" class="btn btn-success" style="float: right;">Create</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th>Title</th>
                    <th>Thumbnail</th>
                    <th>Tag</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 1;
                  if(!empty($post)){ 
                    foreach ($post as $key => $value) {
                  ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $value['post_title']; ?></td>
                    <td><?php 
                        if(!empty($value['thumbnail'])){ ?>
                        <img src="<?php echo base_url(); ?>assets/media/<?php echo $value['thumbnail']; ?>" width="150" >
                        <?php } ?>
                    </td>
                    <td><?php echo $value['tag_name']?></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" onclick="window.location='<?php echo base_url()?>post/update/<?php echo $value['id']; ?>'; " class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            Update
                            </button>
                            <button type="button"  onclick="window.location='<?php echo base_url()?>post/delete/<?php echo $value['id']; ?>'; " class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            Delete
                            </button>
                        </div>
                    </td>
                  </tr>
                <?php 
                      $no++;
                      } 
                    }
                   ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Title</th>
                  <th>Thumbnail</th>
                  <th>Tag</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>