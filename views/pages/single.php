<?php
if(isset($_GET['single'])):
    $new = singleNew($_GET['single']);
    $comments = getComments($new->news_id);
    if(isset($_SESSION['user'])){
        if($_SESSION['user']->role_id == 2){
            $categoriesRed = array_column(getUserCategory(), "category_id");
        }
    }
?>


        <!-- Single Product Start -->
        <div class="container-fluid py-2" id="single-modal">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="position-relative rounded overflow-hidden mb-3">
                            <img src="img/<?=$new->src?>" class="img-zoomin img-fluid rounded w-100" alt="">
                            <div class="position-absolute text-white px-4 py-2 bg-primary rounded" style="top: 20px; right: 20px;">
                                <?=$new->name?>
                            </div>
                        </div>
                        <div class="mb-4">
                            <a href="#" class="h1 display-5"><?=$new->title?></a>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="text-dark link-hover me-3"><i class="fa fa-clock"></i> <?=date("l, j M Y", strtotime($new->date))?></a>
                            <a href="#" class="text-dark link-hover me-3"><i class="fa fa-comment-dots"></i> <?=count($comments)?> Comments</a>
                        </div>
                        <div class="my-2">
                            <i class="fas fa-thumbs-up like" data-table="news" data-type="likes" data-id="<?=$new->news_id?>"></i> <span class="ml-1"><?=$new->likes?></span>
                            <i class="fas fa-thumbs-down ml-3 like" data-table="news" data-type="dislikes" data-id="<?=$new->news_id?>"></i> <span class="ml-1"><?=$new->dislikes?></span>
                        </div>
                        <?php if(isset($_SESSION['user'])):?>
                        <div>
                                <?php $user=$_SESSION['user'];?>
                                <?php if($user->role_id == 1 || ($user->role_id == 2 && in_array($new->category_id,$categoriesRed)==true) || ($user->role_id == 3 && $new->user_id=$user->user_id && ($new->active == 2 || $new->active==3))):?>
                                    <input type="button" data-img="<?=$new->img_id?>" data-src="<?=$new->src?>" value="DELETE NEW" class="mt-1 btn btn-danger btn-sm" id="deleteNew" />
                                    <input type="button" data-img="<?=$new->img_id?>" data-src="<?=$new->src?>" value="EDIT NEW" class="mt-1 btn btn-primary btn-sm ml-4" id="editNew" data-admin="<?=$user->role_id == 1? 1 : 0?>" />
                                <?php endif?>
                        </div>
                        <?php endif?>
                        <p class="my-4"><?=$new->content?></p>
                        <div class="bg-light rounded p-4">
                            <h4 class="mb-4">Comments</h4>
                            <div class="p-2 bg-white rounded mb-4">
                                <?php if(count($comments) == 0):?>
                                    <h3 class="text-center"> NO COMMENTS</h3>
                                <?php else:?>
                                    <?php foreach ($comments as $c):?>
                                <div class="row mb-3">
                                    <div class="col-9 m-auto mt-3">
                                        <i class="fas fa-thumbs-up like" data-table="comments" data-type="likes" data-id="<?=$c->comm_id?>"></i> <span class="ml-1"><?=$c->likes?></span>
                                        <i class="fas fa-thumbs-down ml-3 like" data-table="comments" data-type="dislikes" data-id="<?=$c->comm_id?>"></i> <span class="ml-1"><?=$c->dislikes?></span>
                                        <div class="d-flex justify-content-between position-relative">
                                            <input type="hidden" value="<?=$c->comm_id?>" />
                                            <h5>Author: <?=$c->author?></h5>
                                            <small class="text-body d-block mb-3"><i class="fas fa-calendar-alt me-1"></i>
                                                <?=date("l, j M Y", strtotime($c->comment_date))?>
                                                <?php if(isset($_SESSION['user'])):?>
                                                    <?php if($_SESSION['user']->role_id == 1):?>
                                                        <button data-id="<?=$c->comm_id?>" class="border-0 text-danger bg-transparent nc-delete position-absolute"><i class="fas fa-times" aria-hidden="true"></i></button>
                                                    <?php endif?>
                                                <?php endif?>

                                            </small>
                                        </div>
                                        <p class="mb-0"><?=$c->content?></p>
                                    </div>
                                </div>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="bg-light rounded p-4 my-4">
                            <h4 class="mb-4">Leave A Comment</h4>
                            <form action="models/post-comment.php" method="post">
                            <div class="row g-4">
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" placeholder="Enter your name" name="author" <?php if(isset($_SESSION['authorValue'])):?>value="<?=$_SESSION['authorValue']?>"<?php endif?> />
                                        <?php if(isset($_SESSION['author'])){
                                            echo "<p class='text-danger mb-0'>".$_SESSION['author']."</p>";
                                            unset($_SESSION['author']);
                                        }
                                        ?>
                                        <?php unset($_SESSION['authorValue']);?>
                                    </div>
                                    <div class="col-12">
                                        <textarea name="comment" placeholder="Enter your comment here" rows="3" class="form-control mb-2"><?php if(isset($_SESSION['commentValue'])):?><?=$_SESSION['commentValue']?><?php endif?></textarea>
                                        <?php if(isset($_SESSION['comment'])){
                                            echo "<p class='text-danger mb-0'>".$_SESSION['comment']."</p>";
                                            unset($_SESSION['comment']);
                                        }
                                        ?>
                                        <?php unset($_SESSION['commentValue']);?>
                                    </div>
                                    <div class="col-12">
                                        <input type="hidden" value="<?=$_GET['single']?>" name="idNew" id="idNew" />
                                        <button class="form-control btn btn-primary" name="btn" type="submit">Leave a comment</button>
                                    </div>
                                </div>
                                <?php if(isset($_SESSION['successfullyAdd'])){
                                    echo "<p class='text-success mb-0'>".$_SESSION['successfullyAdd']."</p>";
                                    unset($_SESSION['successfullyAdd']);
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                    <?php include_once "views/fixed/sidebar.php"?>

                </div>
            </div>
        </div>
        <!-- Single Product End -->
<?php else:
    include_once('views/pages/index.php');
    ?>
<?php endif?>