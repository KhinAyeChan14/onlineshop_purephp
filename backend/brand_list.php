 <?php
require 'backendheader.php';
require 'dbConnect.php';

$sql="SELECT * FROM brands ORDER BY id DESC";
$stmt=$conn->prepare($sql);
$stmt->execute();

$brands=$stmt->fetchAll();
?>

<main class="app-content">
    <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Brand </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="brand_new.php" class="btn btn-outline-primary">
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
                                          <th>#</th>
                                          <th>Name</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            $i=1;
                                            foreach ($brands as $brand){
                                                $bid=$brand['id'];
                                                $name=$brand['name'];
                                                $photo=$brand['photo'];
                                        ?>
                                            
                                        <tr>
                                            <td> <?= $i++; ?></td>
                                            <td> <img src="<?= $photo ?>" width="50" height="50" >
                                                <span class="text font-weight-bold"><?= $name; ?></span></td>
                                            <td>
                                                <a href="brand_edit.php?id=<?= $bid ?>" class="btn btn-warning mr-3">
                                                    <i class="icofont-ui-settings"></i>
                                                </a>      

                                                <form action="brandDelete.php" onsubmit="return confirm('Are you sure want to delete?')" method="POST" class="d-inline-block">
                                                    <input type="hidden" name="id" value="<?= $bid ?>">
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
