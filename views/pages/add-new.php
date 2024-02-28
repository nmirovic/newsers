<?php
if(isset($_SESSION['user'])):
    if($_SESSION['user']->role_id == 3):
        $categoriesUser = getUserCategory();
        ?>

        <div class="container-fluid py-5">
            <div class="container">
                <div class="bg-light rounded">
                    <div class="row py-3">
                        <div class="col-7 m-auto">
                            <h3>Add new</h3>
                            <form action="models/add-new.php" method="post" enctype="multipart/form-data">
                                <label>Title</label>
                                <input type="text" class="form-control mb-2" name="title" <?php if(isset($_SESSION['titleValue'])):?>value="<?=$_SESSION['titleValue']?>"<?php endif?> />
                                <?php if(isset($_SESSION['title'])){
                                    echo "<p class='text-danger mb-0'>".$_SESSION['title']."</p>";
                                    unset($_SESSION['title']);
                                }
                                ?>
                                <?php unset($_SESSION['titleValue']);?>

                                <label>Content</label>
                                <textarea name="content" cols="30" rows="5" class="form-control mb-2"><?php if(isset($_SESSION['contentValue'])):?><?=$_SESSION['contentValue']?><?php endif?></textarea>
                                <?php if(isset($_SESSION['content'])){
                                    echo "<p class='text-danger mb-0'>".$_SESSION['content']."</p>";
                                    unset($_SESSION['content']);
                                }
                                ?>
                                <?php unset($_SESSION['contentValue']);?>

                                <label >Category</label>
                                <select name="category" class="form-select-sm mb-2">
                                    <option value="0">Choose</option>
                                    <?php foreach($categoriesUser as $c):?>
                                        <option value="<?=$c->category_id?>"><?=$c->name?></option>
                                    <?php endforeach?>
                                </select><br />
                                <?php if(isset($_SESSION['category'])){
                                    echo "<p class='text-danger mb-0'>".$_SESSION['category']."</p>";
                                    unset($_SESSION['category']);
                                }
                                ?>

                                <label>Picture</label><br />
                                <input type="file" name="picture" class="mb-2" /><br />
                                <?php if(isset($_SESSION['typeError'])){
                                    echo "<p class='text-danger mb-0'>".$_SESSION['typeError']."</p>";
                                    unset($_SESSION['typeError']);
                                }
                                ?>



                                <input type="submit" value="Add new" name="btnAddNew" class="btn btn-primary font-weight-semi-bold px-4 mt-4" />
                                <?php if(isset($_SESSION['successfullyAdd'])){
                                    echo "<p class='text-success mb-0'>".$_SESSION['successfullyAdd']."</p>";
                                    unset($_SESSION['successfullyAdd']);
                                }
                                ?>
                            </form>

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