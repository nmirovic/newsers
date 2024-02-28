<!-- Footer Start -->
<div class="container-fluid bg-dark footer">
    <div class="container py-4">
        <div class="row justify-content-around g-5">
            <div class="col-lg-6 col-xl-3">
                <div class="footer-item-1">
                    <h4 class="mb-4 text-white">Get In Touch</h4>
                    <p class="text-secondary line-h">Address: <span class="text-white">123 Streat, New York</span></p>
                    <p class="text-secondary line-h">Email: <span class="text-white">Example@gmail.com</span></p>
                    <p class="text-secondary line-h">Phone: <span class="text-white">+0123 4567 8910</span></p>
                    <div class="d-flex line-h">
                        <a class="btn btn-light me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter text-dark"></i></a>
                        <a class="btn btn-light me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f text-dark"></i></a>
                        <a class="btn btn-light me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube text-dark"></i></a>
                        <a class="btn btn-light btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in text-dark"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="d-flex flex-column text-start footer-item-3">
                    <h4 class="mb-4 text-white">Popular news</h4>
                    <?php foreach ($trending as $key=>$t):?>
                    <?php if($key==3) break;?>
                    <div>
                        <p class="mb-0"><?=$t->name?></p>
                        <a class="text-white text-decoration-underline" href="index.php?page=single&single=<?=$t->news_id?>">
                            <?php if(strlen($t->title) > 78):?>
                                <?=substr($t->title, 0, 78)."..."?>
                            <?php else:?>
                                <?=$t->title?>
                            <?php endif?>
                        </a>
                        <hr>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3">
                <div class="d-flex flex-column text-start footer-item-3">
                    <h4 class="mb-4 text-white">Categories</h4>
                    <?php foreach ($categories as $c):?>
                    <a class="btn-link text-white" href=""><i class="fas fa-angle-right text-white me-2"></i><?=$c->name?></a>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->