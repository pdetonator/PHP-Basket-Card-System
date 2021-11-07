<?php 

    require __DIR__ . '/Basket.php';
    
    $basket = new Basket('card');

    /* $basket -> addItem(1425, [
        'title' => 'Man Oversize Tee',
        'price' => 150, // constant variable, must be defined.
        'size' => 'XL'
    ]);
    */
    // $basket -> decraseItem(1425);
    // $basket -> removeItem(1425);
    // $basket -> itemExist(1425);
    // $basket -> updateItem(1425, 'title', 'Man Oversize Tshirt'); 
    // $thisItem = $basket -> getItem(1425);

    echo '<pre>';
    print_r($_SESSION['card']);
    echo '</pre>';
    
    echo '<b> Card Total Price = ' . number_format($basket -> cardTotalPrice(), 2, ',', '.') . '$</b>';
    echo '<br>';
    echo '<b> Card Total Count = ' . $basket -> cardTotalCount() . '</b>';

?>