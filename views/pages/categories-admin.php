<?php
if(isset($_SESSION['user'])):
    if($_SESSION['user']->role_id == 1):

        ?>

        <div class="container-fluid py-5">
            <div class="container">
                <div class="bg-light rounded">
                    <div class="row py-3">
                        <div class="col-7 m-auto">
                            <h2 class="text-center">Manage categories</h2>
                            <table class="table table-light mt-4">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Caterory</th>
                                    <th scope="col">Delete</th>
                                    <th scope="col">Edit</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php foreach($categories as $c):?>
                                    <tr data-id="<?=$c->category_id?>" id="row_<?=$c->category_id?>">
                                        <td><?=$c->name?></td>
                                        <td><input type="button" class="btn btn-sm btn-outline-danger rounded delete-category" value="Delete" /></td>
                                        <td>
                                            <div class="row p-0">
                                                <div class="col-8">
                                                    <input type="text" class="form-control" id="cat_<?=$c->category_id?>" placeholder="Edit" />
                                                </div>
                                                <div class="col-3">
                                                    <input type="button" class="btn btn-sm btn-success rounded edit-category" value="Done" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach?>
                                </tbody>
                            </table>
                            <input type="text" class="form-control w-50" placeholder="Add category" id="add-category-text">
                            <input type="button" class="btn btn-sm btn-primary rounded mt-3" id="add-category" value="+ Add category" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php else:
        include_once('views/pages/index.php');
        ?>
    <?php endif?>
<?php else:
    include_once('views/pages/index.php');
    ?>
<?php endif?>