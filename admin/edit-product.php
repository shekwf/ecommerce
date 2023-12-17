<?php
//گذاشتن اطلاعات قبلی محصول
$id= $_GET['id'];
$getproduct=mysqli_query($connection,"SELECT * FROM products WHERE id='$id'");
$productRow=mysqli_fetch_array($getproduct);
?>
<div class="card mb-3">
    <div class="card-header">
        ویرایش محصول
    </div>
    <div class="card-body">
        <!-- form area -->
        <form action="actions.php?edit-product=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" value="<?php echo $productRow['title']; ?>" placeholder="عنوان محصول">
                    </div>
                    <div class="form-group">
                        <textarea name="desc" cols="30" rows="10" class="form-control" placeholder="توضیحات محصول"><?php echo $productRow['description']; ?></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-3">
                            <input name="price" type="number" class="form-control" style="margin-left: 14px;" size="60" value="<?php echo $productRow['price']; ?>" placeholder="قیمت">
                        </div>
                    </div>
                </div><!--Main Content-->
                <aside class="col-md-4">
                    <div class="form-group">
                        <input type="reset" class="btn btn-warning btn-lg" value="پاک کردن">
                        <input type="submit" class="btn btn-primary btn-lg" value="افزودن">
                    </div>
                    <div class="form-group">
                        <select name="cat" class="form-control">
                            <?php
                            //نمایش دسته بندی ها
                            $query= mysqli_query($connection,"SELECT * FROM category");
                            while ($row=mysqli_fetch_array($query)):

                                ?>
                            <?php //if ($row['id']==$productRow['cat_id']): ?>
                                <option selected value="<?php echo $row['id']; ?>"><?php echo $row['cat_name']; ?></option>
                           <?php // else: ?>
                            <?php //endif; ?>
                            <?php endwhile; ?>
                        </select>
                    </div>
                     <br>
                    <img src="../uploads/<?php echo $productRow['image']; ?>" style="width: 300px; height: 300px">
                    <br>
                    <div class="form-group">
                        <input name="image" type="file" class="form-control-file">
                    </div>
                </aside><!--SIDEBAR-->
            </div>
        </form>

        <!-- end form -->
    </div>
</div>