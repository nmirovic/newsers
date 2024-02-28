<?php
    $news = allNews2(null, null);
?>
<!-- Latest News Start -->
<div class="container-fluid latest-news py-4 mb-5">
    <div class="container">
        <h2 class="mb-4">All News</h2>
        <div class="row justify-content-center mb-4">
            <div class="col-3">
                <select class="form-select mx-4" aria-label="Default select example" id="filterNews">
                    <option value="0">Categories</option>
                    <?php foreach($categories as $c):?>
                        <option value="<?=$c->category_id?>"><?=$c->name?></option>
                    <?php endforeach?>
                </select>
            </div>
            <div class="col-3">
                <select class="form-select mx-4" aria-label="Default select example" id="orderNews">
                    <option value="0">Order by</option>
                    <option value="1">Oldest</option>
                    <option value="2">Newest</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div id="insert-news">

                </div>
                <ul class="pagination" id="pagination-page"></ul>
            </div>
            <?php include_once "views/fixed/sidebar.php"?>
        </div>
</div>
</div>
<!-- Latest News End -->

<!-- Most Populer News End -->


