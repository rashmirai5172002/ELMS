<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['update'])) {
        $did = intval($_GET['holyid']);
        $holydaymark = $_POST['holydaymark'];
        $date = $_POST['date'];
        $status = $_POST['status'];
        $sql = "update addholyday set HolydayMark=:holydaymark,Date=:date,Status=:status where id=:did";
        $query = $dbh->prepare($sql);
        $query->bindParam(':holydaymark', $holydaymark, PDO::PARAM_STR);
        $query->bindParam(':date', $date, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':did', $did, PDO::PARAM_STR);
        $query->execute();
        $msg = "Holyday updated Successfully";
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- Title -->
        <title>Admin | Update Holyday</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css" />
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.css" />
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
        </style>
    </head>

    <body>
        <?php include('includes/header.php'); ?>

        <?php include('includes/sidebar.php'); ?>
        <main class="mn-inner">
            <div class="row">
                <div class="col s12">
                    <div class="page-title" style="color: green;">Update Holyday Details</div>
                </div>
                <div class="col s12 m12 l6">
                    <div class="card">
                        <div class="card-content">

                            <div class="row">
                                <form class="col s12" name="chngpwd" method="POST">
                                    <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php } ?>
                                    <?php
                                    $did = intval($_GET['holyid']);
                                    $sql = "SELECT * from addholyday WHERE id=:did";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':did', $did, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {               ?>

                                            <div class="row">

                                                <div class="input-field col s12">
                                                    <input id="holydaymark" type="text" name="holydaymark" class="validate" autocomplete="off" value="<?php echo htmlentities($result->HolydayMark); ?>" required>
                                                    <label for="password">Holyday Mark</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input id="date" type="date" class="validate" autocomplete="off" name="date" value="<?php echo htmlentities($result->Date); ?>" required>
                                                    <label for="date"></label>
                                                </div>


                                                <div class="input-field col s12">

                                                    <label for="status"></label>
                                                    <select name="status" id="status" required>
                                                        
                                                        <option value="1"<?php if($result->Status==1)
                                                             {echo "selected";}
                                             ?>>Active</option>
                                                        <option value="0"<?php if($result->Status==0)
                                                             {echo "selected";}
                                            ?>>Inactive</option>

                                                    </select>
                                                </div>

                                        <?php }
                                    } ?>


                                        <div class="input-field col s12">
                                            <button type="submit" name="update" class="waves-effect waves-light btn indigo m-b-xs">UPDATE</button>

                                        </div>




                                            </div>

                                </form>
                            </div>
                        </div>
                    </div>



                </div>

            </div>
        </main>

        </div>
        <div class="left-sidebar-hover"></div>

        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/form_elements.js"></script>

    </body>

    </html>
<?php } ?>