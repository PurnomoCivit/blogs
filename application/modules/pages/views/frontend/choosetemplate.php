<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Do you want have a Blog? just fill this form and choose themes. So, Let's start in here.">
    <meta name="keywords" content="Create Own Blog, Create Blog, Blog">
    <meta name="author" content="Blog">
	<title><?php echo $title ?></title>

</head>
<body>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link href="<?php echo base_url("assets/css/create.css"); ?>" rel="stylesheet">

    <div class="container">
    	<div class="create-blog">
	    <div class="bd-featurette">
	    	<div class="container">
		    	<h2 class="bd-featurette-title">Create Your Own Blog in Here</h2>
		    	<p class="lead">
		    		Do you want have a Blog? just fill this form and choose themes. So, Let's start in here.
		    	</p>

	    	</div>
	    </div>

	    <!-- Breadcrumbs -->
	    <div class="bd-featurette">
	    	<div class="container">
	    		<div class="breadcrumb">
			    	<div class="btn-group btn-breadcrumb">
			            <a href="create-blog" class="btn btn-default <?php echo $currentpage === 'create-blog' ? 'active' : ''; ?>">Create Blog</a>
			            <a href="#" class="btn btn-default <?php echo $currentpage === 'choose-template' ? 'active' : ''; ?>">Choose Template</a>
			            <a href="#" class="btn btn-default <?php echo $currentpage === 'finish' ? 'active' : ''; ?>">Finish</a>
			        </div>
		    	</div>
	    	</div>
	    </div>


	    <div class="bd-featurette">
	    	<div class="container">
			    	<?php echo form_open() ?>
			    	<div class="btn-form-center">
			    		<div class="row" data-toggle="buttons">
							<label class="col-xs-12 col-md-6 btn btn-default template1">
						    	<input type="checkbox" value="template_frontend1"  name="templateId" autocomplete="off"> <div class="template-title" >Template 1</div>
						  	</label>
						  	<label class="col-xs-12 col-md-6 btn btn-default template2">
						    	<input type="checkbox" value="template_frontend2" name="templateId" autocomplete="off"> <div class="template-title" >Template 2</div>
						  	</label>
						</div>
						<input type="hidden" name="id" value="<?php echo $this->session->userdata('id')?>">
					</div>
		    		<div class="btn-form-center">
					  <button type="submit" name="updated_at" class="btn btn-lg btn-success" value="<?php echo date('Y-m-d H:i:s')?>">Choose Template Now</button>
					</div>
		    	<?php echo form_close() ?>
				</div>
	    	</div>
	    </div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>
</html>