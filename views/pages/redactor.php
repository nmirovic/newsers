<?php
if(isset($_SESSION['user'])):
    if($_SESSION['user']->role_id == 2):
        $user = $_SESSION['user'];
        $journalists = manageJournalists();
        $moderator = array_column(getUserCategory(),"name");
        $moderatorCategories = getUserCategory();
        $i = 0;
        ?>


        <div class="container py-5">
            <h2 class="text-center">Journalists</h2>
            <div class="row mt-3">
                <div class="col-10 m-auto">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Categories</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($journalists as $j):?>
                            <tr>
                                <input type="hidden" id="idUserToChange" value="<?=$j->user_id?>" />
                                <th scope="row"><?=$j->name?> <?=$j->last_name?></th>
                                <td><?=$j->email?></td>
                                <td>
                                    <?php
                                    $categories=getUserCategory($j->user_id);
                                    $helper = array_column($categories,"name");
                                    ?>

                                    <?php foreach($categories as $c):?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input journalist" data-id="<?=$c->category_id?>" data-user="<?=$j->user_id?>" <?=in_array($c->name, $moderator) ? "" : "disabled"?> type="checkbox" id="cat-<?=$i?>-<?=$c->category_id?>" <?=in_array($c->name, $helper) ? "checked data-delete='true'" : "" ?> value="<?=$c->category_id?>"
                                            />
                                            <label class="form-check-label journalist" data-id="<?=$c->category_id?>" data-user="<?=$j->user_id?>" for="cat-<?=$i?>-<?=$c->category_id?>"><?=$c->name?></label>
                                        </div>
                                        <?php $i++?>
                                    <?php endforeach;?>

                                    <?php $diff = diffCategories($j->user_id)?>
                                    <?php if(count($diff) != 0):?>
                                        <?php foreach($diff as $d):?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input journalist" data-id="<?=$d->category_id?>"  data-user="<?=$j->user_id?>" type="checkbox" id="cat-<?=$i?>-<?=$d->category_id?>" value="<?=$d->category_id?>" />
                                                <label class="form-check-label journalist" data-id="<?=$d->category_id?>" data-user="<?=$j->user_id?>" for="cat-<?=$i?>-<?=$d->category_id?>"><?=$d->name?></label>
                                            </div>
                                            <?php $i++?>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>

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

