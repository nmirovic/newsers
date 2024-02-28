<?php
if(isset($_SESSION['user'])):
    if($_SESSION['user']->role_id == 1):
        $user = $_SESSION['user'];
        $messages = selectAll("messages");
        ?>


        <div class="container-fluid py-5">
            <div class="container">
                <div class="bg-light rounded">
                    <div class="row py-3">
                        <div class="col-7 m-auto">
                            <h3>Messages</h3>
                            <?php if(count($messages) == 0):?>
                                <h2 class="text-center mt-5">There is no messages</h2>
                            <?php else:?>
                                <?php foreach($messages as $m):?>
                                    <div class="bg-white border border-top-0 p-4">
                                        <div class="media position-relative">
                                            <input type="hidden" value="2">
                                            <div class="media-body">
                                                <h6><p class="text-secondary font-weight-bold mb-0"><?=$m->name?></p> <small><i><?=date("d M Y", strtotime($m->message_date))?></i></small></h6>
                                                <p><?=$m->message?></p>
                                                <a href="mailto:<?=$m->email?>" class="btn btn-sm btn-outline-secondary replyComment">Reply</a>
                                                <input type="button" value="Delete" data-id="<?=$m->message_id?>" class="btn-sm btn btn-danger nc-delete-message">
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach?>
                            <?php endif?>
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