<?php
require 'backendheader.php';
require 'dbConnect.php';

$sql="SELECT * FROM categories ORDER BY id DESC";
$stmt=$conn->prepare($sql);
$stmt->execute();
$categories=$stmt->fetchAll();

?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i> Category </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <a href="category_new.php" class="btn btn-outline-primary">
                <i class="icofont-plus"></i>
            </a>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                  <th>id</th>
                                  <th>Name</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    $i=1;
                                    foreach ($categories as $category){
                                        $cid=$category['id'];
                                        $name=$category['name'];
                                ?>
                                    
                                <tr>
                                    <td> <?= $i++; ?></td>
                                    <td> <?= $name; ?></td>
                                    <td class="text-center">
                                        <a href="category_edit.php?id=<?= $cid ?>" class="btn btn-warning mr-3">
                                            <i class="icofont-ui-settings"></i>
                                        </a>
                                        

                                        <form action="categoryDelete.php" onsubmit="return confirm('Are you sure want to delete?')" method="POST" class="d-inline-block">
                                            <input type="hidden" name="id" value="<?= $cid ?>">
                                            <button class="btn btn-outline-danger">
                                                <i class="icofont-close"></i>
                                            </button>
                                        </form>


                                        
                                    </td>

                                </tr>

                                <?php } ?>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



<?php
    require 'backendfooter.php'
?>