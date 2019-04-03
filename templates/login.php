<?php require (DOCROOT.'templates/partials/top.php');?>

    <div class="container-fluid">
        <div class="row" id="login-row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel">
                    <div class="panel-body">
                        <h1 class="text-primary">Channel One</h1>
                        <form autocomplete="off" name="loginForm" novalidate ng-submit="cntrl.login(loginForm.$valid)" id="login-form">
                            <div class="form-group form-group-lg" ng-class="loginForm.email.$valid && !loginForm.$pristine ? 'has-success':'has-error'" >
                                <input autocomplete="off" required type="email" placeholder="email" class="form-control" ng-model="cntrl.user.email" name="email">
                            </div>
                            <div class="form-group form-group-lg" ng-class="loginForm.password.$valid && !loginForm.$pristine ? 'has-success':'has-error'">
                                <input autocomplete="off" required type="password" placeholder="password" ng-model="cntrl.user.password" class="form-control" name="password">
                            </div>
                            <div class="form-group form-group-lg">
                                <button ng-disabled="loginForm.$invalid" id="submit-btn" type="submit" class="btn btn-lg btn-block btn-primary">Enter <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


<?php require (DOCROOT.'templates/partials/bottom.php');?>