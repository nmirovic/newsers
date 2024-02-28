<div class="col-lg-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-3 rounded border">
                <h4 class="mb-4">Popular Categories</h4>
                <div class="row g-2">
                    <?php foreach ($categories as $c):?>
                        <div class="col-12">
                            <a href="index.php?page=all-news" class="link-hover btn btn-light w-100 rounded text-uppercase text-dark py-3"><?=$c->name?></a>
                        </div>
                    <?php endforeach;?>
                </div>
                <h4 class="my-4">Stay Connected</h4>
                <div class="row g-4">
                    <div class="col-12">
                        <a href="#" class="w-100 rounded btn btn-primary d-flex align-items-center p-3 mb-2">
                            <i class="fab fa-facebook-f btn btn-light btn-square rounded-circle me-3"></i>
                            <span class="text-white">13,977 Fans</span>
                        </a>
                        <a href="#" class="w-100 rounded btn btn-danger d-flex align-items-center p-3 mb-2">
                            <i class="fab fa-twitter btn btn-light btn-square rounded-circle me-3"></i>
                            <span class="text-white">21,798 Follower</span>
                        </a>
                        <a href="#" class="w-100 rounded btn btn-warning d-flex align-items-center p-3 mb-2">
                            <i class="fab fa-youtube btn btn-light btn-square rounded-circle me-3"></i>
                            <span class="text-white">7,999 Subscriber</span>
                        </a>
                        <a href="#" class="w-100 rounded btn btn-dark d-flex align-items-center p-3 mb-2">
                            <i class="fab fa-instagram btn btn-light btn-square rounded-circle me-3"></i>
                            <span class="text-white">19,764 Follower</span>
                        </a>
                        <a href="#" class="w-100 rounded btn btn-secondary d-flex align-items-center p-3 mb-2">
                            <i class="bi-cloud btn btn-light btn-square rounded-circle me-3"></i>
                            <span class="text-white">31,999 Subscriber</span>
                        </a>
                        <a href="#" class="w-100 rounded btn btn-warning d-flex align-items-center p-3 mb-4">
                            <i class="fab fa-dribbble btn btn-light btn-square rounded-circle me-3"></i>
                            <span class="text-white">37,999 Subscriber</span>
                        </a>
                    </div>
                </div>
                <h4 class="my-4">Popular News</h4>
                <div class="row g-4">
                    <?php foreach ($trending as $t):?>
                    <div class="col-12">
                        <div class="row g-4 align-items-center features-item">
                            <div class="col-4">
                                <div class="rounded-circle position-relative">
                                    <div class="overflow-hidden rounded-circle">
                                        <img src="img/<?=$t->src?>" class="img-zoomin img-fluid rounded-circle w-100" alt="<?=$t->alt?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="features-content d-flex flex-column">
                                    <p class="text-uppercase mb-2"><?=$t->name?></p>
                                    <a href="index.php?page=single&single=<?=$t->news_id?>" class="h6">
                                        <?php if(strlen($t->title) > 27):?>
                                        <?=substr($t->title, 0, 27)."..."?>
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
                    <div class="col-lg-12">
                        <a href="index.php?page=all-news" class="link-hover btn border border-primary rounded-pill text-dark w-100 py-3 mb-4">View More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>