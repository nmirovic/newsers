
<!-- Features Start -->
<div class="container-fluid features mb-5">
    <div class="container py-5">
        <div class="row g-4">
            <?php foreach ($trending as $t):?>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="row g-4 align-items-center features-item">
                    <div class="col-4">
                        <div class="rounded-circle position-relative">
                            <div class="overflow-hidden d-flex align-items-center" style="width: 100px;height: 100px" >
                                <img src="img/<?=$t->src?>"  class="img-fluid" alt="<?=$t->alt?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="features-content d-flex flex-column">
                            <p class="text-uppercase mb-2"><?=$t->name?></p>
                            <a href="index.php?page=single&single=<?=$t->news_id?>" class="h6">
                                <?php if(strlen($t->title) > 40):?>
                                    <?=substr($t->title, 0, 40)."..."?>
                                <?php else:?>
                                    <?=$t->title?>
                                <?php endif?>
                            </a>
                            <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i> <?=date("l, j M Y", strtotime($t->date))?></small>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
<!-- Features End -->


<!-- Main Post Section Start -->
<div class="container-fluid py-2">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-7 col-xl-8 mt-0">
                <div class="position-relative overflow-hidden rounded">
                    <img src="img/<?=$headline[0]->src?>" class="img-fluid rounded img-zoomin w-100" alt="<?=$headline[0]->alt?>">
                    <div class="d-flex justify-content-center px-4 position-absolute flex-wrap" style="bottom: 10px; left: 0;">
                        <a class="text-white me-3 link-hover"><i class="fa fa-clock"></i> <?=date("l, j M Y", strtotime($headline[0]->date))?></a>
                        <a class="text-white me-3 link-hover"><i class="fa fa-comment-dots"></i> <?=$headline[0]->comments?> Comments</a>
                    </div>
                </div>
                <div class="border-bottom py-3">
                    <a href="index.php?page=single&single=<?=$headline[0]->news_id?>" class="display-4 text-dark mb-0 link-hover">
                        <?php if(strlen($headline[0]->title) > 35):?>
                            <?=substr($headline[0]->title, 0, 35)."..."?>
                        <?php else:?>
                            <?=$headline[0]->title?>
                        <?php endif?>
                    </a>
                </div>
                <p class="mt-3 mb-4">
                    <?php if(strlen($headline[0]->content) > 100):?>
                        <?=substr($headline[0]->content, 0, 100)."..."?>
                    <?php else:?>
                        <?=$headline[0]->content?>
                    <?php endif?>
                </p>
            </div>
            <div class="col-lg-5 col-xl-4">
                <div class="bg-light rounded p-4 pt-0">
                    <div class="row g-4">
                        <?php for ($i = 1; $i < 6; $i++):?>
                        <div class="col-12">
                            <div class="row g-4 align-items-center">
                                <div class="col-5">
                                    <div class="overflow-hidden rounded">
                                        <img src="img/<?=$headline[$i]->src?>" class="img-zoomin img-fluid rounded w-100" alt="<?=$headline[$i]->alt?>">
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="features-content d-flex flex-column">
                                        <a href="index.php?page=single&single=<?=$headline[$i]->news_id?>" class="h6">
                                            <?php if(strlen($headline[$i]->title) > 40):?>
                                                <?=substr($headline[$i]->title, 0, 40)."..."?>
                                            <?php else:?>
                                                <?=$headline[$i]->title?>
                                            <?php endif?>
                                        </a>
                                        <small><i class="fa fa-clock"> <?=date("l, j M Y", strtotime($headline[0]->date))?></i> </small>
                                        <small><i class="fa fa-comment-dots"> <?=$headline[$i]->comments?></i></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endfor;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Post Section End -->


<!-- Latest News Start -->
<div class="container-fluid latest-news py-4 mb-5">
    <div class="container">
        <h2 class="mb-4">Latest News</h2>
        <div class="row">
            <?php for ($i = 6; $i < 10; $i++):?>
            <div class="latest-news-item col-3">
                <div class="bg-light rounded">
                    <div class="rounded-top overflow-hidden">
                        <img src="img/<?=$headline[$i]->src?>" class="img-zoomin img-fluid rounded-top w-100" alt="<?=$headline[$i]->alt?>">
                    </div>
                    <div class="d-flex flex-column p-4">
                        <a href="index.php?page=single&single=<?=$headline[$i]->news_id?>" class="h4">
                            <?php if(strlen($headline[$i]->title) > 35):?>
                                <?=substr($headline[$i]->title, 0, 35)."..."?>
                            <?php else:?>
                                <?=$headline[$i]->title?>
                            <?php endif?>
                        </a>
                        <div class="d-flex justify-content-between">
                            <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i><?=date("l, j M Y", strtotime($headline[0]->date))?></small>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor;?>
        </div>
    </div>
</div>
<!-- Latest News End -->

<!-- Most Populer News End -->


