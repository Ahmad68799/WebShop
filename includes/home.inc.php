    <div class="home_page">
        <img src="images/man.png" width="600px" height="247px">
        <div class="text-overlay">
        <h1>Wear the confidence.</h1>
        <p>"Elevate your style.Command attention.Dress with confidence,live with purpose."</p>
    </div>
    <!-- HOME PAGE XXX -->

     <!-- SHOP ALL BTN -->
    <div class="shopall_btn">
        <a href="#">Shop All</a>
     </div>
     <!-- SHOP ALL BTN XXX -->

     <!-- CATEGORIES -->
     <section class="categories">
        <div class="heading">
            <h1>Our Collections</h1>
        </div>

         <?php
         include '../private/connection.php';
         ?>
        <div class="category-container">
            <!-- Men -->
            <div class="category">
                <img src="images/men.png">
                <div class="dropdown-container">
                    <button class="dropdown-btn">Men▾</button>
                        <div class="dropdown">
                            <?php
                            // Haal het main_categorie_id en name op uit de subcategorieën
                            $stmt = $pdo->prepare("SELECT main_categorie_id, name FROM `subcategories` WHERE main_categorie_id = 4");
                            $stmt->execute();
                            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                // Print het name van de subcategorie in de dropdown
                                echo '<a href="#">' . htmlspecialchars($result['name']) . '</a>';
                            }
                            ?>
                        </div>
                </div>
            </div>

            <!-- Women -->
            <div class="category">
                <img src="images/women.png">
                <div class="dropdown-container">
                    <button class="dropdown-btn">Women▾</button>
                    <div class="dropdown">
                        <?php
                        // Haal het main_categorie_id en name op uit de subcategorieën
                        $stmt = $pdo->prepare("SELECT main_categorie_id, name FROM `subcategories` WHERE main_categorie_id = 5");
                        $stmt->execute();
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            // Print het name van de subcategorie in de dropdown
                            echo '<a href="#">' . htmlspecialchars($result['name']) . '</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <!-- CATEGORIES XXX -->
        <!-- products -->
        <section class="products">
            <div class="heading">
                <h1>Oure populair products</h1>
                <a class="shopnow_btn" href="#">Shop Now</a>
            </div>
                 <!-- product content -->

                    <?php
                    $stmt = $pdo->prepare("SELECT * FROM `products` limit 8");
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                     foreach ($result as $product) {
                         echo'
                         <div class="product-container">
                             <div class="box">
                                <a class="a_home_link" href="index.php?page=productpage&product_id=' . htmlspecialchars($product['product_id']) . '">
                                 <img src="data:image/jpeg;base64,' . base64_encode($product['photo']) . '" alt="">
                                 <h2>' . htmlspecialchars($product['name']) . '</h2>
                                 <h3 class="price">' . htmlspecialchars($product['price']) . '</h3>
                                 </a>
                            </div>
                         </div>
                         ';
                     }
                    ?>
        </section>