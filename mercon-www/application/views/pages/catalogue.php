<section id="page-title">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="mainTitle">Catalogue</h1>
            </div>
            <ol class="breadcrumb">
                <li>
                    <span>Home</span>
                </li>
                <li class="active">
                    <span>Catalogue</span>
                </li>
            </ol>
        </div>
    </div>
</section>

<section class="container-fluid container-fullw bg-white">
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <?php if ($state > 0) { ?>
                    <div class="alert alert-danger" id="stateError">
                        <strong>We are sorry,</strong> either your registration was not found or the link you have used is more than 24 hours old. Please register to download our product catalogue
                    </div>
                <?php } ?>	
                <h2>Please register to download our product catalogue</h2>

                <hr>

                <form novalidate="novalidate" action="" id="catalogueForm" method="post" class='form-horizontal form-groups-bordered validate'>
                    <div class="alert alert-success hidden" id="formSuccess">
                        <p>
                            Thank you for registering to receive our product catalogue.
                        </p>

                        <p>
                            an email has been sent to you with a link to download our catalogue in PDF format.
                        </p>
                    </div>

                    <div class="alert alert-danger hidden" id="formError">
                        <strong>Error!</strong> There was an error sending your request.
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Name</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" data-msg-required="Please enter your name" maxlength="100" name="name" id="name">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="formName" class="col-md-3 control-label">Email Address</label>

                            <div class="col-md-8">
                                <input type="email" class="form-control" data-msg-required="Please enter your email" maxlength="100" name="email" id="email">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">                            
                            <div class="col-md-offset-3 col-md-5">
                                <div class="checkbox clip-check check-primary">
                                    <input type="checkbox" id="newsletter" name="newsletter" value="1">
                                    <label for="newsletter">
                                        Send Newsletter
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-offset-3 col-md-8">
                            <button type="submit" data-caption-delay="900" data-caption-class="fadeIn" class="btn btn-primary margin-top-15 opacity-0 btn-wide btn-scroll btn-scroll-top fa-arrow-right animated fadeIn">
                                <span>Send Download Link</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>