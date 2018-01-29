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
			            <a href="#" class="btn btn-default <?php echo $currentpage === 'create-blog' ? 'active' : ''; ?>">Create Blog</a>
			            <a href="#" class="btn btn-default <?php echo $currentpage === 'choose-template' ? 'active' : ''; ?>">Choose Template</a>
			            <a href="#" class="btn btn-default <?php echo $currentpage === 'finish' ? 'active' : ''; ?>">Finish</a>
			        </div>
		    	</div>
	    	</div>
	    </div>

	    <div class="bd-featurette">
	    	<div class="container">
	    		<div class="row">
	    			<div class="col-xs-12 col-md-6">
			    	<?php echo form_open() ?>
			    		<div class="form-group">
			    			<label for="title">Blog Title* :</label>
		    				<input type="text" name="blog_title" placeholder="Your Blog Title" class="form-control" id="title" required>
			    		</div>
			    		<div class="form-group">
			    			<label for="description">Blog Description* :</label>
		    				<textarea class="form-control" name="blog_description"  placeholder="Your Blog Description"  id="description" required></textarea>
		    				
			    		</div>
			    		<div class="form-group">
			    			<label for="email">Your Email address* :</label>
		    				<input type="email" name="blog_email"  placeholder="yourname@blogs.com"  class="form-control" id="email" required>
			    		</div>
			    	</div>
			    	<div class="col-xs-12 col-md-6">
			    		<div class="blog-title">
			    			<h3>Term and Privacy</h3>
			    			<div class="col scroll-privacy">
			    				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
			    			</div>
			    		</div>
						<div class="form-check">
					      <label class="form-check-label">
					        <input class="form-check-input" type="checkbox" required="This must is checklist"> Accept our Term and Privacy.
					      </label>
					    </div>
			    	</div>
		    		<div class="btn-form-center">
					  <button type="submit" name="created_at" class="btn btn-lg btn-success" value="<?php echo date('Y-m-d H:i:s')?>">Create Now</button>
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