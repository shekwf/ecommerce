<div class="card mb-3">
    <div class="card-header">
        سفارشات
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table float-right" style="direction: rtl">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نام</th>
                    <th>قیمت</th>
                    <th>شماره پیگیری</th>
                    <th>وضعیت</th>

                </tr>
                </thead>
                <tbody>
                <?php
                require_once "../inc/confing.php";
                $orders= mysqli_query($connection,"SELECT * FROM orders");
                while ($row=mysqli_fetch_array($orders)):


                ?>
                <tr>
                    <td>1</td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['price'] ?></td>
                    <td><?php echo $row['authority'] ?></td>
                    <td><?php
                       if ($row['status']==100) {
                           echo "پرداخت انجام شده";
                       }else{
                           echo "پرداخت نا موفق";
                       }
                        ?></td>
                </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

                    </div>



