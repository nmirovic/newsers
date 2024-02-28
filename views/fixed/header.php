<!-- Spinner Start -->
<!--<div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">-->
<!--    <div class="spinner-grow text-primary" role="status"></div>-->
<!--</div>-->
<!-- Spinner End -->


<!-- Navbar start -->
<div class="container-fluid sticky-top px-0">
    <div class="container-fluid bg-light">
        <div class="container px-0">
            <nav class="navbar navbar-light navbar-expand-xl">
                <a href="index.php" class="navbar-brand mt-3">
                    <p class="text-primary display-6 mb-2" style="line-height: 0;">Newsers</p>
                    <small class="text-body fw-normal" style="letter-spacing: 12px;">Nespaper</small>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-light py-3" id="navbarCollapse">
                    <div class="navbar-nav mx-auto border-top">
                        <?php foreach ($nav as $n):?>
                        <a href="index.php?page=<?=substr($n->href, 0, strlen($n->href)-4)?>" class="nav-item nav-link text-uppercase"><?=$n->title?></a>
                        <?php endforeach;?>
                        <?php if(isset($_SESSION['user'])):?>
                        <a href="models/sign-out.php" class="nav-item nav-link text-uppercase">Sign out</a>
                        <?php else:?>
                        <a href="index.php?page=login" class="nav-item nav-link text-uppercase">Login</a>
                        <?php endif;?>

                    </div>
                    <div class="d-flex flex-nowrap border-top pt-3 pt-xl-0">
                        <div class="d-flex">
                            <div class="d-flex align-items-center">
                                <?php if(isset($_SESSION['user'])):?>
                                <?php $user=$_SESSION['user'];?>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?=$user->name?> <?=$user->last_name?>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <?php if($user->role_id == 1):?>
                                            <a class="dropdown-item" href="index.php?page=admin">Admin</a>
                                            <a class="dropdown-item" href="index.php?page=messages">Messages</a>
                                            <a class="dropdown-item" href="index.php?page=categories-admin">Categories</a>
                                            <a class="dropdown-item" href="index.php?page=registration">Registration</a>
                                        <?php endif;?>
                                        <?php if($user->role_id == 2):?>
                                            <a class="dropdown-item" href="index.php?page=approval">Approval</a>
                                            <a class="dropdown-item" href="index.php?page=journalists">Journalists</a>
                                        <?php endif;?>
                                        <?php if($user->role_id == 3):?>
                                            <a class="dropdown-item" href="index.php?page=add-new">Add new</a>
                                            <a class="dropdown-item" href="index.php?page=waiting">For approval</a>
                                        <?php endif;?>

                                    </ul>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->




<!-- Modal Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="input-group w-75 mx-auto d-flex">
                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->