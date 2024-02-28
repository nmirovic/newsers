<?php
if(isset($_SESSION['user'])):
    if($_SESSION['user']->role_id == 2):
        $news = forApproval();
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
                                                <form action="models/approve.php" method="post">
                                                    <input type="submit" name="approve" class="btn btn-success" value="Approve">
                                                    <input type="submit" name="deny" class="btn btn-danger ml-5" value="Deny">
                                                    <input type="hidden" name="id" value="<?=$n->news_id?>">
                                                </form>

                                                <a>Date posted: <?=date("l, j M Y", strtotime($n->date))?></a>
                                            </div>
                                            <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="index.php?page=single&single=<?=$n->news_id?>">
                                                <?php if(strlen($n->title) > 55):?>
                                                    <?=substr($n->title, 0, 55)."..."?>
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