<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>urlcloud</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <link href="/assets/css/app.css" rel="stylesheet">
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">urlcloud</a>
        </div>
        @include('partials.navbar')
      </div>
    </nav>

    <div class="container">

      <div class="page-header">
        <h1>Simple sharing.</h1>
      </div>

      <div class="col-xs-12 col-sm-8 col-sm-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading"><h2>File Upload</h2></div>
              <div class="panel-body">
                  <form action="/api/1/file/upload.json" class="form-horizontal" enctype="multipart/form-data" method="POST">
                    {!! csrf_field() !!}
                      <div class="form-group">
                        <label for="fileName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="name" id="fileName" placeholder="A descriptive file name.">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="fileDesc" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                          <textarea rows="3" class="form-control" name="description" id="fileDesc" placeholder="A descriptive file name."></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                              <label for="fileData" class="col-sm-2 control-label">File input</label>
                        <div class="col-sm-10">
                            <input type="file" id="fileData" name="laracloud">
                            <p class="help-block">File size limit of 2mb.</p>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="tos"> I agree to the <a href="/s/tos">terms of use</a> of this service.
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-default">Upload</button>
                        </div>
                      </div>
                    </form>
              </div>
          </div>
      </div>
    </div>

    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/bootstrap.js"></script>
  </body>
</html>
