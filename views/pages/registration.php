<?php
if(isset($_SESSION['user'])):
if($_SESSION['user']->role_id == 1):
$categories = selectAll("category");
$roles = selectAll("roles");
?>
<!-- Contact Us Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="bg-light rounded">
            <div class="row py-3">
                <div class="col-7 m-auto" id="model">
                    <h3>Registration</h3>
                    <form id="registration">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" />

                        <label for="lastName" class="mt-3">Last name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Last name" />

                        <label for="email" class="mt-3">Email</label>
                        <input type="email" class="form-control mb-3" id="email" placeholder="Email" />

                        <label id="category">Categories</label><br />
                        <?php foreach($categories as $c):?>
                            <div class="form-check form-check-inline mb-3">
                                <input class="form-check-input categoriesUser" type="checkbox" id="cat-<?=$c->category_id?>" value="<?=$c->category_id?>" />
                                <label class="form-check-label" for="cat-<?=$c->category_id?>"><?=$c->name?></label>
                            </div>
                        <?php endforeach?><br />

                        <label>Role</label><br />
                        <select id="role" class="form-select">
                            <option value="0">Choose</option>
                            <?php foreach($roles as $r):?>
                                <option value="<?=$r->role_id?>"><?=$r->role?></option>
                            <?php endforeach?>
                        </select><br />

                        <label for="password" >Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" />

                        <label for="conf-password" class="mt-3">Confirm Password</label>
                        <input type="password" class="form-control" id="conf-password" placeholder="Confirm Password" />

                        <input type="button" value="Register" class="btn btn-primary font-weight-semi-bold px-4 mt-4" id="register" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Us End -->

<?php else:
    include_once('views/pages/index.php');
    ?>
<?php endif?>
<?php else:
    include_once('views/pages/index.php');
    ?>
<?php endif?>