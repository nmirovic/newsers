<?php
if(isset($_SESSION['user'])):
    if($_SESSION['user']->role_id == 3):
        $news = waitingNews();
        ?>
        <div class="container-fluid py-5">
            <div class="container">
                <div class="bg-light rounded">
                    <div class="row py-3">
                        <div class="col-7 m-auto">
                            <h3>News for approval</h3>
                            <?php if(count($news) == 0):?>
                                <h3>There are no news for approval</h3>
                            <?php else:?>


                                <?php foreach ($news as $n):?>
                                    <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                                        <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                                            <div class="mb-2">
                                                <?php if($n->active == 3):?>
                                                    <form action="models/send-new.php" method="post">
                                                        Draft:
                                                        <input type="hidden" name="newId" value="<?=$n->news_id?>">
                                                        <input type="submit" value="Send" name="btn" class="btn btn-primary"><br>
                                                    </form>
                                                <?php else:?>
                                                    <?php if($n->active == 2):?>
                                                        <h5 class="text-danger">NOT APPROVED</h5>
                                                    <?php else:?>
                                                        <h5 class="text-success">APPROVED</h5>
                                                    <?php endif;?>
                                                <?php endif;?>


                                                <a>Date posted: <?=date("l, j M Y", strtotime($n->date))?></a>
                                            </div>
                                            <a class="h6 m-0 text-secondary text-uppercase text-decoration-underline font-weight-bold" href="index.php?page=single&single=<?=$n->news_id?>">
                                                <?php if(strlen($n->title) > 35):?>
                                                    <?=substr($n->title, 0, 35)."..."?>
                                                <?php else:?>
                                                    <?=$n->title?>
                                                <?php endif?>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            <?php endif;?>

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