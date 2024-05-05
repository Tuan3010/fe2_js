<?php
require_once './config/database.php';
spl_autoload_register(function ($className) {
    require_once "./app/models/$className.php";
});

$productModel = new ProductModel();

$productList = $productModel->getAllProducts();

$categoryModel = new CategoryModel();
$categoryList = $categoryModel->getAllCategories();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="http://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <style>
        .list-search{
            position: absolute;
            left: 0;
            top: 40px;
            list-style-type: none;
            width: 100%;
            padding: 0;

        }
        .list-search-item{
            border-radius: 10px;
            border: 1px solid #ccc;
            background-color: #e1e0e0;
            display: block;
            padding: 0;
            /* width: 100%; */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <?php
                    foreach ($categoryList as $item) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="category.php?id=<?php echo $item['id']; ?>"><?php echo $item['category_name']; ?></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <form class="d-flex" role="search" action="search.php" method="get" style="position: relative;">
                    <input class="form-control me-2 inputclass" type="search" placeholder="Search" aria-label="Search" name="q">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                    <ul class="list-search" >
                        
                    </ul>
                </form>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row gx-5">
            <div class="col-md-6">
                <div class="row">
                    <?php
                    foreach ($productList as $item) {
                    ?>
                        <div class="col-md-3">
                            <img src="./public/images/<?php echo $item['product_photo']; ?>" alt="" class="img-fluid 
                            product-photo" data-product-id="<?php echo $item['id']; ?>">
                            <a href="product.php?id=<?php echo $item['id']; ?>">
                                <h6><?php echo $item['product_name']; ?></h6>
                            </a>
                            <p>
                                <span class="badge text-bg-warning product-view<?php echo $item['id'];?>"><i class="bi bi-eye-fill"></i><?php echo $item['product_view']; ?></span>
                                <button class="btn badge text-bg-danger btn-like" data-product-id="<?php echo $item['id'] ?>"><i class="bi bi-heart-fill"></i> <?php echo $item['product_like']; ?></button>
                                <?php echo $item['product_price']; ?>
                            </p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="result card ">
                    
                </div>
            </div>
        </div>
    </div>
    <script src="public/js/app.js"></script>
</body>

</html>