<?php 
    include "incs/auth.php";
    include "incs/header.php" ?>
<?php include "incs/sidebar.php" ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Contact List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item active">Contact List</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contact List</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <?php 
                if (isset($_SESSION['contact_delete_success'])){ ?>
            <div class=" alert alert-success alert-dismissible">
                <?php echo $_SESSION['contact_delete_success'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            </div>
            <?php unset($_SESSION['contact_delete_success']);  }
            
            ?>

            <?php 
                if (isset($_SESSION['contact_delete_error'])){ ?>
            <div class=" alert alert-danger alert-dismissible">
                <?php echo $_SESSION['contact_delete_error'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            </div>
            <?php unset($_SESSION['contact_delete_error']);  }
            
            ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class=" table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Phone Number
                                        </th>
                                        <th>
                                            Message
                                        </th>
                                        <th>
                                            Date
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sn=1;
                                        $sql = "SELECT * FROM contact id ORDER BY id DESC";
                                        $result = $con -> prepare($sql);
                                        $result -> execute();
                                        foreach ($result as $key => $row) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $sn++ ?>
                                        </td>
                                        <td>
                                            <?php echo $row['name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['email'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['pnumber'] ?>
                                        </td>

                                        <td style="width: 300px; overflow: hidden;">
                                            <p class="description"
                                                style="overflow: hidden; max-height: 50px;max-width: 300px;">
                                                <?php echo $row['msg'] ?>
                                            </p>
                                            <button class="btn btn-success btn-sm"
                                                onclick="toggleDescription(this)">Read
                                                More</button>
                                        </td>

                                        <td>
                                            <?php echo $row['create_at'] ?>
                                        </td>
                                        <td>
                                            <?php
                                                $id = $row['id'];
                                                $encodeId = base64_encode($id);
                                            ?>
                                            <a class="btn btn-danger btn-sm"
                                                href="contact_delete.php?id=<?php echo urlencode($encodeId) ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php   }?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<?php include "incs/footer.php" ?>