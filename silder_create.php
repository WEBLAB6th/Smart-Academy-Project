<?php 
 include "incs/auth.php" ?>
<?php include "incs/sidebar.php" ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create slider</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item active">Create slider</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create slider</h3>
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
                if (isset($_SESSION['slider_create_error'])){ ?>
            <div class=" alert alert-danger alert-dismissible">
                <?php echo $_SESSION['slider_create_error'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            </div>
            <?php unset($_SESSION['slider_create_error']);  }
            
            ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="silder_create_act.php" method="post" enctype="multipart/form-data" id="Slider">
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <label for="title" class=" form-label">Title</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="title" id="title" placeholder="Title"
                                        class=" form-control">

                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <label for="description" class=" form-label">Description</label>
                                </div>
                                <div class="col-md-9">
                                    <textarea name="description" id="description" rows="10" class=" form-control"
                                        placeholder="description..."></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <label for="image" class=" form-label">Image</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="file" name="image" id="image" class=" form-control">
                                    <?php if (isset($_SESSION['slider_extension_error'])){ ?>
                                    <small class=" d-block mt-1 alert alert-danger alert-dismissible">
                                        <?php echo $_SESSION['slider_extension_error'] ?>
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">X</button>
                                    </small>
                                    <?php unset($_SESSION['slider_extension_error']); } ?>
                                    <?php if (isset($_SESSION['slider_uploads_error'])){ ?>
                                    <small class=" d-block mt-1 alert alert-danger alert-dismissible">
                                        <?php echo $_SESSION['slider_uploads_error'] ?>
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">X</button>
                                    </small>
                                    <?php unset($_SESSION['slider_uploads_error']); } ?>
                                </div>
                            </div>
                            <div class=" float-right mt-3 ">
                                <input type="submit" value="Create Slider" name="slider"
                                    class="btn btn-success btn-sm ">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<?php include "incs/footer.php" ?>